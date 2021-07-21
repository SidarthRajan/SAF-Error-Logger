<?php
include "config.php";
include "SmithWatermanGotoh.php";
$date = $_GET['err_date'];
$time = $_GET['err_time'];
$type = $_GET['err_type'];
$spec = $_GET['err_spec'];
$file = $_GET['err_file'];
$line = $_GET['err_line'];
$trace = $_GET['err_trace'];
$freq = 1;
$sPercent = 0.6;

//$stmt = $link->prepare("INSERT INTO error_list (error_date, error_time, error_type, error_spec, error_freq, error_file, error_line)
//            VALUES(?, ?, ?, ?, ?, ?, ?)");
//$stmt->bind_param("ssssisi", $date, $time, $type, $spec, $freq, $file, $line);
//$stmt->execute();


$query = "SELECT error_id, error_type, error_spec, error_freq FROM error_list";
$result = mysqli_query($link, $query);
$preventMult = 0;
$traceRels = null;
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['error_id'];
    echo $row['error_type'];
    echo $row['error_spec'];
    echo $row['error_freq'];

//    $typeTest = levenshtein($type, $row['error_type']);
//    $specTest = levenshtein($spec, $row['error_spec']);
      $typeTest = new SmithWatermanGotoh();
      $specTest = new SmithWatermanGotoh();
      $typeVar = $typeTest -> compare($type, $row['error_type']);
      $specVar = $specTest -> compare($spec, $row['error_spec']);

    if (($typeVar > $sPercent) || ($specVar > $sPercent))  {
//        $traceQuery = $link->prepare("SELECT trace_id FROM error_tracing WHERE trace_spec=?");
//        $traceQuery->bind_param("s", $trace);
//        $traceRels = $traceQuery->execute();
//        $chngRel = $link->prepare("UPDATE error_list SET error_related=? WHERE error_id=?");
//        $chngRel->bind_param("ii", $traceRels, $row['error_id']);
//        $chngRel->execute();
        $newFreq = $row['error_freq'] + 1;
        $chngFreq = $link->prepare("UPDATE error_list SET error_freq=? WHERE error_id=?");
        $chngFreq->bind_param("ii", $newFreq, $row['error_id']);
        $chngFreq->execute();
        $preventMult = 1;
        break;
    }
}
if ($preventMult == 0) {
       $stmt = $link->prepare("INSERT INTO error_list (error_date, error_time, error_type, error_spec, error_freq, error_file, error_line, error_st)
           VALUES(?, ?, ?, ?, ?, ?, ?,?)");
       $stmt->bind_param("ssssisis", $date, $time, $type, $spec, $freq, $file, $line, $trace);
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
