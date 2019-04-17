<?php

error_reporting(E_ALL);
ini_set('details_errors', TRUE);
ini_set('details_startup_errors', TRUE);
ini_set('memory_limit', '-1');
ini_set('time_limit', '90');
ignore_user_abort();


if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Harris Data EIP"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Text to send if user hits Cancel button';
    exit;
} else {
    // echo "<p>Hello {$_SERVER['PHP_AUTH_USER']}.</p>";
    // echo "<p>You entered {$_SERVER['PHP_AUTH_PW']} as your password.</p>";
}


include "../GConb.php";

$path = '/usr/local/zendsvr/share/ToolKitAPI';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once("ToolkitService.php");
$extension='ibm_db2';
$pw = 'Webuser!1'; ;
$usr = 'WEBUSER';
$db = 'S101EF5R';
try {
    $ToolkitServiceObj = ToolkitService::getInstance($db, $usr, $pw);
}
catch (Exception $e) {
    echo  $e->getMessage(), "\n";
    exit();
}
//$ToolkitServiceObj->setToolkitServiceParams(array('InternalKey'=>"/tmp/$user"));
$ToolkitServiceObj->setToolkitServiceParams(array('InternalKey'=>"/tmp/$usr",
    'debug'=>true,
    'plug' => "iPLUG32K"));

$bc = $_GET['BC'];



$param[] = $ToolkitServiceObj->AddParameterChar('both', 30, 'BC', 'BC', trim($bc));


$result  = $ToolkitServiceObj->PgmCall('BUDDYPRTL1', "GM43OBJ", $param, null, null);
$data['success'] = 'Result' . $result;

//echo json_encode($data);
echo 'success';
