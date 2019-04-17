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
    
    
    include("setincl.php");
    $reset = true;
    setCopyKit($con, $ord, $reset);
    
   
        
        $data['success'] = true;
        echo json_encode($data);
     
    
    
    
    
    
    
}