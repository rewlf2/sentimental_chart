<?php
/**
 * Script for collecting data from crimson hexagon
 */

set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__);
spl_autoload_register();

echo "Starting calling api at ", (new Datetime(null, new DatetimeZone("utc")))->format("Y-m-d H:i:s"), "\n";

$mysql_driver = new mysqli_driver;
$mysql_driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

$mysqli = new mysqli(MysqlConfig::HOST, MysqlConfig::USER, MysqlConfig::PASSWORD, MysqlConfig::DB);
$mysqli->set_charset(MysqlConfig::CHARSET);

$ids = [6151023456];

// get all monitor ids for fetching
$query = "SELECT id FROM ch_monitors";
// $result = $mysqli->query($query);
// while($row = $result->fetch_array())
// {
//     $ids[] = (int) $row["id"];
// }

if(!$ids)
{
    echo "monitor ids is empty\n";
}
else
{
    foreach($ids as $id)
    {
        $hexagon = new CrimsonHexagonApiFetching((int)$id, $mysqli);
        $hexagon->fetchAll();
    }
}

echo "finishing at ", (new Datetime(null, new DatetimeZone("utc")))->format("Y-m-d H:i:s"), "\n";
