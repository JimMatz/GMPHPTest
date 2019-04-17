<?php
 
ini_set('memory_limit', '-1');

include "../GCon.php";
//var_dump($con);
$data = array();
if (isset($_GET['ORD'])){
    $ord = $_GET['ORD'];
    
    
    $s = "Select * from GM43OBJ/buddychkm where ordernum = $ord order by cmpseq";
    $r = db2_exec($con, $s);
    
    while ($row = db2_fetch_assoc($r)){
        
        $data['root'][] = $row;
        
    }
  //  var_dump($data);
    $data['success'] = true;
    echo json_encode($data);
    
}
// ORDERNUM,CMPSEQ,COMPONENT,CMPID,QTY,UOM,SEQSTATUS,CMPNOTES 