<?php
include "config.php";
$tracedStack = $_GET['err_tracing'];
$stmt = $link->prepare("INSERT INTO error_tracing (trace_spec)
           VALUES(?)");
$stmt->bind_param("s", $tracedStack);
$stmt->execute();
?>