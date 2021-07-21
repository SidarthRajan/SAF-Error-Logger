<?php
include('config.php');
$eTables = mysqli_query($link, "SELECT error_id, error_date, error_time, error_type, error_spec, error_freq, error_file, error_line, error_st FROM error_list;");


$eRows = array();


while($i = mysqli_fetch_array($eTables) ) {
    $eRows[] = $i ;
}

$eTables_data = array(
    "data"            => $eRows   // total data array
);

$fp = fopen('eTables.json', "w");
fwrite($fp, json_encode($eTables_data));
fclose($fp);
?>