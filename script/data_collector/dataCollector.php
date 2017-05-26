<?php
include_once __DIR__ . "/MysqlConfig.php";
include_once __DIR__ . "/MysqlHelper.php";
include_once __DIR__ . "/CrimsonHexagonConfig.php";
include_once __DIR__ . "/CrimsonHexagonApiFetching.php";

$ids = [6152118344];

$mysqli = new mysqli(MysqlConfig::HOST, MysqlConfig::USER, MysqlConfig::PASSWORD, MysqlConfig::DB);
$mysqli->set_charset(MysqlConfig::CHARSET);

$mysql_driver = new mysqli_driver;
$mysql_driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

foreach($ids as $id){
    $hexagon = new CrimsonHexagonApiFetching($id, $mysqli);
    $hexagon->fetchSentiment();
    $hexagon->fetchVolume();
}
