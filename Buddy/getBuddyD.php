<?php
error_reporting(E_ALL);
ini_set('details_errors', TRUE);
ini_set('details_startup_errors', TRUE);
ini_set('memory_limit', '-1');

include "../GCon.php";
//var_dump($con);
$data = array();
if (isset($_GET['ORD'])){
    $ord = $_GET['ORD'];
    
    
    $s = "Select ORDERNUM, CMPSEQ, CMPID, SEQID, SEQSTAT, SCANUSR, Date(ScanTS) as SCANTS, Time(ScanTS) as SCANT, BC from GM43OBJ/buddychkd where ordernum = $ord order by cmpseq";
    $r = db2_exec($con, $s);
    
    while ($row = db2_fetch_assoc($r)){
        if ($row['SEQSTAT'] == 'X') $row['SEQSTAT'] = true; else $row['SEQSTAT'] = false;
        
        $data['root'][] = $row;
        
    }
    //  var_dump($data);
    $data['success'] = true;
    echo json_encode($data);
    
}
   