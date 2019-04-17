<?php
include "../GCon.php";
$ord  = $_GET['ORD'];

$msg = ' ';
$s = "Select count(*) as SUMQTY from GM43OBJ/buddychkD where ORDERNUM = $ord and SEQSTAT<>' '";
$r = db2_exec($con, $s);
$row = db2_fetch_assoc($r);

Echo $row['SUMQTY'];