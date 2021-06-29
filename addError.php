<?php
include "config.php";
$date = $_GET['err_date'];
$time = $_GET['err_time'];
$type = $_GET['err_type'];
$spec = $_GET['err_spec'];
$file = $_GET['err_file'];
$line = $_GET['err_line'];
$freq = 1;
//$stmt = $link->prepare("INSERT INTO error_list (error_date, error_time, error_type, error_spec, error_freq, error_file, error_line)
//        VALUES (?, ?, ?, ?, ?, ?, ?)");
//$stmt->bind_param("ssssisi", $date, $time, $type, $spec, $freq, $file, $line);
//$stmt->execute();
$stmt = $link->prepare("INSERT INTO error_list (error_date, error_time, error_type, error_spec, error_freq, error_file, error_line)
            VALUES(?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssisi", $date, $time, $type, $spec, $freq, $file, $line);
$stmt->execute();
//
//if (mysqli_num_rows($result) > 0) {
//    while($row = mysqli_fetch_assoc($result)) {
////        echo " - Date: " . $row["error_date"]. " - Type: " . $row["error_type"]. "- Specific: " . $row["error_spec"]. " - Frequency: " . $row["error_freq"]. " - File: " . $row["error_file"]." - Line: " . $row["error_line"]." - Trace: " . $row["error_trace"]. "";
//    }
//} else {
//    echo "0 results";
//}
//
//mysqli_close($link);

?>
