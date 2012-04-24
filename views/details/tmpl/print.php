<?php defined('_JEXEC') or die('Restricted access'); ?>

<!--[if lte IE 6]>
<link href="/components/com_portaladv/portaladv_print_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->

<div class="details_main_container">
	<div class="print_page">
		<div class="details_header">
			<div class="details_address">
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
			</div>
			<div class="details_mls">
				<? echo 'MLS #'.$this->details->{FIELDNAME_RESIDENTIAL_LISTING_NUM}; ?>
			</div>
		</div>
		<div class="clear"></div>
		<div class="details_details">
			<?php echo $this->loadTemplate('details'); ?>
		</div>

		<div class="details_photos">
			<?php echo $this->loadTemplate('photo'); ?>
		</div>
	
		<div class="clear"></div>
	
		<!--<div class="details_line_break1"></div>-->
	
		<!--<div class="details_line_break2"></div>-->
	
		<div class="details_modules_container">
			<div class="details_more">
			<?php echo $this->loadTemplate('more'); ?>
			</div>	
			<div class="clear"></div>
			<? //echo "<span style=\"padding:2px;\" class=\"small\">Listing provided by: " . ucwords(strtolower($listing->{FIELDNAME_LISTING_AGENT_NAME})) . "</span>"; ?>
		</div>

		<div class="more_details_separator"><!-- --></div>
		<div class="more_details_separator"><!-- --></div>
		<table width="100%" cellpadding="0" cellspacing="0" >
			<tr>
				<td align="center">
					<div class="printlisting_footer_contact_us"><? echo PRINTLISTING_FOOTER_CONTACT_US_TEXT; ?></div>
				</td>
			</tr>
		</table>
	</div>
		<?php
/*
</div>
*/
?>
	<div class="pagebreak">
	<div class="print_page">
		<?php echo $this->loadTemplate('map'); ?>
		<?php echo $this->loadTemplate('photos1'); ?>
	</div>
	</div>
<?
if (file_exists("/home/portal/rets_photos/image-" . $this->details->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID} . "-5.jpg")) {
?>
	<div class="pagebreak">
	<div class="print_page">
		<?php echo $this->loadTemplate('photos2'); ?>
	</div>
	</div>
<? } ?>
<?
if (file_exists("/home/portal/rets_photos/image-" . $this->details->{FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID} . "-9.jpg")) {
?>
	<div class="pagebreak">
	<div class="print_page">
		<?php echo $this->loadTemplate('photos3'); ?>
	</div>
	</div>
<? } ?>
</div>

<script type="text/javascript">
window.onload = function() {
	window.print();
}
</script>