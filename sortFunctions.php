<?

function sortByPriceAscending($a,$b) {

		$fieldname = FIELDNAME_RESIDENTIAL_PRICE;
		
		if ($a->$fieldname == $b->$fieldname) {
			return 0;
		}
		if ($a->$fieldname < $b->$fieldname) {
			return -1;
		}
		if ($a->$fieldname > $b->$fieldname) {
			return 1;
		}
}

function sortByPriceDescending($a,$b) {
		
		$fieldname = FIELDNAME_RESIDENTIAL_PRICE;
		
		if ($a->$fieldname == $b->$fieldname) {
			return 0;
		}
		if ($a->$fieldname > $b->$fieldname) {
			return -1;
		}
		if ($a->$fieldname < $b->$fieldname) {
			return 1;
		}
}

function sortByNumBedrooms($a,$b) {

		$fieldname = FIELDNAME_RESIDENTIAL_NUM_BEDROOMS;
		
		if (!$a->$fieldname) {
			return -1;
		}
		if ($a->$fieldname == $b->$fieldname) {
			return 0;
		}
		if ($a->$fieldname > $b->$fieldname) {
			return -1;
		}
		if ($a->$fieldname < $b->$fieldname) {
			return 1;
		}
}

function sortByNumBathrooms($a,$b) {

		$fieldname = FIELDNAME_RESIDENTIAL_NUM_BATHROOMS;
		
		if (!$a->$fieldname) {
			return -1;
		}
		if ($a->$fieldname == $b->$fieldname) {
			return 0;
		}
		if ($a->$fieldname > $b->$fieldname) {
			return -1;
		}
		if ($a->$fieldname < $b->$fieldname) {
			return 1;
		}
}

?>