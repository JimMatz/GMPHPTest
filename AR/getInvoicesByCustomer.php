<?php
error_reporting(E_ALL);
ini_set('details_errors', TRUE);
ini_set('details_startup_errors', TRUE);
ini_set('memory_limit', '-1');
ini_set('time_limit', '180');
ignore_user_abort();
header("Access-Control-Allow-Origin: *");
date_default_timezone_set('America/Chicago');
include "../GCon.php";

$user = strtoupper($_SERVER['PHP_AUTH_USER']);
$filename = 'HDINVC_AGE_' . trim($user);
$cust = $_GET['CUST'];
$grp = $_GET['GRP'];
if (trim($grp) !== 'ALL'){
    $filename .= "_$grp";
}

$sd = "Select TAGV from AGING_DEFAULTS where TAG='ASOFDIFF' and USR = '$user'";
$rd = db2_exec($con, $sd);
//var_dump($sd, db2_stmt_errormsg());
$rowd = db2_fetch_assoc($rd);
$diff = trim($rowd['TAGV']);
// include 'getDefaultsIncl.php';

// $i1 $i2 $i3 $i4 $i5 $i6 $i7

if (trim($grp) == 'ALL'){
    $s = "Select IVAIV#, IVBLTO, IVCUST, F_DATCNV(IVIVDT) as INVDT,IVIVDT as IVD, IVSEQ#,
IVTRMS, CMCTRM, DAYSPD, AGE_GRP, IVIVAM, IVNPOS, INVDUE, CMCNA1, CMCNA2, CMCNA3, CMCNA4, CMCCTY, CMST, CMZIP, CMCRGN
 from $filename 
where IVBLTO = $cust AND INVDUE <> 0  ";
} else{
$s = "Select IVAIV#, IVBLTO, IVCUST, F_DATCNV(IVIVDT) as INVDT,IVIVDT as IVD, IVSEQ#,
IVTRMS, CMCTRM, DAYSPD, AGE_GRP, IVIVAM, IVNPOS, INVDUE, CMCNA1, CMCNA2, CMCNA3, CMCNA4, CMCCTY, CMST, CMZIP, CMCRGN
 from $filename 
 
where IVBLTO = $cust and INVDUE <> 0 and AGE_GRP = '$grp'   ";
}
//var_dump($s);
$r = db2_exec($con, $s);
$msg1 = db2_stmt_errormsg();
while($row = db2_fetch_assoc($r)){
    $x['IVAIV']  = $row['IVAIV#'];
    $x['IVBLTO']  = $row['IVBLTO'] ;
    $x['IVCUST']  = $row['IVCUST'];
    $x['IVIVDT']  = $row['INVDT'];
    $x['IVD']  = $row['IVD'];
    $x['IVSEQ']  = $row['IVSEQ#'] ;
    $x['IVTRMS']  = $row['IVTRMS'] ;
    $x['CMCTRM']  = $row['CMCTRM'] ;
    $x['DAYSPD']  = $row['DAYSPD'] + $diff ;
    $x['AGE_GRP'] = $row['AGE_GRP'] ;
    $x['IVIVAM']  = $row['IVIVAM'] ;
    $x['IVNPOS']  = $row['IVNPOS'] ;
    $x['INVDUE']  = $row['INVDUE'];
    $x['CMCNA1']  = $row['CMCNA1'] ;
    $x['CMCNA2']  = $row['CMCNA2'] ;
    $x['CMCNA3']  = $row['CMCNA3'] ;
    $x['CMCNA4']  = $row['CMCNA4'] ;
    $x['CMCCTY']  = $row['CMCCTY'];
    $x['CMST']    = $row['CMST'] ;
    $x['CMZIP']   = $row['CMZIP'] ;
    $x['CMCRGN']  = $row['CMCRGN']; 
   
    if ($row['IVCUST'] !== $row['IVBLTO']){
    $ivcust = $row['IVCUST'];
    $s1 = "Select * from hdcust on where cmcust = $ivcust ";
    $r1 = db2_exec($con, $s1);
    $msg2 = db2_stmt_errormsg();
    $row1 = db2_exec($con, $s);
    $x['SHPNA1']  = $row1['CMCNA1'] ;
    $x['SHPNA2']  = $row1['CMCNA2'] ;
    $x['SHPNA3']  = $row1['CMCNA3'] ;
    $x['SHPNA4']  = $row1['CMCNA4'] ;
    $x['SHPCTY']  = $row1['CMCCTY'];
    $x['SHPST']    = $row1['CMST'] ;
    $x['SHPZIP']   = $row1['CMZIP'] ;
    } else {
        $x['SHPNA1']  = ' ' ;
        $x['SHPNA2']  = ' ' ;
        $x['SHPNA3']  = ' ' ;
        $x['SHPNA4']  = ' ' ;
        $x['SHPCTY']  = ' ' ;
        $x['SHPST']    = ' ' ;
        $x['SHPZIP']   = ' ' ;
    }
    
    $contcount = 0;
    $mindate = '2099-12-31';
    $scont = "SELECT  * FROM CRCEVM
    LEFT JOIN CRCNTM ON EMCONT = CRCONT
    WHERE   CRCUST = $cust  ";
    $rcont = db2_exec($con, $scont);
    $desc = ' ';
    while ($rowcont = db2_fetch_assoc($rcont)){
        if (trim($rowcont['EMCMPD']) == '0001-01-01' and (trim($rowcont['EMEVNT']) == 'COLLECTION' or trim($rowcont['EMEVNT']) == 'RETURN')){
            $contcount +=1;
            if (trim($rowcont['EMEVTD']) < $mindate) {
                $mindate = $rowcont['EMEVTD'];
            }
            $ed = '';
            if (isToday($rowcont['EMEVTD'])){
                $pstyle = "style='color: red; background-color: yellow;'";
            } else {
                $pstyle = ' ';
                
            }
            if (trim($rowcont['EMEVNT']) == 'RETURN'){
                $pstyle = "style='color: black; background-color: lightBlue;'";
                $ed = " (Return ACH Payment) ";
            }
            
            $desc .=  "<p $pstyle>" . $rowcont['EMEVTD'] . ' - '. $ed . ' ' .trim($rowcont['EMDESC']) . '</p>';
        }
        //var_dump($scont, db2_stmt_errormsg() );
    }
    
    //$contcount = $rowcont['CNT'];
    if ($contcount == 0) $ccount = 'false'; else $ccount = $mindate;
    $x['EVCOUNT'] = $ccount;
    $x['EVDESC'] = $desc;
    
    
    $data['root'][] = $x;
}

$data['success'] = true;
$msg1 = preg_replace('~[\r\n]+~', ' ', $msg1);
//$msg2 = preg_replace('~[\r\n]+~', ' ', $msg2);
$s = preg_replace('~[\r\n]+~', ' ', $s);
$data['msg1'] = $msg1;
//$data['msg2'] = $msg2;
 
$data['sql1'] = $s;
echo json_encode($data);

//IVAIV, IVSEQ, IVBLTO, IVCUST, IVIVDT, IVTRMS, CMCTRM, DAYSPD, AGE_GRP, IVIVAM, IVNPOS, INVDUE, CMCNA1, CMCNA2, CMCNA3, CMCNA4, CMCCTY, CMST, CMZIP, CMCRGN
// SHPNA1, SHPNA2, SHPNA3, SHPNA4, SHPCTY, SHPST, SHPZIP 
// EVCOUNT, EVDESC



function isToday($time) // midnight second
{
    return (strtotime($time) <= strtotime('today'));
}