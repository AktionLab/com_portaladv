<?php
$db = mysql_connect("65.61.159.160", "beaver", "C4yHksfv");
mysql_select_db("mountainestates",$db);
//$_GET[showcaseID] = 56729; // testing

$sqlCase = "SELECT enhancedShowcaseMemberID, enhancedShowcaseTitle FROM enhancedShowcase WHERE enhancedShowcaseID = '$_GET[showcaseID]'";
$resultCase = mysql_query($sqlCase);
$myrowCase = mysql_fetch_row($resultCase);
print_r($myrowCase);
$showcaseData = "title=".str_replace(" ", "+", $myrowCase[1])."&";

$sqlColor = "SELECT newmembers.id, newmembers.membersColorTableID,
enhancedShowcaseColorTable.colortableid, enhancedShowcaseColorTable.fontcolor, enhancedShowcaseColorTable.backred, enhancedShowcaseColorTable.backgreen, enhancedShowcaseColorTable.backblue, enhancedShowcaseColorTable.insidered, enhancedShowcaseColorTable.insidegreen, enhancedShowcaseColorTable.insideblue, enhancedShowcaseColorTable.headerred, enhancedShowcaseColorTable.headergreen, enhancedShowcaseColorTable.headerblue
FROM newmembers, enhancedShowcaseColorTable
WHERE newmembers.id = '$myrowCase[0]' && newmembers.membersColorTableID = enhancedShowcaseColorTable.colortableid";
$resultColor = mysql_query($sqlColor) or die(mysql_error());
$myrowColor = mysql_fetch_array($resultColor);
if ($myrowColor[colortableid]) {
$showcaseData .= "fontcolor=$myrowColor[fontcolor]&backred=255&backgreen=255&blackblue=255&insidered=255&insidegreen=255&insideblue=255&headerred=255&headergreen=255&headerblue=255&";
} else {
$showcaseData .= "fontcolor=0x47496B&backred=255&backgreen=255&blackblue=255&insidered=255&insidegreen=255&insideblue=255&headerred=255&headergreen=255&headerblue=255&";
}

$sqlFloors = "SELECT enhancedShowcaseFloorplanID, enhancedShowcaseFloorplanTitle, enhancedShowcaseFloorplanStartW, enhancedShowcaseFloorplanSource, enhancedShowcaseFloorplanNumber, enhancedShowcaseFloorplanStartX, enhancedShowcaseFloorplanStartY, enhancedShowcaseFloorplanPointW, enhancedShowcaseFloorplanPointH
FROM enhancedShowcaseFloorplan
WHERE enhancedShowcaseFloorplanShowcaseID = '$_GET[showcaseID]'
ORDER BY enhancedShowcaseFloorplanNumber";
$resultFloors = mysql_query($sqlFloors);
$totalFloors = mysql_num_rows($resultFloors);
$showcaseData .= "floorplancount=$totalFloors&";
$planNum = 1;
while ($myrowFloors = mysql_fetch_array($resultFloors)) {
$showcaseData .= "plantitle_$planNum=".str_replace(" ", "+", $myrowFloors[enhancedShowcaseFloorplanTitle])."&plansource_$planNum=$myrowFloors[enhancedShowcaseFloorplanSource]&".
"floorplanid_$planNum=$myrowFloors[enhancedShowcaseFloorplanID]&".
"planstartx_$planNum=$myrowFloors[enhancedShowcaseFloorplanStartX]&".
"planstarty_$planNum=$myrowFloors[enhancedShowcaseFloorplanStartY]&".
"planstartw_$planNum=$myrowFloors[enhancedShowcaseFloorplanStartW]&".
"pointh_$planNum=$myrowFloors[enhancedShowcaseFloorplanPointH]&".
"pointw_$planNum=$myrowFloors[enhancedShowcaseFloorplanPointW]&";

//&numberofpointsinplan_$planNum=2";
$sqlPos = "SELECT * FROM enhancedShowcaseFloorplanPosition, enhancedShowcaseImage
WHERE enhancedShowcaseFloorplanPositionFloorplanID = '$myrowFloors[enhancedShowcaseFloorplanID]'
&& enhancedShowcaseFloorplanPosition.enhancedShowcaseFloorplanPositionID = enhancedShowcaseImage.enhancedShowcaseImageMapPositionID
ORDER BY enhancedShowcaseFloorplanPosition, enhancedShowcaseImageTypeID";
$resultPos = mysql_query($sqlPos);
$positionCount = 0;
while ($myrowPos = mysql_fetch_array($resultPos)) {
  //echo "Type: ".$myrow[enhancedShowcaseImageTypeID]."<br>\n";
	if ($myrowPos[enhancedShowcaseImageTypeID] == '1') { // thumb Info
	  ++$positionCount;
	  //echo "Type: ".$myrowPos[enhancedShowcaseFloorplanPositionTypeID]."<br>\n";
		if ($myrowPos[enhancedShowcaseFloorplanPositionTypeID] == '1' || $myrowPos[enhancedShowcaseFloorplanPositionTypeID] == '0') {
		$positiontype = "image";
		} elseif ($myrowPos[enhancedShowcaseFloorplanPositionTypeID] == '2') {
		$positiontype = "panview";
		}
	$showcaseData .= "x_$planNum"."_$positionCount=$myrowPos[enhancedShowcaseFloorplanPositionX]".
	"&y_$planNum"."_$positionCount=$myrowPos[enhancedShowcaseFloorplanPositionY]".
	"&rotation_$planNum"."_$positionCount=$myrowPos[enhancedShowcaseFloorplanPositionRotation]".
	"&title_$planNum"."_$positionCount=".str_replace(" ", "+", $myrowPos[enhancedShowcaseFloorplanPositionTypeTitle]).
	"&positiontype_$planNum"."_$positionCount=$positiontype".
	"&floorplanpositionid_$planNum"."_$positionCount=$myrowPos[enhancedShowcaseFloorplanPositionID]".
	"&thumbnailimageid_$planNum"."_$positionCount=$myrowPos[enhancedShowcaseImageID]".
	"&thumbnailpath_$planNum"."_$positionCount=$myrowPos[enhancedShowcaseImagePath]".
	"&mapx_$planNum"."_$positionCount=$myrowPos[enhancedShowcaseFloorplanMapX]".
	"&mapy_$planNum"."_$positionCount=$myrowPos[enhancedShowcaseFloorplanMapY]".
	"&mapw_$planNum"."_$positionCount=$myrowPos[enhancedShowcaseFloorplanMapW]".
	"&hiResExists_$planNum"."_$positionCount=";
	$originalPath = "/var/www/vhosts/interactiveproperties.com/httpdocs/floorplans/".$myrowFloors[enhancedShowcaseFloorplanID]."/".str_replace("th.jpg", "-original.jpg", $myrowPos[enhancedShowcaseImagePath]);
	if (file_exists($originalPath)) {
	 $sizeOfOriginal = filesize($originalPath);
	} else {
	 $sizeOfOriginal = 0;
	}
	$kiloBytes = $sizeOfOriginal / 1024;
	 if ($kiloBytes > 500) {
	  $showcaseData .= "yes&";
	 } else {
	  $showcaseData .= "no&";
	 }
	} elseif ($myrowPos[enhancedShowcaseImageTypeID] == '2') { // large Info
	$showcaseData .= "enlargementpath_$planNum"."_$positionCount=$myrowPos[enhancedShowcaseImagePath]&";
	}
}
$positionsThisFloor = $positionCount;
$showcaseData .= "numberofpointsinplan_$planNum=$positionsThisFloor&";
++$planNum;
}
$showcaseData .= "totalNumImages=".$positionCount."&";

$sqlSatZoomCheck = "SELECT sat360zoomID FROM sat360zooms WHERE showcaseID = '$_GET[showcaseID]'";
$resultSatZoomCheck = mysql_query($sqlSatZoomCheck);
$myrowSatZoomCheck = mysql_fetch_row($resultSatZoomCheck);
if ($myrowSatZoomCheck[0]) {
$showcaseData .= "zoomFileName=".$myrowSatZoomCheck[0]."&";
} else {
$showcaseData .= "zoomFileName=notFound&";
}
echo $showcaseData;
// for debugging
/*$openedFile = fopen("/var/www/vhosts/interactiveproperties.com/httpdocs/viewerutilities/testNew.txt", "w");
$writtenFile = fputs($openedFile, $showcaseData);
fclose($openedFile);*/
?>