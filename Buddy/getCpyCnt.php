<?php
include "../GConB.php";


$ord = $_GET['ORD'];

$s = "SELECT OCORL#, OCCSEQ FROM oeocmt WHERE ocord# = $ord and 
OCCMNT like '***COPYSTART***%' and ocdoct = 'ACK'  fetch first 1 rows only  ";
$r = db2_exec($con, $s);
var_dump($s, db2_stmt_errormsg());
$row = db2_fetch_assoc($r);

$line = $row['OCORL#'];
$sseq = $row['OCCSEQ'];

var_dump('Seq/Line: ', $sseq, $line);
$s = "SELECT OCORL#, OCCSEQ,occmnt FROM oeocmt WHERE ocord# = $ord and
OCCMNT like '***COPYEND***%' and ocdoct = 'ACK' and ocorl# = $line     
and occseq > $sseq                                                    ";
$r = db2_exec($con, $s);
var_dump($s, db2_stmt_errormsg());
$row = db2_fetch_assoc($r);

$lseq = $row['OCCSEQ'];

$s = "SELECT occmnt FROM oeocmt WHERE ocord# = $ord and        
Occseq > $sseq and occseq < $lseq and ocdoct = 'ACK' and ocorl# = $line 
and occmnt <> ' '                                           ";
$r = db2_exec($con, $s);
$copy  = "";
while($row = db2_fetch_assoc($r)){
    $copy .= trim($row['OCCMNT']);
}

$copy = str_replace(' ', '', $copy);
$array = str_split($copy);
$copycount = 0;
foreach($array as $char) {
    if ($char ==  'i') $copycount += 1;
    if ($char ==  'j') $copycount += 1;
    if ($char ==  '"') $copycount += 1;
    if ($char ==  ':') $copycount += 1;
    if ($char ==  ';') $copycount += 1;
    if ($char ==  '?') $copycount += 1;
    if ($char ==  '!') $copycount += 1;
    if ($char ==  '%') $copycount += 2;
    $copycount += 1;
}

$x['count'] =  $copycount;
$x['copy'] = $copy;

$data['root'][] = $x;


echo json_encode($data);
