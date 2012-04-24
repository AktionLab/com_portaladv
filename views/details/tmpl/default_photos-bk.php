<?php defined('_JEXEC') or die('Restricted access'); ?>

<div class="details_photos_container">
<div class="main_image"><img name="main_image" src="/rets_photos/image-<?=$this->details->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID}."-1" . '.jpg'?>" width="500"></div>
<ul class="image_list">
<?
for ($i=1;$i<7;$i++) {
	if (file_exists("/home/portal/rets_photos/image-" . $this->details->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID} . "-$i.jpg"))
	{
		echo "\n" . '<li class="listing_img" onmouseover="document.main_image.src=\'/rets_photos/image-' . $this->details->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID}."-$i" . '.jpg\'"><img src="/rets_photos/image-' . $this->details->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID} . "-$i" . '.jpg" /></li>';
	}
}
?>
<?
for ($i=7;$i<13;$i++) {
	if (file_exists("/home/portal/rets_photos/image-" . $this->details->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID} . "-$i.jpg"))
	{
		echo "\n" . '<li class="listing_img" onmouseover="document.main_image.src=\'/rets_photos/image-' . $this->details->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID}."-$i" . '.jpg\'"><img src="/rets_photos/image-' . $this->details->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID} . "-$i" . '.jpg" /></li>';
	}
}
?>

<?
for ($i=13;$i<19;$i++) {
	if (file_exists("/home/portal/rets_photos/image-" . $this->details->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID} . "-$i.jpg"))
	{
		echo "\n" . '<li class="listing_img" onmouseover="document.main_image.src=\'/rets_photos/image-' . $this->details->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID}."-$i" . '.jpg\'"><img src="/rets_photos/image-' . $this->details->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID} . "-$i" . '.jpg" /></li>';
	}
}
?>
 
</ul>
</div>
