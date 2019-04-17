<?php
error_reporting(E_ALL);
ini_set('details_errors', TRUE);
ini_set('details_startup_errors', TRUE);
ini_set('memory_limit', '-1');
ini_set('time_limit', '180');


include "../GCon.php";
$user = strtoupper($_SERVER['PHP_AUTH_USER']);

$sd = "Select TAGV from AGING_DEFAULTS where TAG='CRTVIEW' and USR = '$user'";
$rd = db2_exec($con, $sd);
//var_dump($sd, db2_stmt_errormsg());
$rowd = db2_fetch_assoc($rd);
$crtView = trim($rowd['TAGV']);

$data['success'] = true;
$data['msg'] = $crtView;
echo json_encode($data);