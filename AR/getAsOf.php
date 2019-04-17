<?php
error_reporting(E_ALL);
ini_set('details_errors', TRUE);
ini_set('details_startup_errors', TRUE);
ini_set('memory_limit', '-1');
ini_set('time_limit', '180');


include "../GCon.php";
$user = strtoupper($_SERVER['PHP_AUTH_USER']);
$cdate = new DateTime();
$curdate = $cdate->format('Y-m-d');
$sd = "Select TAGV from AGING_DEFAULTS where TAG='ASOF' and USR = '$user'";
$rd = db2_exec($con, $sd);

//var_dump($sd, db2_stmt_errormsg());
$rowd = db2_fetch_assoc($rd);
$asof = trim($rowd['TAGV']);


$sd = "Select TAGV from AGING_DEFAULTS where TAG='SAVASOF' and USR = '$user'";
$rd = db2_exec($con, $sd);
//var_dump($sd, db2_stmt_errormsg());
$rowd2 = db2_fetch_assoc($rd);
$savasofdate = $rowd2['TAGV'];
if (trim($savasofdate) !== trim($curdate)){
    $sd = "Update AGING_DEFAULTS set TAGV = 'Y' where TAG='CRTVIEW' and USR = '$user'";
    $rd = db2_exec($con, $sd);
}

if (trim($asof) == '*TODAY') {
    
    $asof = $cdate->format('Y-m-d');
    $sd = "Update AGING_DEFAULTS set TAGV = '0' where TAG='ASOFDIFF' and USR = '$user'";
    $rd = db2_exec($con, $sd);
    $sd = "Update AGING_DEFAULTS set TAGV = '$asof' where TAG='SAVASOF' and USR = '$user'";
    $rd = db2_exec($con, $sd);
    if (trim($savasofdate) !== trim($asof)){
        $sd = "Update AGING_DEFAULTS set TAGV = 'Y' where TAG='CRTVIEW' and USR = '$user'";
        $rd = db2_exec($con, $sd);
    }
    
}


$data['success'] = true;
$data['asof'] = $asof;
echo json_encode($data);
