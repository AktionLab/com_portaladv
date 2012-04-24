<?
function embedswf($file, $width, $high){
	$hash = rand(1, 1999);
?>
<div id="flashcontent_<?=$hash ?>">
	<b>You need to upgrade your Flash Player</b><br />
	Your Adobe&#8482; Flash player is not up to date or not installed.<br />
	<a href="http://www.adobe.com/go/getflashplayer">please download the latest version from here</a>
</div>
		
<script type="text/javascript">
	var so = new FlashObject("<?=$file ?>","sotester", "<?=$width ?>", "<?=$high ?>", "9", "#ffffff");
	so.write("flashcontent_<?=$hash ?>");
</script>

<?
};
?>
