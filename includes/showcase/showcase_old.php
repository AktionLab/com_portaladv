<?php

$result = mysql_query("SELECT * FROM `enhancedShowcase` WHERE `enhancedShowcaseID`=" . $this->details->showcaseid);
$d = mysql_fetch_assoc($result);
$street = $d['Address'];
$zip   = '81620';
//$city = zip2City($zip);
$state  = 'Colorado';
if ($_GET['Mls_Num']) {
	$_GET['Mls_Num'] = $d['mlsNumber'];
}
$mlsNumber = $d['mlsNumber'];

$room = "showcaseid=".$this->details->showcaseid."&uniqueLoad=".time();

?>

<? include("components/com_portaladv/includes/showcase/swfobject.php"); embedswf("components/com_portaladv/includes/showcase/showcase.swf?".$room, 500, 500); ?>
<!--<div class="tab_box" id="floor" style="display:none;"></div>-->
<?
//print_r($d);
?>

