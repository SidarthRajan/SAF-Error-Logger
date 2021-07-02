<?php
$server = "saf-error-logger.cn2yuu5dv9vd.us-east-1.rds.amazonaws.com";
$username = "admin";
$password = "AtlantaHawks";
$database = "error_logger";


$link = new mysqli($server, $username, $password, $database);

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
//$link = new mysqli($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);
?>