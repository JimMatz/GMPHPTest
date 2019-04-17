<?php
$currentDir = getcwd();
$uploadDirectory = "/uploads/";
//var_dump($_FILES);
//var_dump($_POST);
$target_dir = "/";
$fileName = $_FILES["inFile"]["name"];
$fileSize = $_FILES['inFile']['size'];
$fileTmpName  = $_FILES['inFile']['tmp_name'];
$fileType = $_FILES['inFile']['type'];
$fileExtension = strtolower(end(explode('.',$fileName)));

$uploadPath = $currentDir . $uploadDirectory . 'inv.xlsx';
//var_dump($fileTmpName, $uploadPath);
// Check if image file is a actual image or fake image
$didUpload = move_uploaded_file($fileTmpName, $uploadPath);

if ($didUpload) {
    $data['success'] = true;
    $data['msg'] ="The file " . basename($fileName) . " has been uploaded";





error_reporting(E_ALL);
ini_set('display_errors', false);
ini_set('display_startup_errors', false);


include "../GCon.php";
$inwhs = $_POST['inWhs'];
if (isset($_POST['upBatch']))$upBatch = $_POST['upBatch']; else $upBatch = 'N';
$s = "Select * from GIHDSDATA/ivphtg where ppwhs = $inwhs fetch first 1 row only";
$r = db2_exec($con, $s);
$row = db2_fetch_assoc($r);

$cgroup = $row['PPCYCL'];

$PBCYCL = $row['PPCYCL'];  // count group
$PBCDAT = $row['PPCDAT'] ;                   // count date
$PBWHS  = $inwhs;                     // count whs
$PBPLT  = $row['PPPLT'];                     // count plant
$PBBCH   = $inwhs;                   // count batch
$PBSTAT = 'A';                     // count status
$PBBDAT = $PBCDAT;                     // date counted
$PBEDIT   = 0;                   // date edited
$PBLUPD   =0;                  // date updated
$PBLOAD   =0;                   // date loaded
$PBRECL   =0;                   // total tags
$PBQTYL   =0;                   // total qty counted


if (trim($upBatch) !== 'Y'){
$si = "Insert into IVPHBT values(
'$PBCYCL',
$PBCDAT,
$PBWHS,
$PBPLT,
$PBBCH,
'$PBSTAT',
$PBBDAT,
$PBEDIT,
$PBLUPD,
$PBLOAD,
$PBRECL,
$PBQTYL
) with NC";
    $ri = db2_exec($con, $si);
    //var_dump($si,db2_stmt_errormsg());
$data['batch'] = $inwhs.'-'.  $si.'-'. db2_stmt_errormsg();
}
/** Include PHPExcel */
require_once '/www/Zendsvr/htdocs/Gemini/Classes/PHPExcel.php';




$inputFileName = 'Uploads/inv.xlsx';

$excelReader = PHPExcel_IOFactory::createReaderForFile($inputFileName);
$excelObj = $excelReader->load($inputFileName);
$worksheet = $excelObj->getSheet(0);
$lastRow = $worksheet->getHighestRow();


 $rcnt = 0;
 $rttl = 0;
for ($row = 5; $row <= $lastRow; $row++) {
 
    $item =  $worksheet->getCell('A'.$row)->getValue();

    $cnt =  $worksheet->getCell('O'.$row)->getValue();
    if (trim($cnt) !== '') {
 //   var_dump($item, $cnt);
    $s = "Update GIHDSDATA/ivphtg set
    ppbch# = $inwhs,
    ppbdte = $PBBDAT,
    pppage = 1,
    pptint = 'UP',
    ppcint = 'UP',
    ppws = 'UPLOAD',
    ppuser = 'GMSYS',
    pptime = 063144,
    ppdate = $PBBDAT,
    ppucod = 'U',
    ppqty = $cnt
    where ppwhs = $inwhs  and PPITEM = '$item'
and exists(Select * from  GIHDSDATA/ivphtg where ppwhs = $inwhs  and PPITEM = '$item')
with NC";
    $r = db2_exec($con, $s);
    if (!$r){
    var_dump($s, db2_stmt_errormsg());
    }
    
    $data['rec'][] =   $s.'-'. db2_stmt_errormsg();
    
    $rcnt += 1;
    $rttl += $cnt;
    }
}
$s1 = "Select sum(PPQTY) as TTL, count(*) as CNT from GIHDSDATA/IVPHTG where ppbch# = $inwhs";
$r1 = db2_exec($con, $s1);
$row1 = db2_fetch_assoc($r1);
$ttl = $row1['TTL'];
$cnt = $row1['CNT'];
$msg2 = '';
if ($rcnt <> $cnt) $msg2 = '  Tag Counts do not match'; else $msg2 = '';
$s = "update ivphbt set pbrecl = $rcnt, pbqtyl = $rttl;
WHERE PBBCH# = $inwhs with NC";
$r = db2_exec($con, $s);

$data['msg'] .= " Count of $cnt total qty of $ttl $msg2";

} else {
    $data['success'] = false;
    $data['msg'] ="An error occurred somewhere. Try again or contact the admin";

}

echo json_encode($data);