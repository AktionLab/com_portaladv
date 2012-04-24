<?php defined('_JEXEC') or die('Restricted access'); ?>

<?
//##################################################################################
// random character function
function generate_random_password() {
// Set the value of the password string to null
$passwordstring = "";
// Populate the alpha numeric characters array with lowercase and uppercase letters and digits
// FULL STRING $alphaarray = array(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,1,2,3,4,5,6,7,8,9,0);
$alphaarray = array(a,b,c,d,e,f,g,h,j,k,m,n,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,J,K,M,N,P,Q,R,S,T,U,V,W,X,Y,Z,2,3,4,5,6,7,8,9);  // Trimmed of possibly misinterpreted characters
$optionsCount = (count($alphaarray)-1);
//seed the random number 
srand((double)microtime()*1000000); 
// Select a varialbe length for the password
$passlength = rand(7,10);
// Choose a random number for each slot in the password variable
for ($i=0; $i<$passlength; $i++) {
$newrand = rand(0, $optionsCount);
$passvar[$i] = $alphaarray[$newrand];
$passwordstring .= $passvar[$i];
}
// Return the newly created random string
return $passwordstring;
}
//##################################################################################

//##################################################################################
// xml file creation section
//-------------------------------------------
// create item tag for each photo
$xmlItemStr = "";
 
for ($i=1;$i<19;$i++) {
	if (file_exists("/home/bco/www/rets_photos/image-".$this->details->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID}."-$i.jpg"))
	{
		$xmlItemStr .= "		<item>
			<thumbnailPath>/rets_photos/image-".$this->details->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID}."-$i.jpg</thumbnailPath>
			<largeImagePath>/rets_photos/image-".$this->details->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID}."-$i.jpg</largeImagePath>
			<fullScreenImagePath>/rets_photos/image-".$this->details->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID}."-$i.jpg</fullScreenImagePath>
			<title></title>
			<description></description>
		</item>
";
	}
}
//-------------------------------------------
// build the string for the complete xml file
$xmlFileStr = "﻿<?xml version=\"1.0\" encoding=\"utf-8\"?>
<SlideshowBox>
	<items>
	$xmlItemStr
	</items>
</SlideshowBox>
";
//-------------------------------------------
// write arbitrarily named xml file
$xmlSourceFilName = generate_random_password();
$handle = fopen("./ssbox/".$xmlSourceFilName.".xml", "w");
fputs($handle, $xmlFileStr);
fclose($handle);
//##################################################################################

//##################################################################################
// file cleanup section - removes arbitrarily named xml files older than 3 hrs
$date4HrsAgo = date("Y-m-d H:i:s", time() - 3 * 60 * 60);
$filenames = opendir("./ssbox/");
while ($filename = readdir($filenames)) {
	if ($filename != "." && $filename != ".." && $filename != "PanAndZoom.swf" && $filename != "PanAndZoom.js" && $filename != "source.xml" && $filename != "swfobject.js") {
		$olderThan = 0;
		$currFileMTime = date("Y-m-d H:i:s", filemtime("./ssbox/".$filename));
		if ($currFileMTime < $date4HrsAgo) $olderThan = 1;
		if ($olderThan) {
			//echo "$filename :: $currFileMTime :: OLDER<br>\n";
			unlink("./ssbox/".$filename);
		}
	}
}
//##################################################################################

?>
 
<div class="details_photos_container">
<script type="text/javascript" src="./ssbox/swfobject.js"></script>
<script type="text/javascript" src="./ssbox/PanAndZoom.js"></script>
<script type="text/javascript">
	swfobject.registerObject("PanAndZoom1326398492305", "10.0.0", "", function(e) {
		if (e.success==false){
			var err;
			try{
				$("#PanAndZoom1326398492305").hide();
				$.slideshowBoxEmbedCanvas.init({
					appendToID:"PanAndZoomJS1326398492305",
					domainKeys:"fef84666d43045342b3f25cf8f8f157e",
					source:"./ssbox/<?php echo $xmlSourceFilName; ?>.xml",
					audioFile:"",
					audioFileAlt:"",
					audioPlayerIcon:"speaker",
					audioPlayerColor:"#FFFFFF",
					loopAudio:true,
					audioPlayMode:"audioOff",
					audioPlayerOn:"",
					audioPlayerOff:"",
					fontName:"",
					fontSize:10,
					bold:false,
					italic:false,
					textTopOffset:0,
					width:590,
					height:450,					
					autoSlideShow:true,
					slideShowSpeed:4,
					backgroundVisible:false,
					backgroundColor:"#000000",
					backgroundImage:"",
					scaleBackground:true,
					loadOriginalImages:false,
					autoHideControls:true,
					controlsHideSpeed:5,
					controlBarAlpha:1,
					controlBarPrimaryColor:"#3C3C3C",
					controlBarSecondaryColor:"#CCCCCC",
					slideShowControls:true,
					fullScreenButton:true,
					thumbWidth:140,
					thumbHeight:120,
					showImageIndex:false,
					showImageInfos:true,
					scaleMode:"scaleCrop",
					effect:"random",
					preloaderPosition:"centered",
					textColor:"#FFFFFF",
					textBackgroundAlpha:0.5,
					textBackgroundColor:"#000000"
				});
			}catch(err){}
		}
	});
</script>
<div id="PanAndZoomJS1326398492305" style="width:590px;height:450px;">
	<object id="PanAndZoom1326398492305" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="590" height="450">
		<param name="movie" value="./ssbox/PanAndZoom.swf">
		<param name="allowFullScreen" value="true">
		<param name="bgcolor" value="#1C1C1C">
		<param name="wmode" value="window">
		<param name="flashvars" value="domainKeys=fef84666d43045342b3f25cf8f8f157e&source=./ssbox/<?php echo $xmlSourceFilName; ?>.xml&audioFile=&audioPlayerIcon=speaker&audioPlayerColor=0xFFFFFF&loopAudio=true&audioPlayMode=audioOff&autoSlideShow=true&slideShowSpeed=4&backgroundVisible=true&backgroundColor=0x000000&backgroundImage=&scaleBackground=true&loadOriginalImages=false&autoHideControls=true&controlsHideSpeed=5&controlBarAlpha=1&controlBarPrimaryColor=0x3C3C3C&controlBarSecondaryColor=0xCCCCCC&slideShowControls=true&fullScreenButton=true&thumbWidth=140&thumbHeight=120&showImageIndex=false&showImageInfos=true&scaleMode=scaleCrop&effect=random&preloaderPosition=centered&textColor=0xFFFFFF&textBackgroundAlpha=0.5&textBackgroundColor=0x000000" />
		<!--[if !IE]>-->
		</object>
		<object type="application/x-shockwave-flash" data="./ssbox/PanAndZoom.swf" width="590" height="450">
		<!--<![endif]-->
			<param name="flashvars" value="domainKeys=fef84666d43045342b3f25cf8f8f157e&source=./ssbox/<?php echo $xmlSourceFilName; ?>.xml&audioFile=&audioPlayerIcon=speaker&audioPlayerColor=0xFFFFFF&loopAudio=true&audioPlayMode=audioOff&autoSlideShow=true&slideShowSpeed=4&backgroundVisible=true&backgroundColor=0x000000&backgroundImage=&scaleBackground=true&loadOriginalImages=false&autoHideControls=true&controlsHideSpeed=5&controlBarAlpha=1&controlBarPrimaryColor=0x3C3C3C&controlBarSecondaryColor=0xCCCCCC&slideShowControls=true&fullScreenButton=true&thumbWidth=140&thumbHeight=120&showImageIndex=false&showImageInfos=true&scaleMode=scaleCrop&effect=random&preloaderPosition=centered&textColor=0xFFFFFF&textBackgroundAlpha=0.5&textBackgroundColor=0x000000" />
			<param name="allowFullScreen" value="true">
			<param name="wmode" value="window">
			<param name="bgcolor" value="#1C1C1C">
		<!--[if !IE]>-->
		</object>
		<!--<![endif]-->
	</object>
</div>
</div>
