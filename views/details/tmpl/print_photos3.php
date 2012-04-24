<?php defined('_JEXEC') or die('Restricted access'); ?>

<div class="print_listing_images">
<?
for ($i=9;$i<=12;$i++) {
	if (file_exists("/home/portal/rets_photos/image-" . $this->details->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID} . "-$i.jpg"))
	{
		echo "\n" . '<div class="listing_photo"><img src="/rets_photos/image-' . $this->details->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID} . "-$i" . '.jpg" width="300" hspace="8" vspace="8" /></div>';
	}
}
?>
</div> 
