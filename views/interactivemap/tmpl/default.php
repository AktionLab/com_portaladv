<?php defined('_JEXEC') or die('Restricted access'); ?>
<? $time = time(); ?>
<link rel="stylesheet" href="components/com_portaladv/portaladv.css">
<div class="componentheading">Beaver Creek Interactive Map</div>
<div class="portaladv_interactive_map">
<div id="interactive_map_<?=$time?>" style="width:610px;height:500px;">
<object
classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" 
codebase="http://download.macromedia.com
/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"
width="610" height="500" id="movie" align="">
<param name="movie" value="components/com_portaladv/includes/interactivemap/map.swf">
<embed src="components/com_portaladv/includes/interactivemap/map.swf" quality="high" width="610"
height="500" name="movie" align="" 
type="application/x-shockwave-flash"
plug inspage="http://www.macromedia.com/go/getflashplayer"> 
</object>

	
</div>
<!--
<script type="text/javascript">
	var so = new FlashObject("/components/com_portaladv/includes/interactivemap/map.swf","interactivemap_<?=$time?>", "610", "500", "9", "#ffffff");
	so.write("interactive_map_<?=$time?>");
</script>
-->
<? echo INTERACTIVE_MAP_INSTRUCTIONS; ?>
</div>