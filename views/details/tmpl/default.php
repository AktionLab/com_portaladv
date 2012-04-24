<?php defined('_JEXEC') or die('Restricted access'); ?>
<?
$user =& JFactory::getUser();
$db =& JFactory::getDBO();
?>
<!--[if lte IE 6]>
<link href="/components/com_portaladv/portaladv_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->

<div class="details_main_container">
<div class="details_address_mls">
	<div class="details_address">
		<h1>
		<?
		$listing = $this->details;
/*
* 
* BEGIN CUSTOM BCO INTEGRATION
* - if condo or townhouse, user subdivision and unit #, else use address -
*
**/			

if ($listing->{FIELDNAME_LISTING_SUB_TYPE} == 'Condo' || $listing->{FIELDNAME_LISTING_SUB_TYPE} == 'Townhouse') {
	echo ucwords(strtolower($listing->{FIELDNAME_RESIDENTIAL_SUBDIVISION})) . " - Unit # " . $listing->{FIELDNAME_LISTING_UNIT_NUMBER};
} else {
	echo ucwords(strtolower($listing->{FIELDNAME_RESIDENTIAL_ADDRESS_NUM} . " " . $listing->{FIELDNAME_RESIDENTIAL_STREET_NAME} . " " . $listing->{FIELDNAME_RESIDENTIAL_STREET_SUFFIX}));
}

/*
* 
* END CUSTOM BCO INTEGRATION
*
**/							
?>
		</h1>
	</div>
	<div class="details_mls">
		<h1><? echo 'MLS #'.$this->details->{FIELDNAME_RESIDENTIAL_LISTING_NUM}; ?></h1>
	</div>
</div>
<div class="clear"></div>
	<div class="details_details">
	<?php  echo $this->loadTemplate('details'); ?>
	</div>

	<div class="details_photos">

<?
if ($user->id)
{
	 					
	//check if listing has already been favorited
	$favquery = "SELECT id FROM jos_favorites WHERE content_id = '" . $listing->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID} . "' AND user_id = '" . $user->id . "'";
	$db->setQuery($favquery);
	if ($favresult = $db->loadResult())
	{
					
		 	$fav_status = 1;
		 	$link = "<input type=\"button\" class=\"portaladv_button_off\" id=\"fav" . $listing->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID} . "\"  onclick=\"window.open('index.php?option=com_comprofiler','_self');\" value=\"" . BUTTON_FAVORITE_SAVED . "\"></input>";
		 	
		 						
	}
	else
	{
		 					
		 	$fav_status = -1;
		 	$link = "<input type=\"button\" class=\"portaladv_button\" id=\"fav" . $listing->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID} . "\" onmouseover=\"this.className='portaladv_button_hover';\" onmouseout=\"this.className='portaladv_button';\" onclick=\"favorite('" . $listing->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID} . "','portaladv','" . $fav_status . "','" . $user->id . "');\" value=\"" . BUTTON_ADD_TO_FAVORITES . "\"></input>";
		 	
		 						
	}
		 					
	$fav = $link;
		 					
}
else
{
		 				
	$fav = "<input type=\"button\" class=\"portaladv_button\" id=\"favorite_link\" onmouseover=\"this.className='portaladv_button_hover';\" onmouseout=\"this.className='portaladv_button';\" onclick=\"window.open('index.php?option=com_comprofiler&task=registers','_self');\" value=\"" . BUTTON_ADD_TO_FAVORITES . "\" ></input>";
		 					
}	
		 				
echo $fav;
?>

		<input class="portaladv_button" style="padding:3px;text-align:center;margin-right:10px;" onmouseover="this.className='portaladv_button_hover';" onmouseout="this.className='portaladv_button';" onclick="popUp('index.php?option=com_portaladv&amp;task=printlisting&amp;view=details&amp;listing=<? echo $listing->{FIELDNAME_LISTING_DATABASE_ID}; ?>&amp;format=portaladv_printlisting');" value="<? echo BUTTON_PRINT_LISTING; ?>" />
	<?php echo $this->loadTemplate('photos'); ?>
	</div>

	<div class="clear"></div>
	
	<!--<div class="details_line_break1"></div>-->

	<?php 
	echo $this->loadTemplate('map');
	?>

	<!--<div class="details_line_break2"></div>-->

	<div class="details_modules_container">
		<div class="details_more">
		<?php echo $this->loadTemplate('more'); ?>
		</div>	
		<div class="details_contact">
		<?php echo $this->loadTemplate('contact'); ?>
		</div>
		<div class="clear"></div>
		<? echo "<span style=\"padding:2px;\" class=\"small\">Listing provided by: " . /* ucwords(strtolower($listing->{FIELDNAME_LISTING_AGENT_NAME})) . " - " . */ ucwords(strtolower($listing->{FIELDNAME_LISTING_OFFICE_NAME})) . "</span>"; ?>
	</div>
	


</div>