  <?php 
  
  function setCopyKit($con, $ord, $reset){
      
 
      
      // if reset clear and reload the primary tables.
      // if not reset check to see if any detail records exist
       
 
  if ($reset){  //Reset Start
    $s = "Delete from GM43OBJ/buddychkm where ordernum = $ord with NC";
    $r = db2_exec($con, $s);
    $s = "Delete from GM43OBJ/buddychkd where ordernum = $ord with NC";
    $r = db2_exec($con, $s);
    $continue = true;
    $copy = true;
    $pattern = true;
    } else {  // reset else
       $continue = false;
       $copy = false;
       $pattern = false;
       
   $s ="SELECT count(*) as cmpcnt FROM BUDDYCHKM f1
           where ordernum = $ord  and   component = 'Copy' ";  
   $r = db2_exec($con, $s);
   $row = db2_fetch_assoc($r);
   if ($row['CMPCNT'] >= 1 ) $copy = false; else $copy = true;
   $s ="SELECT count(*) as cmpcnt FROM BUDDYCHKM f1
   where ordernum = $ord  and   component = 'Pattern' ";
   $r = db2_exec($con, $s);
   $row = db2_fetch_assoc($r);
   if ($row['CMPCNT'] >= 1 ) $pattern = false; else $pattern = true;
   
   if($copy or $pattern) $continue=true;
    } // reset end
  
 if ($continue){  // cont start
  if ($copy){  // copy start
   $s = "SELECT OCORL#, OCCSEQ FROM oeocmt WHERE ocord# = $ord and
    OCCMNT like '***COPYSTART***%' and ocdoct = 'ACK'  fetch first 1 rows only  ";
    $r = db2_exec($con, $s);
   // var_dump($s, db2_stmt_errormsg());
    $row = db2_fetch_assoc($r);
    
    $line = $row['OCORL#'];
    $sseq = $row['OCCSEQ'];
    
    //var_dump('Seq/Line: ', $sseq, $line);
    $s = "SELECT OCORL#, OCCSEQ,occmnt FROM oeocmt WHERE ocord# = $ord and
    OCCMNT like '***COPYEND***%' and ocdoct = 'ACK' and ocorl# = $line
    and occseq > $sseq                                                    ";
    $r = db2_exec($con, $s);
   // var_dump($s, db2_stmt_errormsg());
    $row = db2_fetch_assoc($r);
    
    $lseq = $row['OCCSEQ'];
    
    $s = "SELECT occmnt FROM oeocmt WHERE ocord# = $ord and
    Occseq > $sseq and occseq < $lseq and ocdoct = 'ACK' and ocorl# = $line
    and occmnt <> ' '                                           ";
    $r = db2_exec($con, $s);
    $copy  = "";
    while($row = db2_fetch_assoc($r)){
        $copy .= trim($row['OCCMNT']);
    }
    
    $copy = str_replace(' ', '', $copy);
    $array = str_split($copy);
    $copycount = 0;
    foreach($array as $char) {
        if ($char ==  'i') $copycount += 1;
        $copycount += 1;
    }
    
   
    
    
    
  
    
    $cmp = 'Copy';
    $cmpid = 'C';
    $qty = $copycount;
    $uom = 'EA';
    $notes = $copy;
    
    //var_dump($cmp, $cmpid, $qty, $uom, $notes);
    
    
   
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
        
  }  // copy end
  if ($pattern){ // pat start
      $s = "select oditem,odimds, odqord, cmp, uom, baseqty , F_BRF600($ord) 
from gihdsdata/oeordt                                               
join GM43OBJ/buddykit on oditem = item                              
where odord# = $ord                                              
 and  F_BRF600($ord) = 0                                          ";  
      $r = db2_exec($con, $s);
          
      while ($row = db2_fetch_assoc($r)){
         
          $cmp = $row['CMP'];
          $cmpid = strtoupper(substr($cmp,0,1));
          $qty = ceil(floatval($row['BASEQTY']) * floatval($row['ODQORD']));
          $uom = $row['UOM'];
          $notes = $row['ODIMDS'];
          
      //    var_dump($cmp, $cmpid, $qty, $uom, $notes);
      // need to check the option in HDMFDT for the order to see    
    
       
          
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
          
          
      }
 /*   
      $s = "select * from oeocmt where ocord# = $ord and ocdoct = 'PKL'
and ocorl# = 999                                               ";
      $r = db2_exec($con, $s);
      
      while ($row = db2_fetch_assoc($r)){
          
         $str = $row['OCCMNT']; 
         $a =  explode("-",$str);
         
          
          $cmp = trim($a[1]);
          $cmpid = strtoupper(substr($cmp,0,1));
          $qty = floatval($a[0]);
          $uom = ' ';
          $notes = ' ';
          
     //     var_dump($cmp, $cmpid, $qty, $uom, $notes);
          
          
          
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
       */   
          
      } // pat end
      }  // cont end
        
        
        } // function end
