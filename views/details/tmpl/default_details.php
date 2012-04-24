<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php $listing = $this->details; ?>
<?php
// format bathroom number
if ( ($listing->{FIELDNAME_RESIDENTIAL_NUM_BATHROOMS} / 0.5 % 2) == 1) {
	$listing->{FIELDNAME_RESIDENTIAL_NUM_BATHROOMS} = number_format($listing->{FIELDNAME_RESIDENTIAL_NUM_BATHROOMS},1);
} else {
	$listing->{FIELDNAME_RESIDENTIAL_NUM_BATHROOMS} = number_format($listing->{FIELDNAME_RESIDENTIAL_NUM_BATHROOMS},0);
}
// format bedroom number
if ( ($listing->{FIELDNAME_RESIDENTIAL_NUM_BEDROOMS} / 0.5 % 2) == 1) {
	$listing->{FIELDNAME_RESIDENTIAL_NUM_BEDROOMS} = number_format($listing->{FIELDNAME_RESIDENTIAL_NUM_BEDROOMS},1);
} else {
	$listing->{FIELDNAME_RESIDENTIAL_NUM_BEDROOMS} = number_format($listing->{FIELDNAME_RESIDENTIAL_NUM_BEDROOMS},0);
}
?>
	<div class="details_info">
		<input type="button" class="portaladv_button" onmouseover="this.className='portaladv_button_hover';" onmouseout="this.className='portaladv_button';" onclick="history.go(-1);" value="<? echo BUTTON_BACK_TO_SEARCH_RESULTS; ?>"></input>
        <?php ## modified by Rich S Wyatt to correctly display price - 10/19/2010 
        
        echo "<!-- "; 
        echo "LISTING: ". "\r\n"; 
        echo $listing->{FIELDNAME_RESIDENTIAL_PRICE};  echo "\r\n"; 
        echo "-->"; 
        
        ?>
        
		<div class="details_price"><? echo 'Offered for $' . number_format(str_replace(",","",$listing->{FIELDNAME_RESIDENTIAL_PRICE}),0,".",","); ?></div>
		<div class="details_bedbath"><? echo $listing->{FIELDNAME_RESIDENTIAL_NUM_BEDROOMS}; ?> <? echo BEDROOM_ABBREV_1; ?> | <? echo $listing->{FIELDNAME_RESIDENTIAL_NUM_BATHROOMS}; ?> <? echo BATHROOM_ABBREV_1; ?> | <? echo number_format($listing->{FIELDNAME_RESIDENTIAL_SQUAREFEET}); ?> <? echo SQUAREFEET_ABBREV; ?></div>
		<div class="details_type"><? echo /* ucwords(strtolower(str_replace(","," / ",$this->details->{FIELDNAME_PROPERTY_TYPE}))) . " - " .  */ $listing->{FIELDNAME_LISTING_SUB_TYPE} ; ?></div>
		
		<div class="details_spacer"><!-- --></div>
		<? /*<span class="details"><b>Listing Provider:</b> <? echo ucwords(strtolower($listing->{FIELDNAME_LISTING_OFFICE_NAME})); ?></span><br />*/ ?>
		<!--<span class="details"><b>County:</b> <? //echo ucwords(strtolower($listing->{FIELDNAME_RESIDENTIAL_COUNTY})); ?></span><br />-->
		<span class="details"><b>Sub-Area:</b> <? echo ucwords(strtolower($listing->{FIELDNAME_RESIDENTIAL_AREA})); ?></span><br />
		<!--<span class="details"><b>Garage:</b> <? echo ucwords(strtolower($listing->{FIELDNAME_RESIDENTIAL_GARAGE})); ?><br />-->
		<span class="details"><b>Year Built:</b> <? echo ucwords(strtolower($listing->{FIELDNAME_RESIDENTIAL_YEAR_BUILT})); ?></span><br /><br />
		<span class="listing_remarks"><? echo $listing->{FIELDNAME_PROPERTY_REMARKS1} . $listing->{FIELDNAME_PROPERTY_REMARKS2}; ?></span>
	</div>


