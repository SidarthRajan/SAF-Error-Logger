<?php
    include "config.php";

    $sql = "SELECT error_id, error_date, error_type, error_spec, error_freq, error_loc FROM error_list";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "id: " . $row["error_id"]. " - Date: " . $row["error_date"]. " - Type: " . $row["error_type"]. "- Specific: " . $row["error_spec"]. " - Frequency: " . $row["error_freq"]. " - File: " . $row["error_file"]." - Line: " . $row["error_line"]." - Trace: " . $row["error_trace"]. "";
        }
    } else {
        echo "0 results";
    }

mysqli_close($link);

?>