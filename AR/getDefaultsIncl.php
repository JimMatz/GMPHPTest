<?php
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
$pri = '';
$cp = '';
$crtview = false;

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
    
    if (trim($tag) == 'CRTVIEW' and trim($tagv) == 'Y') {
        $crtview = true;
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
        $pri .= "'$tag'" . $cp;
        $cp = ', ';
    }
    if (trim($tag) == 'PRI2' and trim($tagv) == 'N') {
        $pri .= "'$tag'" . $cp;
        $cp = ', ';
    }
    if (trim($tag) == 'PRI3' and trim($tagv) == 'N') {
        $pri .= "'$tag'" . $cp;
        $cp = ', ';
    }
    if (trim($tag) == 'PRI4' and trim($tagv) == 'N') {
        $pri .= "'$tag'" . $cp;
        $cp = ', ';
    }
    if (trim($tag) == 'PRI99' and trim($tagv) == 'N') {
        $pri .= "'$tag'" . $cp;
        $cp = ', ';
    }
}
$nRegion = '';
if (trim($rgn) !== ''){
    $nRegion = " and CMCRGN not in ($rgn) ";
}

