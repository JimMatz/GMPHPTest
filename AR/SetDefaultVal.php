<?php
include "../GCon.php";
$user = strtoupper($_SERVER['PHP_AUTH_USER']);
$field = $_GET['INCL'];
$val = $_GET['VAL'];


$s = "Update Aging_Defaults set TAGV = '$val' where Tag = '$field' and USR = '$user' with NC";
$r = db2_exec($con, $s);

$data['success'] = true;
$msg = "$field set to $val";
$data['msg'] = $msg;
echo json_encode($data);