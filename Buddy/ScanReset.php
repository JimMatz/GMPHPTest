<?php
include "../GCon.php";
$ord  = $_GET['ORD'];
$v = $_GET['V'];
$msg = ' ';
$scanusr = strtoupper($_SERVER['PHP_AUTH_USER']);
        $msg = "OK";
 
$s = "Update GM43OBJ/buddychkd set SEQSTAT = ' ', SCANUSR = '$scanusr', SCANTS = current timestamp where BC = '$v' with NC";
$r = db2_exec($con, $s);
//var_dump($s, db2_stmt_errormsg());

echo $msg;