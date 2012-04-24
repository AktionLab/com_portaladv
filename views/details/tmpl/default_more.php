<?php defined('_JEXEC') or die('Restricted access'); ?>

<div class="details_header">More Details</div>

<div class="details_public_remarks">

	<?
	
	if ($this->details->{FIELDNAME_LISTING_FEATURES}) {
		echo "<strong>" . FEATURES_TITLE . ":</strong><br />" . str_replace(",",", ",$this->details->{FIELDNAME_LISTING_FEATURES}) . "<br /><br />";
	}
	
	if ($this->details->{FIELDNAME_LISTING_VIEW}) {
		echo "<strong>" . VIEW_TITLE . ":</strong><br />" . str_replace(",",", ",$this->details->{FIELDNAME_LISTING_VIEW}) . "<br /><br />";
	}
	
	if ($this->details->{FIELDNAME_LISTING_LOCATION}) {
		echo "<strong>" . LOCATION_TITLE . ":</strong><br />" . str_replace(",",", ",$this->details->{FIELDNAME_LISTING_LOCATION}) . "<br /><br />";
	}
	
	if ($this->details->{FIELDNAME_LISTING_AMENITIES}) {
		echo "<strong>" . AMENITIES_TITLE . ":</strong><br />" . str_replace(",",", ",$this->details->{FIELDNAME_LISTING_AMENITIES}) . "<br /><br />";
	}
	
	?>
	
</div>
<div class="details_public_remarks">
	
	<?
	
	if ($this->details->{FIELDNAME_LISTING_ADDITIONAL_ROOMS}) {
		echo "<strong>" . ADDITIONAL_ROOMS_TITLE . ":</strong><br />" . str_replace(",",", ",$this->details->{FIELDNAME_LISTING_ADDITIONAL_ROOMS}) . "<br /><br />";
	}
	
	if ($this->details->{FIELDNAME_LISTING_APPLIANCES}) {
		echo "<strong>" . APPLIANCES_TITLE . ":</strong><br />" . str_replace(",",", ",$this->details->{FIELDNAME_LISTING_APPLIANCES}) . "<br /><br />";
	}
	
	if ($this->details->{FIELDNAME_LISTING_FLOORING}) {
		echo "<strong>" . FLOORING_TITLE . ":</strong><br />" . str_replace(",",", ",$this->details->{FIELDNAME_LISTING_FLOORING}) . "<br /><br />";
	}
	
	if ($this->details->{FIELDNAME_LISTING_FURNISHED}) {
		echo "<strong>" . FURNISHED_TITLE . ":</strong><br />" . str_replace(",",", ",$this->details->{FIELDNAME_LISTING_FURNISHED}) . "<br /><br />";
	}
	
	if ($this->details->{FIELDNAME_LISTING_HEATING}) {
		echo "<strong>" . HEATING_TITLE . ":</strong><br />" . str_replace(",",", ",$this->details->{FIELDNAME_LISTING_HEATING}) . "<br /><br />";
	}
	
	?>
	
</div>
<div class="details_public_remarks" style="border:0px;">
	
	<?
	
	if ((int) $this->details->{FIELDNAME_LISTING_ASSOCIATION_DUES} > 0) {
		echo "<strong>" . ASSOCIATION_DUES_TITLE . ":</strong><br />" . str_replace(",",", ",$this->details->{FIELDNAME_LISTING_ASSOCIATION_DUES});
		if ($this->details->{FIELDNAME_LISTING_ASSOCIATION_DUES_FREQUENCY}) {
			echo " / " . $this->details->{FIELDNAME_LISTING_ASSOCIATION_DUES_FREQUENCY};
		}
		echo "<br /><br />";
	}
	
	if ($this->details->{FIELDNAME_LISTING_TAXES}) {
		echo "<strong>" . TAXES_TITLE . ":</strong><br />" . str_replace(",",", ",$this->details->{FIELDNAME_LISTING_TAXES});
		if ($this->details->{FIELDNAME_LISTING_TAX_YEAR}) {
			echo " / " . $this->details->{FIELDNAME_LISTING_TAX_YEAR};
		}
		echo "<br /><br />";
	}

	if ((int)$this->details->{FIELDNAME_LISTING_TRANSFER_TAX} > 0) {
		echo "<strong>" . TRANSFER_TAX_TITLE . ":</strong><br />" . str_replace(",",", ",$this->details->{FIELDNAME_LISTING_TRANSFER_TAX}) . "<br /><br />";
	}
	
	if ($this->details->{FIELDNAME_LISTING_CONSTRUCTION}) {
		echo "<strong>" . CONSTRUCTION_TITLE . ":</strong><br />" . str_replace(",",", ",$this->details->{FIELDNAME_LISTING_CONSTRUCTION}) . "<br /><br />";
	}
	
	if ($this->details->{FIELDNAME_LISTING_LAUNDRY}) {
		echo "<strong>" . LAUNDRY_TITLE . ":</strong><br />" . str_replace(",",", ",$this->details->{FIELDNAME_LISTING_LAUNDRY}) . "<br /><br />";
	}
	
	if ($this->details->{FIELDNAME_LISTING_LOT_ACREAGE}) {
		echo "<strong>" . LOT_ACREAGE_TITLE . ":</strong><br />" . $this->details->{FIELDNAME_LISTING_LOT_ACREAGE} . "<br /><br />";
	}
	
	if ($this->details->{FIELDNAME_LISTING_LOT_SQUARE_FOOTAGE}) {
		echo "<strong>" . LOT_SQUARE_FOOTAGE_TITLE . ":</strong><br />" . $this->details->{FIELDNAME_LISTING_LOT_SQUARE_FOOTAGE} . "<br /><br />";
	}
	
	/*
	if ($this->details->{FIELDNAME_RESIDENTIAL_LISTING_NUM}) {
		echo "<strong>" . LISTING_NUM_TITLE . ":</strong><br />" . $this->details->{FIELDNAME_RESIDENTIAL_LISTING_NUM} . "<br /><br />";
	}
	*/
	
	if ($this->details->{FIELDNAME_LISTING_ROOFING}) {
		echo "<strong>" . ROOFING_TITLE . ":</strong><br />" . str_replace(",",", ",$this->details->{FIELDNAME_LISTING_ROOFING}) . "<br /><br />";
	}
	
	if ($this->details->{FIELDNAME_LISTING_SEWER}) {
		echo "<strong>" . SEWER_TITLE . ":</strong><br />" . str_replace(",",", ",$this->details->{FIELDNAME_LISTING_SEWER}) . "<br /><br />";
	}
	
	if ($this->details->{FIELDNAME_LISTING_UTILITIES}) {
		echo "<strong>" . UTILITIES_TITLE . ":</strong><br />" . str_replace(",",", ",$this->details->{FIELDNAME_LISTING_UTILITIES}) . "<br /><br />";
	}
	
	
	
	?>
	
</div>
<div class="clear"></div>