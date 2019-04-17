<?php
include "../GCon.php";
$ord  = $_GET['ORD'];
$v = $_GET['V'];
$msg = ' ';
$scanusr = strtoupper($_SERVER['PHP_AUTH_USER']);
$s = "Select * from GM43OBJ/buddychkd where BC = '$v'";
$r = db2_exec($con, $s);
$row = db2_fetch_assoc($r);
if (trim($row['SCANTS']) == ''){
    $msg = "Barcode Not Found";
} else {
if ($row['SEQSTAT'] !== ' '){
    $msg = "Row already scanned by".$row['SCANUSR']." ";
} else {
    $msg = "OK";
}
}
$s = "Update GM43OBJ/buddychkd set SEQSTAT = 'X', SCANUSR = '$scanusr', SCANTS = current timestamp where BC = '$v' with NC";
$r = db2_exec($con, $s);
//var_dump($s, db2_stmt_errormsg());

echo $msg;