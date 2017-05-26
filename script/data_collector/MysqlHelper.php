<?php

class MysqlHelper{
  static function getBindTypes(array $data){
    $types = "";
    foreach($data as $value){
      $type = gettype($value);
      if(strcasecmp($type, "integer") === 0 || strcasecmp($type, "boolean") === 0 || strcasecmp($type, "null") === 0) $types .= "i";
      elseif(strcasecmp($type, "double") === 0) $types .= "d";
      else $types .= "s";
    }

    return $types;
  }

  static function getInsertQuery($table, array $columns, mysqli $mysqli){
    if(!$table) throw new RuntimeException("table name is empty");
    if(!$columns) throw new RuntimeException("columns is empty");

    //check is the column name is correct, should have no string to escape
    foreach($columns as $column)
      if($mysqli->real_escape_string($column) !== $column) 
        throw new RuntimeException("something wrong on the column name of $column");
    
    $columnsSql = "(" . implode(",", $columns) . ")";
    $valueSql = "(" . substr(str_repeat("?,", count($columns)),0, -1) . ")";

    return "insert into $table{$columnsSql} value$valueSql";
  }

  static function insertData($table, array $result, mysqli $mysqli){
    if(!$result) 
      throw new RuntimeException("result data is empty, something wrong on inserting data");

    self::executeQuery(self::getInsertQuery($table, array_keys($result), $mysqli), $result, $mysqli);
  }

  static function insertAndUpdateData($table, array $result, array $nonUpdatedColumn){
    if(!$result) throw new RuntimeException("result data is empty, something wrong on inserting data and update");

    $onDuplicateData = $result;
    //remove the columns if it is not needed
    foreach($nonUpdatedColumn as $nonUpdatedColumn) unset($onDuplicateData[$nonUpdatedColumn]);
    if(!$onDuplicateData) 
      throw new LengthException("onDuplicateData is empty? should have something to update on post");

    //for bind_params
    $values = array_values($result);
    array_push($values, ...array_values($onDuplicateData));

    //keys is columns
    self::executeQuery(self::getInsertOnDuplicateKeyUpdateQuery($table, array_keys($result), array_keys($onDuplicateData)), $values);
  }

  static function getInsertOnDuplicateKeyUpdateQuery($table, array $columns, array $onDuplicateKeyColumns, mysqli $mysqli){
    if(!$onDuplicateKeyColumns) throw new RuntimeException("duplicate columns is empty");

    $onDuplicateKeyUpdateQuery = "on duplicate key update ";
    foreach($onDuplicateKeyColumns as $onDuplicateKeyColumn) $onDuplicateKeyUpdateQuery .= "$onDuplicateKeyColumn=?,";
    //trim last comma
    $onDuplicateKeyUpdateQuery = substr($onDuplicateKeyUpdateQuery, 0 , -1);
    
    return self::getInsertQuery($table, $columns) . " $onDuplicateKeyUpdateQuery";
  }

  static function executeQuery($query, array $params = [], mysqli $mysqli){
    if(!$stmt = $mysqli->prepare($query)) throw new RuntimeException($mysqli->error);
    if($params && !$stmt->bind_param(self::getBindTypes($params), ...array_values($params))) throw new RuntimeException($stmt->error);
    if(!$stmt->execute()) throw new RuntimeException($stmt->error);
  }
}