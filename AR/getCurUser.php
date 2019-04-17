<?php
include "../GCon.php";

$user = strtoupper($_SERVER['PHP_AUTH_USER']);
$s  = "Select * from SYUSER where USUSER = '$user'";
$r = db2_exec($con, $s);
$row = db2_fetch_assoc($r);
$name = $row['USDESC'];
$data = "($user) $name";

echo json_encode($data);