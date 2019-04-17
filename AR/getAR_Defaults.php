<?php
include "../GCon.php";

$user = strtoupper($_SERVER['PHP_AUTH_USER']);

$s = "Select count(*) as CNT from AGING_DEFAULTS where USR = '$user'";
$r = db2_exec($con, $s);
 
$row = db2_fetch_assoc($r);

$cnt = $row['CNT'];
if (trim($cnt) == '' or $cnt == 0){
    $tag = 'ASOF';
    $tagd = 'As of Date';
    $cdate = new DateTime();
    $tagval = $cdate->format('Y-m-d');
    $s  = "Insert into AGING_DEFAULTS values(
'$user',
'$tag',
'$tagd',
'*TODAY',
'N',
'S',
'AA'
)";
db2_exec($con, $s);  

$tag = 'SAVASOF';
$tagd = 'Last Activity Date ';
$cdate = new DateTime();
$tagval = $cdate->format('Y-m-d');
$s  = "Insert into AGING_DEFAULTS values(
'$user',
'$tag',
'$tagd',
'$tagval',
'N',
'D',
'AB'
)";
db2_exec($con, $s);

$tag = 'BASEON';
$tagd = 'Aging Based On ';
$tagval = 'D';
$s  = "Insert into AGING_DEFAULTS values(
'$user', 
'$tag',
'$tagd',
'$tagval',
'N',
'S',
'AB'
)";
db2_exec($con, $s);

$tag = 'ASOFDIFF';
$tagd = 'As Off Difference ';
$tagval = '0';
$s  = "Insert into AGING_DEFAULTS values(
'$user',
'$tag',
'$tagd',
'$tagval',
'N',
'N',
'AB'
)";
db2_exec($con, $s);
$tag = 'CRTVIEW';
$tagd = 'Create My View ';
$tagval = 'Y';
$s  = "Insert into AGING_DEFAULTS values(
'$user',
'$tag',
'$tagd',
'$tagval',
'N',
'B',
'AB'
)";
db2_exec($con, $s);

$s1 = "select * from hdcrgn ";
$r1 = db2_exec($con, $s1);
//var_dump($s1, db2_stmt_errormsg());
while($row1 = db2_fetch_assoc($r1)){
    $tag = $row1['RGCRGN'];
    $tagd= $row1['RGCRDS'];
    $tagval = 'Y';
    $s  = "Insert into AGING_DEFAULTS values(
    '$user', 
    '$tag',
    '$tagd',
    '$tagval',
'Y',
'B',
'RG'
    )";
    db2_exec($con, $s);
}

$tag = 'PRI1';
$tagd = 'Priority 1 (Invoices > 45 days w/ Must Ship Date) ';
$tagval = 'Y';
$s  = "Insert into AGING_DEFAULTS values(
'$user', 
'$tag',
'$tagd',
'$tagval',
'N',
'B',
'PR'
)";
db2_exec($con, $s);


$tag = 'PRI2';
$tagd = 'Priority 2 (Invoices > 45 days with a Credit Flag) ';
$tagval = 'Y';
$s  = "Insert into AGING_DEFAULTS values(
'$user', 
'$tag',
'$tagd',
'$tagval',
'N',
'B',
'PR'
)";
db2_exec($con, $s);

$tag = 'PRI3';
$tagd = 'Priority 3 (Invoices > 90 days with open events) ';
$tagval = 'Y';
$s  = "Insert into AGING_DEFAULTS values(
'$user', 
'$tag',
'$tagd',
'$tagval',
'N',
'B',
'PR'
)";
db2_exec($con, $s);


$tag = 'PRI4';
$tagd = 'Priority 4 (Invoice date > 90 days without events) ';
$tagval = 'Y';
$s  = "Insert into AGING_DEFAULTS values(
'$user', 
'$tag',
'$tagd',
'$tagval',
'N',
'B',
'PR'
)";
db2_exec($con, $s);

$tag = 'PRI99';
$tagd = 'Priority 99 unassigned priority ';
$tagval = 'Y';
$s  = "Insert into AGING_DEFAULTS values(
'$user',
'$tag',
'$tagd',
'$tagval',
'N',
'B',
'PR'
)";
db2_exec($con, $s);

$tag = 'PRI1C';
$tagd = 'Priority 1 Color ';
$tagval = '#fed0a3';
$s  = "Insert into AGING_DEFAULTS values(
'$user', 
'$tag',
'$tagd',
'$tagval',
'N',
'C',
'PZ'
)";
db2_exec($con, $s);

$tag = 'PRI2C';
$tagd = 'Priority 2 Color ';
$tagval = '#fee2a3';
$s  = "Insert into AGING_DEFAULTS values(
'$user', 
'$tag',
'$tagd',
'$tagval',
'N',
'C',
'PZ'
)";
db2_exec($con, $s);

$tag = 'PRI3C';
$tagd = 'Priority 3 Color ';
$tagval = '#919fd3';
$s  = "Insert into AGING_DEFAULTS values(
'$user', 
'$tag',
'$tagd',
'$tagval',
'N',
'C',
'PZ'

)";
db2_exec($con, $s);


$tag = 'PRI4C';
$tagd = 'Priority 4 Color ';
$tagval = '#85ebcd';
$s  = "Insert into AGING_DEFAULTS values(
'$user', 
'$tag',
'$tagd',
'$tagval',
'N',
'C',
'PZ'
)";
db2_exec($con, $s);


$tag = 'INCLCRED';
$tagd = 'Include Credits ';
$tagval = 'Y';
$s  = "Insert into AGING_DEFAULTS values(
'$user',
'$tag',
'$tagd',
'$tagval',
'Y',
'B',
'AB'
)";
db2_exec($con, $s);
$tag = 'INCLCUR';
$tagd = 'Include Current ';
$tagval = 'Y';
$s  = "Insert into AGING_DEFAULTS values(
'$user',
'$tag',
'$tagd',
'$tagval',
'Y',
'B',
'AB'
)";
db2_exec($con, $s);

$tag = 'INCL115';
$tagd = 'Include 1-15 ';
$tagval = 'Y';
$s  = "Insert into AGING_DEFAULTS values(
'$user',
'$tag',
'$tagd',
'$tagval',
'Y',
'B',
'AB'
)";
db2_exec($con, $s);

$tag = 'INCL1630';
$tagd = 'Include 16-30 ';
$tagval = 'Y';
$s  = "Insert into AGING_DEFAULTS values(
'$user',
'$tag',
'$tagd',
'$tagval',
'Y',
'B',
'AB'
)";
db2_exec($con, $s);

$tag = 'INCL31-60';
$tagd = 'Include 31-60 ';
$tagval = 'Y';
$s  = "Insert into AGING_DEFAULTS values(
'$user',
'$tag',
'$tagd',
'$tagval',
'Y',
'B',
'AB'
)";
db2_exec($con, $s);


$tag = 'INCL6190';
$tagd = 'Include 61-90 ';
$tagval = 'Y';
$s  = "Insert into AGING_DEFAULTS values(
'$user',
'$tag',
'$tagd',
'$tagval',
'Y',
'B',
'AB'
)";
db2_exec($con, $s);

$tag = 'INCL90';
$tagd = 'Include Over 90 ';
$tagval = 'Y';
$s  = "Insert into AGING_DEFAULTS values(
'$user',
'$tag',
'$tagd',
'$tagval',
'Y',
'B',
'AB'
)";
db2_exec($con, $s);

}

$sd = "Select TAGV from AGING_DEFAULTS where TAG='ASOFDATE' and USR = '$user'";
$rd = db2_exec($con, $sd);
$rowd = db2_fetch_assoc($rd);
$asof = $rowd['TAGV'];

if (trim($asof) == '*TODAY'){
    $cdate = new DateTime();
    $asofdate = $cdate->format('Y-m-d');
    $sd2 = "Select TAGV from AGING_DEFAULTS where TAG='SAVASOF' and USR = '$user'";
    $rd2 = db2_exec($con, $sd2);
    $rowd2 = db2_fetch_assoc($rd2);
    $savasof = $rowd2['TAGV'];
    if (trim($asofdate) !== trim($savasof)){
        $s = "Update AGING_DEFAULTS set TAGV = 'Y' where Tag = 'CRTVIEW' and USR = '$user' with NC";
        $r = db2_exec($con, $s);
        $s = "Update AGING_DEFAULTS set TAGV = '$asofdate' where Tag = 'SAVASOF' and USR = '$user' with NC";
        $r = db2_exec($con, $s);
        $s = "Update AGING_DEFAULTS set TAGV = '0' where Tag = 'ASOFDIFF' and USR = '$user' with NC";
        $r = db2_exec($con, $s);
    }
}






$s = "Select * from AGING_DEFAULTS where USR = '$user' and TAGACTIVE = 'Y' ORDER by DFTGRP, TAG";
$r = db2_exec($con, $s);

while($row = db2_fetch_assoc($r)){
    $x['USR'] = $user;
    $x['TAG'] = $row['TAG'];
    $x['TAGD'] = $row['TAGD'];
    $x['TAGV'] = $row['TAGV'];
    if ($row['TAGACTIVE'] == 'Y'){
        $x['TAGACTIVE'] = true;
    } else {
        $x['TAGACTIVE'] = false;
    }
    
    $data['root'][] = $row;
    
}
 
 
 

 
$data['success'] = true;
echo json_encode($data);






 




   