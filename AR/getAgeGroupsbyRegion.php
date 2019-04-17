<?php
include "../GCon.php";
$inrgn = $_GET['RGN'];


$user = strtoupper($_SERVER['PHP_AUTH_USER']);
$filename = 'HDINVC_AGE_' . trim($user);

$ingrp = trim($_GET['GRP']);
$igrp = "";
if ($ingrp == '' or $ingrp == 'ALL') {
    
} else {

$filename .= "_$ingrp";
}
//var_dump('igrp: ', $igrp, $ingrp);

$s = "Select * from AGING_DEFAULTS where usr = '$user'";
$r= db2_exec($con, $s);
$rgn = '';
$c = '';
$i1 = '';
$i2 = '';
$i3 = '';
$i4 = '';
$i5 = '';
$i6 = '';
$i7 = '';
$pri1 = 'Y';
$pri2 = 'Y';
$pri3 = 'Y';
$pri4 = 'Y';
$pri99 = 'Y';
$diff = 0;
while ($row = db2_fetch_assoc($r)){
    $tag = $row['TAG'];
    $tagv = $row['TAGV'];
    if (trim($tag) == 'CANAD' and trim($tagv) == 'N') {
        $rgn .= "'$tag'" . $c;
        $c = ', ';
    }
    
    if (trim($tag) == 'DIXIE' and trim($tagv) == 'N') {
        $rgn .= "'$tag'". $c;
        $c = ', ';
    }
    if (trim($tag) == 'GRTPL' and trim($tagv) == 'N') {
        $rgn .= "'$tag'" . $c;
        $c = ', ';
    }
    if (trim($tag) == 'GULF' and trim($tagv) == 'N') {
        $rgn .= "'$tag'". $c;
        $c = ', ';
    }
    if (trim($tag) == 'HOUSE' and trim($tagv) == 'N') {
        $rgn .= "'$tag'". $c;
        $c = ', ';
    }
    if (trim($tag) == 'INTL' and trim($tagv) == 'N') {
        $rgn .= "'$tag'" . $c;
        $c = ', ';
    }
    if (trim($tag) == 'MDWST' and trim($tagv) == 'N') {
        $rgn .= "'$tag'". $c;
        $c = ', ';
    }
    if (trim($tag) == 'NWENG' and trim($tagv) == 'N') {
        $rgn .= "'$tag'". $c;
        $c = ', ';
    }
    if (trim($tag) == 'PACNW' and trim($tagv) == 'N') {
        $rgn .= "'$tag'" . $c;
        $c = ', ';
    }
    if (trim($tag) == 'TEXAS' and trim($tagv) == 'N') {
        $rgn .= "'$tag'". $c;
        $c = ', ';
    }
    if (trim($tag) == 'WEST' and trim($tagv) == 'N') {
        $rgn .= "'$tag'" . $c;
        $c = ', ';
    }
   
    if (trim($tag) == 'ASOFDIFF') {
        $diff = (int)$tagv;
    }
    
    if (trim($tag) == 'INCLCRED' and trim($tagv) == 'N') {
        $i1 = " and AGE_GRP <> 'CR' ";  
    }
    if (trim($tag) == 'INCLCUR' and trim($tagv) == 'N') {
        $i2 = " and AGE_GRP <> '0' ";
    }
    if (trim($tag) == 'INCL115' and trim($tagv) == 'N') {
        $i3 = " and AGE_GRP <> '1' ";
    }
    if (trim($tag) == 'INCL1630' and trim($tagv) == 'N') {
        $i4 = " and AGE_GRP <> '2' ";
    }
    if (trim($tag) == 'INCL31-60' and trim($tagv) == 'N') {
        $i5 = " and AGE_GRP <> '3' ";
    }
    if (trim($tag) == 'INCL6190' and trim($tagv) == 'N') {
        $i6 = " and AGE_GRP <> '4' ";
    }
    if (trim($tag) == 'INCL90' and trim($tagv) == 'N') {
        $i7 = " and AGE_GRP <> '5' ";
    }
    
    if (trim($tag) == 'PRI1' and trim($tagv) == 'N') {
        $pri1 = trim($tagv);
    }
    if (trim($tag) == 'PRI2' and trim($tagv) == 'N') {
         $pri2 = trim($tagv);
    }
    if (trim($tag) == 'PRI3' and trim($tagv) == 'N') {
        $pri3 = trim($tagv);
    }
    if (trim($tag) == 'PRI4' and trim($tagv) == 'N') {
        $pri4 = trim($tagv);
    }
    if (trim($tag) == 'PRI99' and trim($tagv) == 'N') {
        $pri99 = trim($tagv);
        
    }
    if (trim($tag) == 'PRI1C' ) {
        $pri1c = trim($tagv);
    }
    if (trim($tag) == 'PRI2C' ) {
        $pri2c = trim($tagv);
    }
    if (trim($tag) == 'PRI3C' ) {
        $pri3c = trim($tagv);
    }
    if (trim($tag) == 'PRI4C' ) {
        $pri4c = trim($tagv);
    }
    
}
$nRegion = '';
if (trim($rgn) !== ''){
    $nRegion = " and CMCRGN not in ($rgn) ";
}

 





$s = "

select ivblto, cmcna1, count(*) as GCNT,                              
  sum(invdue) as GDUE,  
  IVPRI,
Age_Grp
 from 
$filename                                           
                                                     
where invdue <> 0 $igrp  and cmcrgn = '$inrgn'   $i1 $i2 $i3 $i4 $i5 $i6 $i7             
  group by ivblto, cmcna1, AGE_GRP, IVPRI                 
order by ivblto, Age_Grp  ";
//group by ivblto, cmcna1, age_grp, ivaiv#, ivivdt, ivseq#, dayspd 
$r = db2_exec($con, $s);
$msg1 = db2_stmt_errormsg();
$msg1 = preg_replace('~[\r\n]+~', ' ', $msg1);
$s = preg_replace('~[\r\n]+~', ' ', $s);
$data['SQL1'] = $s;
$data['MSG1'] = $msg1;
//var_dump($s, db2_stmt_errormsg());
$savblto = '';
$savpri = 100;
$x = array();
//var_dump($pri1, $pri2, $pri3, $pri4, $pri99);
while($row = db2_fetch_assoc($r)) {
  //  var_dump($savblto, $row['IVBLTO']);
  //  echo "<br>";
    $priority = trim($row['IVPRI']);
    if (trim($priority) == '1'  ) $pric = $pri1c;
    if (trim($priority) == '2'  ) $pric = $pri2c;
    if (trim($priority) == '3'  ) $pric = $pri3c;
    if (trim($priority) == '4'  ) $pric = $pri4c;
    if (trim($priority) == '99'  ) $pric = '';
  // if the prioirty  is set to display 
  // $pri will = 'Y';
  
    $pri = true;

    
    
    
    
    if (trim($priority) == '1' and $pri1 == 'N') $pri = false;
    if (trim($priority) == '2' and $pri2 == 'N') $pri = false;
    if (trim($priority) == '3' and $pri3 == 'N') $pri = false;
    if (trim($priority) == '4' and $pri4 == 'N') $pri = false;
    if (trim($priority) == '99' and $pri99 == 'N') $pri = false;
   // var_dump('Priority: ', $priority, $pri);
    if ($pri){
    if (trim($savblto) !== trim($row['IVBLTO'])){
        if (trim($savblto) !== ''){
            $data['root'][] = $x;
            $x = array();
        }
        
        
    
        
    $x['IVBLTO'] = trim($row['IVBLTO']);
    $x['CMCNA1'] = trim($row['CMCNA1']);
    $x['IVPRI'] = trim($row['IVPRI']);
    $x['IVPRICOL'] = trim($pric);
   // $x['CT'] = $custTotal;
    $savblto = trim($row['IVBLTO']);
    $custTotal = 0;
    $savpri = 100;
    }
    if ($row['IVPRI'] < $savpri){
        $x['IVPRI'] = trim($row['IVPRI']);
        $savpri = $row['IVPRI'];
    }
    $custTotal = $custTotal + $row['GDUE'];
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
} // end exclude priority
}
$data['root'][] = $x;
$data['success'] = true;
echo json_encode($data);
// IVBLTO, CMCNA1, IVPRI, GRP_CR_AMT, GRP_CR_CNT,GRP_0_AMT, GRP_0_CNT,GRP_1_AMT, GRP_1_CNT,GRP_2_AMT, GRP_2_CNT,GRP_3_AMT, GRP_3_CNT,GRP_4_AMT, GRP_4_CNT,GRP_5_AMT, GRP_5_CNT, CT