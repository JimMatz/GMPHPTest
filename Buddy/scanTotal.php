<?php
include "../GCon.php";
$ord  = $_GET['ORD'];
 
$msg = ' ';
$s = "Select sum(QTY) as SUMQTY from GM43OBJ/buddychkM where ORDERNUM = $ord";
$r = db2_exec($con, $s);
$row = db2_fetch_assoc($r);

Echo $row['SUMQTY'];