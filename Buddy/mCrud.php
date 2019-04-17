<?php
include "../GCon.php";

//var_dump($_GET, $_POST);


$ord = $_POST['ORD'];
$seq = $_POST['seq'];
$cmp = $_POST['cmp'];
$cmpid = strtoupper($_POST['cmpid']);
$qty = $_POST['cmpqty'];
$uom = $_POST['uom'];
$notes = trim(substr($_POST['cmpnotes'],0,499));

$action = $_POST['Action'];

if (trim($action) == 'Add') {
$s1 = "Select max(cmpseq) as MAX from GM43OBJ/BuddyChkM where OrderNum = $ord";
$r1 = db2_exec($con, $s1);
$row1 = db2_fetch_assoc($r1);
$max = $row1['MAX'] +1;
if (trim($notes) == '') $notes = ' ';
if (trim($uom) == '' ) $uom = '??';

    $s = "Insert into GM43OBJ/BuddyChkM values(
$ord, 
$max, 
'$cmp',
'$cmpid',
$qty,
'$uom',
' ',
'$notes'
) with NC";
    db2_exec($con, $s);
  //  var_dump($s, db2_stmt_errormsg());
    
   $data['success'] = true;
   echo json_encode($data);
}
if (trim($action) == 'Update') {
    $s = "Update GM43OBJ/buddychkM set
Component = '$cmp',
CmpId = '$cmpid',
UOM = '$uom',
CMPNOTES = '$notes',
QTY = $qty
Where OrderNum = $ord and CmpSeq = $seq with NC";
    $r = db2_exec($con, $s);
    $data['success'] = true;
    $data['sql'] = $s;
    $data['sqlErr'] = db2_stmt_errormsg();
    echo json_encode($data);
}

if (trim($action) == 'Delete') {
    $s = "Delete from GM43OBJ/BuddyChkM
Where OrderNum = $ord and CmpSeq = $seq with NC";
    $r = db2_exec($con, $s);
    $data['success'] = true;
    $data['sql'] = $s;
    $data['sqlErr'] = db2_stmt_errormsg();
    echo json_encode($data);
}
