<?php
include "../GCon.php";

$usr = trim($_POST['USR']);
$tag = trim($_POST['TAG']);
$tagd = trim($_POST['TAGD']);
$tagActive = trim($_POST['TAGACTIVE']);
$tagType = trim($_POST['TAGTYPE']);
$tagv = trim($_POST['TAGV']);

if (trim($tagv) == 'on') $tagv = 'Y';

$s = "Update AGING_DEFAULTS set 
tagd = '$tagd',
tagv = '$tagv'
where USR = '$usr' and TAG = '$tag' with NC"; 

$r = db2_exec($con, $s);
$data['SQL'] = $s;
$data['MSG'] = db2_stmt_errormsg();
$data['success'] = true;
$msg = "$tagd set to $tagv";
$data['msg'] = $msg;
echo json_encode($data);
