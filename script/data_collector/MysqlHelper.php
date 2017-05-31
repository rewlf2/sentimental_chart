<?php

/**
 * for doing mysql related functions 
 */
class MysqlHelper
{
    /**
     * get the bind types for mysqli bind_params
     *
     * @param array $data
     * @return string $types
     */
    public static function getBindTypes(array $data)
    {
        $types = "";
        foreach($data as $value)
        {
            $type = gettype($value);
            if(strcasecmp($type, "integer") === 0 || strcasecmp($type, "boolean") === 0 || strcasecmp($type, "null") === 0)
            {
                $types .= "i";
            }
            elseif(strcasecmp($type, "double") === 0)
            {
                $types .= "d";
            }
            else
            {
                $types .= "s";
            }
        }

        return $types;
    }

    /**
     * get the insert query string from array
     *
     * @param mysqli $mysqli
     * @param string $table
     * @param array $columns
     * @param mysqli $mysqli
     * @return string
     */
    public static function getInsertQuery(mysqli $mysqli, $table, array $columns)
    {
        if(!$table)
        {
            throw new RuntimeException("table name is empty");
        }

        if(!$columns)
        {
            throw new RuntimeException("columns is empty");
        }

        //check is the column name is correct, should have no string to escape
        foreach($columns as $column)
        {
            if($mysqli->real_escape_string($column) !== $column)
            {
                throw new RuntimeException("something wrong on the column name of $column");
            }
        }

        $columnsSql = "(" . implode(",", $columns) . ")";
        $valueSql = "(" . substr(str_repeat("?,", count($columns)),0, -1) . ")";

        return "insert into $table{$columnsSql} value$valueSql";
    }

    /**
     * insert result to mysql database
     *
     * @param mysqli $mysqli
     * @param string $table
     * @param array $result
     * @return void
     */
    public static function insertData(mysqli $mysqli, $table, array $result)
    {
        if(!$result)
        {
            throw new RuntimeException("result data is empty, something wrong on inserting data");
        }

        self::executeQuery($mysqli, self::getInsertQuery($mysqli, $table, array_keys($result)), $result);
    }

    /**
     * insert those result to mysql table or update those field when key is duplicated 
     *
     * @param mysqli $mysqli
     * @param string $table
     * @param array $result
     * @param array $nonUpdatedColumn
     * @return void
     */
    public static function insertAndUpdateData(mysqli $mysqli, $table, array $result, array $nonUpdatedColumns = [])
    {
        if(!$result)
        {
            throw new RuntimeException("result data is empty, something wrong on inserting data and update");
        }

        $onDuplicateData = $result;
        //remove the columns if it is not needed
        // this is copy from facebook one, also i think this function maybe not use on this project, maybe i later go fix this helper and
        // check all functions is correct 
        foreach($nonUpdatedColumns as $nonUpdatedColumn)
        {
            unset($onDuplicateData[$nonUpdatedColumn]);
        }

        if(!$onDuplicateData)
        {
            throw new LengthException("onDuplicateData is empty? should have something to update on post");
        } 

        //for bind_params
        $values = array_values($result);
        array_push($values, ...array_values($onDuplicateData));

        //keys is columns
        $query = self::getInsertOnDuplicateKeyUpdateQuery($table, array_keys($result), array_keys($onDuplicateData), $mysqli);
        self::executeQuery($query, $values, $mysqli);
    }


    /**
     * create a insert on duplicate key update mysql query
     *
     * @param mysqli $mysqli
     * @param string $table
     * @param array $columns
     * @param array $onDuplicateKeyColumns
     * @return string
     */
    public static function getInsertOnDuplicateKeyUpdateQuery(mysqli $mysqli, $table, array $columns, 
        array $onDuplicateKeyColumns)
    {
        if(!$onDuplicateKeyColumns)
        {
            throw new RuntimeException("duplicate columns is empty");
        }

        $onDuplicateKeyUpdateQuery = "on duplicate key update ";

        foreach($onDuplicateKeyColumns as $onDuplicateKeyColumn)
        {
            $onDuplicateKeyUpdateQuery .= "$onDuplicateKeyColumn=?,";
        }

        //trim last comma
        $onDuplicateKeyUpdateQuery = substr($onDuplicateKeyUpdateQuery, 0 , -1);

        return self::getInsertQuery($table, $columns, $mysqli) . " $onDuplicateKeyUpdateQuery";
    }

    /**
     * execute a query using the pass in mysqli object
     *
     * @param mysqli $mysqli
     * @param string $query
     * @param array $params
     * @return void
     */
    public static function executeQuery(mysqli $mysqli, $query, array $params = [])
    {
        if(!$stmt = $mysqli->prepare($query))
        {
            throw new RuntimeException($mysqli->error);
        }

        if($params && !$stmt->bind_param(self::getBindTypes($params), ...array_values($params)))
        {
            throw new RuntimeException($stmt->error);
        }

        if(!$stmt->execute())
        {
            throw new RuntimeException($stmt->error);
        }
    }

    /**
     * getting last insert id
     *
     * @return int
     */
    public static function getLastInsertId(mysqli $mysqli){
        $query = "SELECT last_insert_id()";
        $result = $mysqli->query($query);
        return (int) $result->fetch_array(MYSQLI_NUM)[0];
    }
}