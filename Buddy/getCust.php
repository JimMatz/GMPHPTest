<?php
include "../GCon.php";
$ord  = $_GET['ORD'];
$s = "select * from gihdsdata/oeorhd                
left join gihdsdata/hdcust on oeshto = cmcust 
where oeord# =  $ord                       ";
$r = db2_exec($con, $s);
$row = db2_fetch_assoc($r);

$rtn = '(' . $row['OESHTO'] . ') '. trim($row['CMCNA1']) . ' ' . trim($row['CMCCTY']) . ', ' .$row['CMST'] . '-' . $row['CMZIP'];

echo $rtn;