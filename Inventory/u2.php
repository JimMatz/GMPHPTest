<?php
 


error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

//$path2 = '/www/zendsvr/htdocs/phpoffice';
//set_include_path(get_include_path() . PATH_SEPARATOR . $path2);
//$path3 = '/www/zendsvr/htdocs/phpoffice/phpword/Collection';
//set_include_path(get_include_path() . PATH_SEPARATOR . $path3);



require '/www/zendsvr/htdocs/phpof1/vendor/phpoffice/phpspreadsheet/IOFactory.php';



 
$inputFileName = 'Uploads/inv.xlsx';

/** Create a new Xls Reader  **/
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

var_dump($reader);







 