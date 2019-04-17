<?php 

include "../GCon.php";
$ord  = $_GET['ORD'];
$s = "select * from GM43OBJ/buddychkm                
where ordernum =  $ord     and cmpnotes <> ' '                  ";
$r = db2_exec($con, $s);
$rtn= '';
while($row = db2_fetch_assoc($r)){
if (trim($rtn) == ''){
    $rtn =  '<br><b>Order Notes:</b>'; 
}
$rtn .=  '<br><div style="color: red;">'. $row['COMPONENT'] . ' - ' .  $row['CMPNOTES'] . "</div>";
}
echo $rtn;