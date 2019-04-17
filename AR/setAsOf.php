<?php

error_reporting(E_ALL);
ini_set('details_errors', TRUE);
ini_set('details_startup_errors', TRUE);
ini_set('memory_limit', '-1');
ini_set('time_limit', '180');

include "../GCon.php";
$user = strtoupper($_SERVER['PHP_AUTH_USER']);

$val = $_GET['ASOF'];

$cdate = new DateTime();
$curdate = $cdate->format('Y-m-d');

if (trim($val) == trim($curdate)){
    $value = '*TODAY';
} else {
    $value = $val;
}

$s = "Update Aging_Defaults set TAGV = '$value' where Tag = 'ASOF' and USR = '$user' with NC";
$r = db2_exec($con, $s);
//var_dump($s, db2_stmt_errormsg());
$s = "Update Aging_Defaults set TAGV = 'Y' where Tag = 'CRTVIEW' and USR = '$user' with NC";
$r = db2_exec($con, $s);
//var_dump($s, db2_stmt_errormsg());
$asof = strtotime(trim($val));
$asof3  = date('Y-m-d',$asof);
 

 $diffn = dateDifference($asof3, $curdate);
 $diff = strval($diffn);
 $s = "Update Aging_Defaults set TAGV = '$diff' where Tag = 'ASOFDIFF' and USR = '$user' with NC";
 $r = db2_exec($con, $s);
 //var_dump($s, db2_stmt_errormsg());
 
//var_dump($diff, $asof, $asof3, $curdate);
 
$data['success'] = true;
 $msg = 'OK';
$data['msg'] = $msg;
echo json_encode($data);



function dateDifference($date_1 , $date_2 )
{
    $differenceFormat = '%a';
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
    
    $interval = date_diff($datetime1 , $datetime2);
  //  var_dump($datetime1, $datetime2);
    return $interval->format($differenceFormat);
    
}