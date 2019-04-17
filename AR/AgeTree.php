<?php 

$base = array();
$rec1=array();
$pri=array();
$leaf=array();
$ccnt = 0;
$rcnt = 0;
$pcnt = 0;
$base['root'] = '.';
//$base['expanded'] = true;
//  levels = Priority/Region/Customer
//*************************************************************
$priority = 'Top';

//*************************************************************
$region = 'East';  

//*************************************************************
$customer = 100001;
$cnt = 0;
$a1 = array();
$row['Invoice'] = 11111;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$row['Invoice'] = 11112;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$row['Invoice'] = 11113;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$ccnt = $cnt;
$rcnt += $cnt;
 
$cust[] = addCust($customer, $ccnt, $a1);
$a1 = array();
//*************************************************************
$customer = 100002;
$cnt = 0;
$row['Invoice'] = 21111;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$row['Invoice'] = 21112;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$row['Invoice'] = 21113;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$ccnt = $cnt;
$rcnt += $cnt;
$cust[] = addCust($customer, $ccnt, $a1);
$a1 = array();

//*************************************************************
$regn[] = addRegn($region, $rcnt, $cust);
$cust = array();
$pcnt += $rcnt;
$rcnt = 0;
//*************************************************************
$region = 'Central';

//*************************************************************
$customer = 100003;
$cnt = 0;
$a1 = array();
$row['Invoice'] = 31111;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$row['Invoice'] = 31112;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$row['Invoice'] = 31113;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$ccnt = $cnt;
$rcnt += $cnt;
$cust[] = addCust($customer, $ccnt, $a1);
//*************************************************************
$customer = 400002;
$cnt = 0;
$a1 = array();
$row['Invoice'] = 41111;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$row['Invoice'] = 41112;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$row['Invoice'] = 41113;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$ccnt = $cnt;
$rcnt += $cnt;
$cust[] = addCust($customer, $ccnt, $a1);
//*************************************************************
$regn[] = addRegn($region, $rcnt, $cust);
$cust = array();
$pcnt += $rcnt;
$rcnt = 0;
//*************************************************************


$pri[]  = addPri($priority, $pcnt, $regn);  // end top prioirty
$regn = array();
//echo "<pre>";
//print_r($pri);
//echo '</pre>';
 
//*************************************************************
//*************************************************************
$priority = 'Low';

//*************************************************************
$region = 'West';

//*************************************************************
$customer = 500001;
$cnt = 0;
$a1 = array();
$row['Invoice'] = 51111;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$row['Invoice'] = 51112;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$row['Invoice'] = 51113;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$ccnt = $cnt;
$rcnt += $cnt;
$cust[] = addCust($customer, $ccnt, $a1);
//*************************************************************
$customer = 600002;
$a1 = array();
$cnt = 0;
$row['Invoice'] = 61111;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$row['Invoice'] = 61112;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$row['Invoice'] = 61113;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$ccnt = $cnt;
$rcnt += $cnt;
$cust[] = addCust($customer, $ccnt, $a1);

//*************************************************************
$regn[] = addRegn($region, $rcnt, $cust);
$cust = array();
$pcnt += $rcnt;
$rcnt = 0;
//*************************************************************
$region = 'Central';

//*************************************************************
$customer = 700003;
$cnt = 0;
$a1 = array();
$row['Invoice'] = 71111;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$row['Invoice'] = 71112;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$row['Invoice'] = 71113;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$ccnt = $cnt;
$rcnt += $cnt;
$cust[] = addCust($customer, $ccnt, $a1);
//*************************************************************
$customer = 800002;
$a1 = array();
$cnt = 0;
$row['Invoice'] = 81111;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$row['Invoice'] = 81112;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$row['Invoice'] = 81113;
$a1[] = addRecordtoCust($row, $a1);
$cnt +=1;
$ccnt = $cnt;
$rcnt += $cnt;
$cust[] = addCust($customer, $ccnt, $a1);

//echo '<br> Low Center Region cust 8';
//echo "<pre>";
//print_r($cust);
//echo '</pre>';
//*************************************************************
$regn[] = addRegn($region, $rcnt, $cust);
 
//echo '<br> Low Center Region';
//echo "<pre>";
//print_r($regn);
//echo '</pre>';
$cust = array();
$pcnt += $rcnt;
$rcnt = 0;
//*************************************************************


$pri[]  = addPri($priority, $pcnt, $regn);  // end Low prioirty
//$p1['text'] = $priority;
//$p1['cnt'] = $pcnt;
//$p1['iconCls'] =  'x-fa fa-feather';
//$p1['children'] = $regn;
//$pri[] = $p1;
//echo '<br> Low Pri';
//echo "<pre>";
//print_r($p1);
//echo '</pre>';

$regn = array();

//*************************************************************

 

$base = addPriToBase($pri);  // end Prio
$pri = array();
//*******************************************************************************
//echo '<br> Base';
//echo "<pre>";
//print_r($base);
//echo '</pre>';


//*******************************************************************************






//if (!empty($_REQUEST['callback'])) {
    header('Content-Type: application/javascript');
    echo $_REQUEST['callback'] . '(';
//}

echo json_encode($base);

//if (!empty($_REQUEST['callback'])) {
    echo ');';
//}


function addRecordtoCust($row){
    $leaf=array();
    $leaf['text'] = $row['Invoice'];
    $leaf['cnt'] = 1;
    $leaf['leaf'] = true;
    $leaf['iconCls'] =  'x-fa fa-edit';
   
    return $leaf;
}

function addCust($customer, $cnt, $a1){
 
    $cust['text'] = $customer;
    $cust['iconCls'] =  'x-fa fa-user';
    $cust['cnt'] = $cnt;
    $cust['children'] = $a1;
    
    
    return $cust;
}



function addRegn($region, $cnt, $a1){
    
    $regn['text'] = $region;
    $regn['cnt'] = $cnt;
    $regn['iconCls'] =  'x-fa fa-map';
    $regn['children'] = $a1;
    return $regn;
}

function addPri($priority, $cnt, $a1){
     
    $pri['text'] = $priority;
    $pri['cnt'] = $cnt;
    $pri['iconCls'] =  'x-fa fa-feather';
    $pri['children'] = $a1;
    return $pri;
}

 

function addPriToBase($pri, $base){
    $base['children'][] = $pri;
    return $base;
}