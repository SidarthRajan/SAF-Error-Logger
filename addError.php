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
//            VALUES(?, ?, ?, ?, ?, ?, ?)");
//$stmt->bind_param("ssssisi", $date, $time, $type, $spec, $freq, $file, $line);
//$stmt->execute();


$query = "SELECT error_id, error_type, error_spec, error_freq FROM error_list";
$result = mysqli_query($link, $query);
$preventMult = 0;
while ($row = mysqli_fetch_array($result)) {
    echo $row["error_id"];
    echo $row['error_type'];
    echo $row['error_spec'];
    echo $row['error_freq'];
    $typeTest = levenshtein($type, $row['error_type']);
    $specTest = levenshtein($spec, $row['error_spec']);
    if ((($typeTest < 15) || ($specTest < 15)) && (($typeTest != -1) || ($specTest != -1))) {
        $newFreq = $row['error_freq'] + 1;
        $chngFreq = $link->prepare("UPDATE error_list SET error_freq=? WHERE error_id=?");
        $chngFreq->bind_param("ii", $newFreq, $row['error_id']);
        $chngFreq->execute();
        $preventMult = 1;
    }
}
if ($preventMult == 0) {
       $stmt = $link->prepare("INSERT INTO error_list (error_date, error_time, error_type, error_spec, error_freq, error_file, error_line)
           VALUES(?, ?, ?, ?, ?, ?, ?)");
       $stmt->bind_param("ssssisi", $date, $time, $type, $spec, $freq, $file, $line);
       $stmt->execute();
}
//$stmt = $link->prepare("INSERT INTO error_list (error_date, error_time, error_type, error_spec, error_freq, error_file, error_line)
//        VALUES (?, ?, ?, ?, ?, ?, ?)");
//$stmt->bind_param("ssssisi", $date, $time, $type, $spec, $freq, $file, $line);
//$stmt->execute();
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
