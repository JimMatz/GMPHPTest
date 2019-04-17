<?php
error_reporting(E_ALL);
ini_set('details_errors', TRUE);
ini_set('details_startup_errors', TRUE);
ini_set('memory_limit', '-1');

include "../GCon.php";

$s = "SELECT ORDERNUM, SUM(QTY) AS QTY,                       
SUM(SCANCNT) AS SCANCNT, MAX(LASTSCAN) AS LASTSCAN FROM 
GM43OBJ/buddyreview GROUP BY ORDERNUM                           ";
$r = db2_exec($con, $s);
//var_dump($s, db2_stmt_errormsg());
while($row = db2_fetch_assoc($r)){
    $data['root'][] = $row;
}
$data['success'] = true;

echo json_encode($data);