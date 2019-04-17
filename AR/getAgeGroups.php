<?php
include "../GCon.php";

$user = strtoupper($_SERVER['PHP_AUTH_USER']);
$filename = 'HDINVC_AGE_' . trim($user);


include 'getDefaultsIncl.php';

// priority is not part of this store function at this time.

$s = "select cmcrgn,  AGE_GRP,  sum(invdue) as GDUE, count(*) as GCNT
 from $filename    
where invdue <> 0 and Dayspd is not null $nRegion  $i1 $i2 $i3 $i4 $i5 $i6 $i7 
group by cmcrgn,  AGE_GRP                                         
order by cmcrgn, AGE_GRP                                         ";
$r = db2_exec($con, $s);
//var_dump($con, $s);
$data['SQL'] = $s;
$data['MSG'] = db2_stmt_errormsg();
$savrgn = '';
$x = array();
while($row = db2_fetch_assoc($r)) {
  //  var_dump($savrgn, $row['CMCRGN']);
  //  echo "<br>";
    if (trim($savrgn) !== trim($row['CMCRGN'])){
        if (trim($savrgn) !== ''){
            $data['root'][] = $x;
            $x = array();
        }
    $x['RGN'] = trim($row['CMCRGN']);
    $rgn = trim($row['CMCRGN']);
    $s1 = "Select * from HDCRGN where RGCRGN = '$rgn' fetch first 1 row only";
    $r1 = db2_exec($con, $s1);
    $row1 = db2_fetch_assoc($r1);
    $x['RGNNAME'] = trim($row1['RGCRDS']);
    $savrgn = trim($row['CMCRGN']);
    }
     if (trim($row['AGE_GRP']) == 'CR'){
         $x['GRP_CR_AMT'] = $row['GDUE'];
         $x['GRP_CR_CNT'] = $row['GCNT'];
     }
     if (trim($row['AGE_GRP']) == '0'){
         $x['GRP_0_AMT'] = $row['GDUE'];
         $x['GRP_0_CNT'] = $row['GCNT'];
     }
     if (trim($row['AGE_GRP']) == '1'){
         $x['GRP_1_AMT'] = $row['GDUE'];
         $x['GRP_1_CNT'] = $row['GCNT'];
     }
     if (trim($row['AGE_GRP']) == '2'){
         $x['GRP_2_AMT'] = $row['GDUE'];
         $x['GRP_2_CNT'] = $row['GCNT'];
     }
     if (trim($row['AGE_GRP']) == '3'){
         $x['GRP_3_AMT'] = $row['GDUE'];
         $x['GRP_3_CNT'] = $row['GCNT'];
     }
     if (trim($row['AGE_GRP']) == '4'){
         $x['GRP_4_AMT'] = $row['GDUE'];
         $x['GRP_4_CNT'] = $row['GCNT'];
     }
     if (trim($row['AGE_GRP']) == '5'){
         $x['GRP_5_AMT'] = $row['GDUE'];
         $x['GRP_5_CNT'] = $row['GCNT'];
     }
}
$data['root'][] = $x;
$data['success'] = true;
echo json_encode($data);
// RGN, GRP_CR_AMT, GRP_CR_CNT,GRP_0_AMT, GRP_0_CNT,GRP_1_AMT, GRP_1_CNT,GRP_2_AMT, GRP_2_CNT,GRP_3_AMT, GRP_3_CNT,GRP_4_AMT, GRP_4_CNT,GRP_5_AMT, GRP_5_CNT


function setField($field){
    if (trim($field)== 'RGN') $field = 'CMCRGN';
    
    return $field;
}