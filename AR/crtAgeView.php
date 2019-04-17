<?php
include "../GCon.php";
$user = strtoupper($_SERVER['PHP_AUTH_USER']);

$filename = 'HDINVC_AGE_' . trim($user);

$sd = "Select TAGV from AGING_DEFAULTS where TAG='ASOFDIFF' and USR = '$user'";
$rd = db2_exec($con, $sd);
//var_dump($sd, db2_stmt_errormsg());
$rowd = db2_fetch_assoc($rd);
$diff = trim($rowd['TAGV']);
$s = "Drop view GIHDSDATA/$filename";
$r = db2_exec($con, $s);

    $s = "CREATE OR REPLACE VIEW GIHDSDATA/$filename AS
    SELECT IVAIV#, IVBLTO, IVCUST,
    IVIVDT, IVSEQ#, IVTRMS, HDCUST.CMCTRM,
    ((DPD - $diff) * -1) AS DAYSPD,
   F_ARAGEGRP(((DPD -$diff) * -1)  , INVDUE) AS AGE_GRP,
   F_ARPRI2(ivblto, ivaiv#,  (DPD -$diff) * -1, ivivdt,ivseq#) as IVPRI,
    IVIVAM, IVNPOS, INVDUE, HDCUST.CMCNA1,
    HDCUST.CMCNA2, HDCUST.CMCNA3, HDCUST.CMCNA4, HDCUST.CMCCTY,
    HDCUST.CMST, HDCUST.CMZIP, HDCUST.CMCRGN FROM HDINVC_EXP LEFT JOIN
    HDCUST ON IVBLTO = CMCUST AND DPD IS NOT NULL ";
    $r = db2_exec($con, $s);
    
    $filenamex  = $filename . '_CR';
    $s = "Drop view GIHDSDATA/$filenamex";
    $r = db2_exec($con, $s);
    $s = "create or replace view gihdsdata/$filenamex as
    Select * from $filename
    where age_grp = 'CR'   ";
    $r = db2_exec($con, $s);
    
    $filenamex  = $filename . '_0';
    $s = "Drop view GIHDSDATA/$filenamex";
    $r = db2_exec($con, $s);
    $s = "create or replace view gihdsdata/$filenamex as
    Select * from $filename
    where age_grp = '0'   ";
    $r = db2_exec($con, $s);
    
    $filenamex  = $filename . '_1';
    $s = "Drop view GIHDSDATA/$filenamex";
    $r = db2_exec($con, $s);
    $s = "create or replace view gihdsdata/$filenamex as
    Select * from $filename
    where age_grp = '1'   ";
    $r = db2_exec($con, $s);
    
    $filenamex  = $filename . '_2';
    $s = "Drop view GIHDSDATA/$filenamex";
    $r = db2_exec($con, $s);
    $s = "create or replace view gihdsdata/$filenamex as
    Select * from $filename
    where age_grp = '2'   ";
    $r = db2_exec($con, $s);
    
    $filenamex  = $filename . '_3';
    $s = "Drop view GIHDSDATA/$filenamex";
    $r = db2_exec($con, $s);
    $s = "create or replace view gihdsdata/$filenamex as
    Select * from $filename
    where age_grp = '3'   ";
    $r = db2_exec($con, $s);
    
    $filenamex  = $filename . '_4';
    $s = "Drop view GIHDSDATA/$filenamex";
    $r = db2_exec($con, $s);
    $s = "create or replace view gihdsdata/$filenamex as
    Select * from $filename
    where age_grp = '4'   ";
    $r = db2_exec($con, $s);
    
    
    $filenamex  = $filename . '_5';
    $s = "Drop view GIHDSDATA/$filenamex";
    $r = db2_exec($con, $s);
    $s = "create or replace view gihdsdata/$filenamex as
Select * from $filename            
where age_grp = '5'   ";
    $r = db2_exec($con, $s);
    
 $data['SQLMSG'] = db2_stmt_errormsg();   
 $data['SQL'] = $s;
 if (trim($data['SQLMSG']) == ''){
     $data['msg'] = 'Your View has been Created';
 } else {
     $data['msg'] = $data['SQLMSG'];
 }
    //var_dump($s, db2_stmt_errormsg());
    
    $s = "Update AGING_DEFAULTS set TAGV = 'N' where Tag = 'CRTVIEW' and USR = '$user' with NC";
    $r = db2_exec($con, $s);
    

    $data['success'] = true;
   
    
    
    echo json_encode($data);
    