<?

$time = time();
/**
 *  Defines constants used for connecting to Portal Advantage IDX db and displaying data.
 */

//Website
DEFINE('SITE_NAME','WinterBeaverCreek.com');
DEFINE('SITE_DOMAIN','www.winterbeavercreek.com');
DEFINE('PATH_TO_PORTALADV','/components/com_portaladv/');
DEFINE('PATH_TO_SITE','/');
DEFINE('URL_TO_MLS_IMAGES','http://www.beavercreekonline.com/rets_photos/');

//The Portal Advantage database of mls listings
DEFINE('PA_HOST','localhost');
DEFINE('PA_USER','portalportaladv');
DEFINE('PA_PASS','Cd97-4oWZ8');
DEFINE('PA_DB','portalportaladv');

//table name prefix
DEFINE('TABLE_PREFIX','eagle_county');

//table names
DEFINE('LISTINGS_TABLE_RESIDENTIAL','eagle_county_residential');
DEFINE('LISTINGS_TABLE_LAND','eagle_county_land');
DEFINE('LISTINGS_TABLE_PARTIAL','eagle_county_partial');

//DEFINE('TABLE_ABBREV_CODES_RESIDENTIAL','metrolist_fields_residential_abbrev');

/*****************************************************************************
/*
/*
/*					STRINGS
/*
/*
/*****************************************************************************/

#BROKER/REALTOR INFORMATION
DEFINE('BROKER_ID1','606');
DEFINE('BROKER_ID2','2533');

#PROPERTY SEARCH INTRO TEXT
DEFINE('PROPERTY_SEARCH_TITLE_TEXT','Beaver Creek Online - Property Search');
DEFINE('PROPERTY_SEARCH_INTRO_TEXT','<p>As one of the <strong>Top Destination Resorts in the World</strong>, Beaver Creek is a feast for the eyes.   Both 
<b>
<a href="http://www.beavercreekonline.com/index.php?option=com_resource&view=article&article=19318&Itemid=73">Kenton Hopkins MRE, CRS, GRI</a></b> and 
<b>
<a href="http://www.beavercreekonline.com/index.php?option=com_resource&view=article&article=19318&Itemid=73">David McHugh e-PRO</a></b> are the <strong> TOP PRODUCING BROKERS </strong>in Beaver Creek with Slifer Smith & Frampton Real Estate and look forward to helping you discover your new mountain home here in Beaver Creek, Colorado.</p>
<p><b>Call us today at (970)845-8053 to discover Beaver Creek!</strong></b></p>
<h2><u>Quick Search</h2></u>
<p>Select a property type and location below for instant results.</p>
<table width="100%">
<tr>
<td align="center">
<b>Beaver Creek</b>
<table>
	<tbody>
		<tr>
			<td>
			<img src="http://beavercreekonline.com/images/qs_home.jpg" onmouseover="javascript:return overlib(\'Single Family\',BGCOLOR,\'#444499\',WIDTH,90);" onmouseout="javascript:return nd();" onclick="window.open(\'index.php?option=com_portaladv&task=search&Itemid=69&limitstart=&subdivision=&area[]=Beaver+Creek&price_min=&price_max=&prop_type[]=single+family&num_bedrooms[]=0&num_bathrooms[]=0&squarefeet_min=&squarefeet_max=&lat_min=0&lat_max=0&lng_min=0&lng_min=0&task=search&limit=10&task=search&search_type=filter\',\'_self\');" border="0" style="cursor:pointer;" />
			</td>
			<td>
			<img src="http://beavercreekonline.com/images/qs_condo.jpg" onmouseover="javascript:return overlib(\'Condos\',BGCOLOR,\'#444499\',WIDTH,90);" onmouseout="javascript:return nd();" onclick="window.open(\'index.php?option=com_portaladv&task=search&Itemid=69&limitstart=&subdivision=&area[]=Beaver+Creek&price_min=&price_max=&prop_type[]=condo&num_bedrooms[]=0&num_bathrooms[]=0&squarefeet_min=&squarefeet_max=&lat_min=0&lat_max=0&lng_min=0&lng_min=0&task=search&limit=10&task=search&search_type=filter\',\'_self\');" border="0" style="cursor:pointer;" />
			</td>
		</tr>
		<tr>
			<td>
			<img src="http://beavercreekonline.com/images/qs_townhome.jpg" onmouseover="javascript:return overlib(\'Townhomes\',BGCOLOR,\'#444499\',WIDTH,90);" onmouseout="javascript:return nd();" onclick="window.open(\'index.php?option=com_portaladv&task=search&Itemid=69&limitstart=&subdivision=&area[]=Beaver+Creek&price_min=&price_max=&prop_type[]=townhouse&num_bedrooms[]=0&num_bathrooms[]=0&squarefeet_min=&squarefeet_max=&lat_min=0&lat_max=0&lng_min=0&lng_min=0&task=search&limit=10&task=search&search_type=filter\',\'_self\');" border="0" style="cursor:pointer;" />
			</td>
			<td>
			<img src="http://beavercreekonline.com/images/qs_land.jpg" onmouseover="javascript:return overlib(\'Land\',BGCOLOR,\'#444499\',WIDTH,90);" onmouseout="javascript:return nd();" onclick="window.open(\'index.php?option=com_portaladv&task=search&Itemid=69&limitstart=&subdivision=&area[]=Beaver+Creek&price_min=&price_max=&prop_type[]=land&num_bedrooms[]=0&num_bathrooms[]=0&squarefeet_min=&squarefeet_max=&lat_min=0&lat_max=0&lng_min=0&lng_min=0&task=search&limit=10&task=search&search_type=filter\',\'_self\');" border="0" style="cursor:pointer;" />
			</td>
		</tr>
	</tbody>
</table>
</td>
<td align="center">
<b>Bachelor Gulch</b>
<table>
	<tbody>
		<tr>
			<td>
			<img src="http://beavercreekonline.com/images/qs_home.jpg" onmouseover="javascript:return overlib(\'Single Family\',BGCOLOR,\'#444499\',WIDTH,90);" onmouseout="javascript:return nd();" onclick="window.open(\'index.php?option=com_portaladv&task=search&Itemid=69&limitstart=&subdivision=&area[]=Bachelor+Gulch&price_min=&price_max=&prop_type[]=single+family&num_bedrooms[]=0&num_bathrooms[]=0&squarefeet_min=&squarefeet_max=&lat_min=0&lat_max=0&lng_min=0&lng_min=0&task=search&limit=10&task=search&search_type=filter\',\'_self\');" border="0" style="cursor:pointer;" />
			</td>
			<td>
			<img src="http://beavercreekonline.com/images/qs_condo.jpg" onmouseover="javascript:return overlib(\'Condos\',BGCOLOR,\'#444499\',WIDTH,90);" onmouseout="javascript:return nd();" onclick="window.open(\'index.php?option=com_portaladv&task=search&Itemid=69&limitstart=&subdivision=&area[]=Bachelor+Gulch&price_min=&price_max=&prop_type[]=condo&num_bedrooms[]=0&num_bathrooms[]=0&squarefeet_min=&squarefeet_max=&lat_min=0&lat_max=0&lng_min=0&lng_min=0&task=search&limit=10&task=search&search_type=filter\',\'_self\');" border="0" style="cursor:pointer;" />
			</td>
		</tr>
		<tr>
			<td>
			<img src="http://beavercreekonline.com/images/qs_townhome.jpg" onmouseover="javascript:return overlib(\'Townhomes\',BGCOLOR,\'#444499\',WIDTH,90);" onmouseout="javascript:return nd();" onclick="window.open(\'index.php?option=com_portaladv&task=search&Itemid=69&limitstart=&subdivision=&area[]=Bachelor+Gulch&price_min=&price_max=&prop_type[]=townhouse&num_bedrooms[]=0&num_bathrooms[]=0&squarefeet_min=&squarefeet_max=&lat_min=0&lat_max=0&lng_min=0&lng_min=0&task=search&limit=10&task=search&search_type=filter\',\'_self\');" border="0" style="cursor:pointer;" />
			</td>
			<td>
			<img src="http://beavercreekonline.com/images/qs_land.jpg" onmouseover="javascript:return overlib(\'Land\',BGCOLOR,\'#444499\',WIDTH,90);" onmouseout="javascript:return nd();" onclick="window.open(\'index.php?option=com_portaladv&task=search&Itemid=69&limitstart=&subdivision=&area[]=Bachelor+Gulch&price_min=&price_max=&prop_type[]=land&num_bedrooms[]=0&num_bathrooms[]=0&squarefeet_min=&squarefeet_max=&lat_min=0&lat_max=0&lng_min=0&lng_min=0&task=search&limit=10&task=search&search_type=filter\',\'_self\');" border="0" style="cursor:pointer;" />
			</td>
		</tr>
	</tbody>
</table>
</td>
<td align="center">
<b>Arrowhead</b>
<table>
	<tbody>
		<tr>
			<td>
			<img src="http://beavercreekonline.com/images/qs_home.jpg" onmouseover="javascript:return overlib(\'Single Family\',BGCOLOR,\'#444499\',WIDTH,90);" onmouseout="window.open(\'index.php?option=com_portaladv&task=search&Itemid=69&limitstart=&subdivision=&area[]=Arrowhead&price_min=&price_max=&prop_type[]=single+family&num_bedrooms[]=0&num_bathrooms[]=0&squarefeet_min=&squarefeet_max=&lat_min=0&lat_max=0&lng_min=0&lng_min=0&task=search&limit=10&task=search&search_type=filter\',\'_self\');" border="0" style="cursor:pointer;" />
			</td>
			<td>
			<img src="http://beavercreekonline.com/images/qs_condo.jpg" onmouseover="javascript:return overlib(\'Condos\',BGCOLOR,\'#444499\',WIDTH,90);" onmouseout="javascript:return nd();" onclick="window.open(\'index.php?option=com_portaladv&task=search&Itemid=69&limitstart=&subdivision=&area[]=Arrowhead&price_min=&price_max=&prop_type[]=condo&num_bedrooms[]=0&num_bathrooms[]=0&squarefeet_min=&squarefeet_max=&lat_min=0&lat_max=0&lng_min=0&lng_min=0&task=search&limit=10&task=search&search_type=filter\',\'_self\');" border="0" style="cursor:pointer;" />
			</td>
		</tr>
		<tr>
			<td>
			<img src="http://beavercreekonline.com/images/qs_townhome.jpg" onmouseover="javascript:return overlib(\'Townhomes\',BGCOLOR,\'#444499\',WIDTH,90);" onmouseout="javascript:return nd();" onclick="window.open(\'index.php?option=com_portaladv&task=search&Itemid=69&limitstart=&subdivision=&area[]=Arrowhead&price_min=&price_max=&prop_type[]=townhouse&num_bedrooms[]=0&num_bathrooms[]=0&squarefeet_min=&squarefeet_max=&lat_min=0&lat_max=0&lng_min=0&lng_min=0&task=search&limit=10&task=search&search_type=filter\',\'_self\');" border="0" style="cursor:pointer;" />
			</td>
			<td>
			<img src="http://beavercreekonline.com/images/qs_land.jpg" onmouseover="javascript:return overlib(\'Land\',BGCOLOR,\'#444499\',WIDTH,90);" onmouseout="javascript:return nd();" onclick="window.open(\'index.php?option=com_portaladv&task=search&Itemid=69&limitstart=&subdivision=&area[]=Arrowhead&price_min=&price_max=&prop_type[]=land&num_bedrooms[]=0&num_bathrooms[]=0&squarefeet_min=&squarefeet_max=&lat_min=0&lat_max=0&lng_min=0&lng_min=0&task=search&limit=10&task=search&search_type=filter\',\'_self\');" border="0" style="cursor:pointer;" />
			</td>
		</tr>
	</tbody>
</table>
</td>
<td>
<!--
<b>Mountain Star</b>
<table>
	<tbody>
		<tr>
			<td>
			<img src="http://beavercreekonline.com/images/qs_home.jpg" onmouseover="return overlib(\'Single Family\',BGCOLOR,\'#444499\',WIDTH,90);" onmouseout="return nd();" onclick="doQuickSearch(\'Mountain Star\',\'Single Family\',\'\');" border="0" />
			</td>
			<td>
			<img src="http://beavercreekonline.com/images/qs_land.jpg" onmouseover="return overlib(\'Land\',BGCOLOR,\'#444499\',WIDTH,90);" onmouseout="return nd();" onclick="doQuickSearch(\'Mountain Star\',\'\',\'Land\');" border="0" />
			</td>
		</tr>
		<tr>
		</tr>
	</tbody>
</table>
-->
</td></tr></table>
<h2><u>Map Search</h2></u>
<p><strong><a href="http://www.beavercreekonline.com/index.php?option=com_resource&view=article&article=&Itemid=231">Discover Beaver Creek like never before!</a></strong>  Our Interactive Map is your Virtual Door into everything you need to know including Real Estate, Shops, Restaurants and Activities! </p>
<a href="index.php?option=com_resource&view=article&article=&Itemid=231"><img src="components/com_portaladv/images/interactive_map.jpg" alt="Beaver Creek Interactive Map" border="0" /></a>
');

#FAVORITES
DEFINE('ADD_TO_FAVORITES','Save Listing');
DEFINE('FAVORITE_SAVED','Saved');
DEFINE('PRIMARY_STATE','CO');

#BUTTONS
DEFINE('BUTTON_DETAILS','Details');
DEFINE('BUTTON_ADD_TO_FAVORITES','Save');
DEFINE('BUTTON_ADD_TO_BOOKMARK','Bookmark this Page');
DEFINE('BUTTON_BACK_TO_SEARCH_RESULTS','&laquo; Back');
DEFINE('BUTTON_FAVORITE_SAVED','Saved');
DEFINE('BUTTON_VIRTUAL_TOUR','Virtual Tour');
DEFINE('BUTTON_PRINT_LISTING','Print this listing');
DEFINE('BUTTON_SAVE_SEARCH','Save This Search');

#SEARCH FILTER HEADERS
DEFINE('SEARCH_FILTER_TITLE','Search Filter');
DEFINE('FILTER_HEADER_BATHROOMS','Bathrooms');
DEFINE('FILTER_HEADER_BEDROOMS','Bedrooms');
DEFINE('FILTER_HEADER_FEATURES','Features');
DEFINE('FILTER_HEADER_LOCATION','Location');
DEFINE('FILTER_HEADER_MLS_NUM','MLS #');
DEFINE('FILTER_HEADER_PRICE_RANGE','Price Range');
DEFINE('FILTER_HEADER_PROPERTY_TYPE','Property Type');
DEFINE('FILTER_HEADER_SQUARE_FEET','Square Feet');
DEFINE('FILTER_HEADER_SUBDIVISION','Subdivision');

#SEARCH FILTER LABELS
DEFINE('FILTER_LABEL_UPDATE_LOCATIONS',' Search ');
DEFINE('FILTER_LABEL_UPDATE_PRICE',' Search ');
DEFINE('FILTER_LABEL_UPDATE_PROPERTY_TYPE',' Search ');
DEFINE('FILTER_LABEL_UPDATE_BED_BATH',' Search ');
DEFINE('FILTER_LABEL_UPDATE_SQUAREFEET',' Search ');
DEFINE('FILTER_LABEL_SEARCH_AGAIN',' Search ');

#PROPERTY LISTINGS
DEFINE('BEDROOM_ABBREV_1','Bedroom');
DEFINE('BEDROOM_ABBREV_MANY','Bedrooms');
DEFINE('BATHROOM_ABBREV_1','Bath');
DEFINE('BATHROOM_ABBREV_MANY','Baths');
DEFINE('DETAILS_LINK','photos & details');
DEFINE('LISTING_PROVIDER','Provider');
DEFINE('SQUAREFEET_ABBREV','sqft');

#PROPERTY DETAILS
DEFINE('ADDITIONAL_COMMENTS_TITLE','Additional Comments');
DEFINE('ADDITIONAL_ROOMS_TITLE','Additional Rooms');
DEFINE('AMENITIES_TITLE','Amenities');
DEFINE('APPLIANCES_TITLE','Appliances');
DEFINE('ASSOCIATION_DUES_TITLE','Association Dues / Frequency');
DEFINE('CONSTRUCTION_TITLE','Construction');
DEFINE('FEATURES_TITLE','Features');
DEFINE('FLOORING_TITLE','Flooring');
DEFINE('FURNISHED_TITLE','Furnishing');
DEFINE('HEATING_TITLE','Heating');
DEFINE('LAUNDRY_TITLE','Laundry');
DEFINE('LISTING_NUM_TITLE','MLS#');
DEFINE('LOCATION_TITLE','Location');
DEFINE('LOT_ACREAGE_TITLE','Lot Acreage');
DEFINE('LOT_SQUARE_FOOTAGE_TITLE','Lot Square Footage');
DEFINE('PROPERTY_SUB_TYPE_TITLE','Property Type');
DEFINE('ROOFING_TITLE','Roofing');
DEFINE('SEWER_TITLE','Sewer');
DEFINE('TAXES_TITLE','Taxes / Tax Year');
DEFINE('TRANSFER_TAX_TITLE','Transfer Tax');
DEFINE('UTILITIES_TITLE','Utilities');
DEFINE('VIEW_TITLE','View');

#CONTACT FORMS
DEFINE('GENERAL_CONTACT_FORM_TITLE','Contact Us');
DEFINE('GENERAL_CONTACT_US_TEXT','<strong>Kenton Hopkins MRE, CRS, GRI<br />& David McHugh e-PRO</strong> are at your service.<br /><br />Simply fill out the form below and we\'ll get back to you right away.');
DEFINE('GENERAL_CONTACT_FORM_IMAGE','bco_logo_white_bg.jpg');

DEFINE('CONTACT_US_TEXT','<span class="contact_us_line1">Have a question about this listing?</span><br /><br /><strong>Kenton Hopkins MRE, CRS, GRI<br />& David McHugh e-PRO</strong> are at your service.<br /><br />Simply fill out the form below and we\'ll get back to you right away.');
DEFINE('CONTACT_US_THANK_YOU_TEXT','Thank you for your inquiry. Kenton Hopkins & David McHugh will contact you shortly. We look forward to helping you find your Colorado dream home.');
DEFINE('CONTACT_US_THANK_YOU_EMAIL_TEXT','Thank you for your inquiry. Kenton Hopkins & David McHugh will contact you shortly. We look forward to helping you find your Colorado dream home.');

DEFINE('CONTACT_US_EMAIL','daniel@vailpm.com,dmchugh@slifer.net');
DEFINE('CONTACT_US_BROKER_EMAIL_FROM','info@beavercreekonline.com');
DEFINE('CONTACT_US_CLIENT_EMAIL_FROM','dmchugh@slifer.net');
DEFINE('CONTACT_US_SUBJECT','BeaverCreekOnline.com Inquiry');

DEFINE('EMAIL_SUBJECT_BUILDING','BCO.com Building Inquiry');
DEFINE('EMAIL_SUBJECT_MLS','BCO.com MLS Listing Inquiry');
DEFINE('EMAIL_SUBJECT_GENERAL','BCO.com General Inquiry');

#SEARCH RESULTS
DEFINE('DEFAULT_NO_RESULTS_TEXT','<h3>No matches found.</h3><p>No listings match your search.<br />Please change your criteria and search again.</p>');

#INTERACTIVE MAP
DEFINE('INTERACTIVE_MAP_INSTRUCTIONS','<p style="font-size:16px;line-height:20px;">The <strong>Interactive Map</strong> above enables you to view different properties in the Beaver Creek area.</p>
<ul>
<li>Click on the map and drag it to see more in every direction.</li>
<li>Hover cursor over a blue dot for specific property details.</li>
</ul>');

#BUILDING DETAILS
DEFINE('BUILDING_DETAILS_RECENT_SALES','Request More Information');

/**
*
*/


/*****************************************************************************
/*
/*
/*					SEARCH FILTER SETTINGS
/*
/*
/*****************************************************************************/

DEFINE('PREFERRED_LOCATION1','Beaver Creek');
DEFINE('PREFERRED_LOCATION2','Bachelor Gulch');
DEFINE('PREFERRED_LOCATION3','Arrowhead');

/**
*
*/


//mls images
DEFINE('PATH_TO_LISTING_IMAGES','rets_photos');
DEFINE('IMAGE_FILENAME_PRETEXT','image-');
DEFINE('IMAGE_FILENAME_POSTTEXT','-'); // for eagle county RETS, images are named 'image-sysid-number' (ie image-22346758-2.jpg)
DEFINE('FEATURED_LISTING_IMAGE_WIDTH_VERTICAL','283');


/*****************************************************************************
/*
/*
/*					DATABASE FIELDS
/*
/*
/*****************************************************************************/

//field names
DEFINE('FIELDNAME_LISTING_AGENT_ID','ListingAgentMLSID');
DEFINE('FIELDNAME_LISTING_DATABASE_ID','ListingRid');
DEFINE('FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID','ListingRid');
DEFINE('FIELDNAME_RESIDENTIAL_LISTING_NUM','ListingNumberDisplay');
DEFINE('FIELDNAME_RESIDENTIAL_ADDRESS_NUM','StreetNumber');
DEFINE('FIELDNAME_RESIDENTIAL_STREET_NAME','StreetName');
DEFINE('FIELDNAME_RESIDENTIAL_STREET_SUFFIX','StreetSuffix');
DEFINE('FIELDNAME_RESIDENTIAL_AREA','Area');
DEFINE('FIELDNAME_RESIDENTIAL_CITY','City');
DEFINE('FIELDNAME_RESIDENTIAL_CURRENT_DAYS_ON_MARKET','ListingDate');
DEFINE('FIELDNAME_RESIDENTIAL_STATE','State');
DEFINE('FIELDNAME_RESIDENTIAL_ZIP_CODE','ZipCode');
DEFINE('FIELDNAME_RESIDENTIAL_COUNTY','County');
DEFINE('FIELDNAME_RESIDENTIAL_GARAGE','GarageSpaces');
//DEFINE('FIELDNAME_RESIDENTIAL_KEYWORD','');
DEFINE('FIELDNAME_RESIDENTIAL_MLS_NUM','MLNumber');
DEFINE('FIELDNAME_RESIDENTIAL_PROP_TYPE','PropertyType');
DEFINE('FIELDNAME_RESIDENTIAL_PRICE','ListingPrice');
DEFINE('FIELDNAME_RESIDENTIAL_PRICE_MIN','ListingPrice');
DEFINE('FIELDNAME_RESIDENTIAL_PRICE_MAX','ListingPrice');
DEFINE('FIELDNAME_RESIDENTIAL_NUM_BEDROOMS','Bedrooms');
DEFINE('FIELDNAME_RESIDENTIAL_NUM_BATHROOMS','Bathrooms');
DEFINE('FIELDNAME_RESIDENTIAL_SQUAREFEET','SquareFootage');
//DEFINE('FIELDNAME_RESIDENTIAL_SQUAREFEET_MIN','_1917');
//DEFINE('FIELDNAME_RESIDENTIAL_SQUAREFEET_MAX','_1917');
DEFINE('FIELDNAME_RESIDENTIAL_SUBDIVISION','Subdivision');
DEFINE('FIELDNAME_RESIDENTIAL_YEAR_BUILT','YearBuilt');

DEFINE('FIELDNAME_PARTIAL_PRICE','ListingPrice');
DEFINE('FIELDNAME_PARTIAL_LISTING_DATABASE_ID','_sysid');
DEFINE('FIELDNAME_PARTIAL_LISTING_NUM','ListingNumberDisplay');
DEFINE('FIELDNAME_PARTIAL_ADDRESS_NUM','_45');
DEFINE('FIELDNAME_PARTIAL_AREA','_63');
DEFINE('FIELDNAME_PARTIAL_CITY','_1883');
DEFINE('FIELDNAME_PARTIAL_CURRENT_DAYS_ON_MARKET','_31');
DEFINE('FIELDNAME_PARTIAL_STATE','_2005');
DEFINE('FIELDNAME_PARTIAL_ZIP_CODE','_42');
DEFINE('FIELDNAME_PARTIAL_COUNTY','_17');
DEFINE('FIELDNAME_PARTIAL_GARAGE','_478');
DEFINE('FIELDNAME_PARTIAL_KEYWORD','_470');
DEFINE('FIELDNAME_PARTIAL_PROP_TYPE','_1');
DEFINE('FIELDNAME_PARTIAL_PRICE','ListingPrice');
DEFINE('FIELDNAME_PARTIAL_PRICE_MIN','ListingPrice');
DEFINE('FIELDNAME_PARTIAL_PRICE_MAX','ListingPrice');
DEFINE('FIELDNAME_PARTIAL_MLS_NUM','MLNumber');
DEFINE('FIELDNAME_PARTIAL_NUM_BEDROOMS','_30');
DEFINE('FIELDNAME_PARTIAL_NUM_BATHROOMS','_2021');
DEFINE('FIELDNAME_PARTIAL_SQUAREFEET','_1917');
DEFINE('FIELDNAME_PARTIAL_SQUAREFEET_MIN','_1917');
DEFINE('FIELDNAME_PARTIAL_SQUAREFEET_MAX','_1917');
DEFINE('FIELDNAME_PARTIAL_SUBDIVISION','_1885');
DEFINE('FIELDNAME_PARTIAL_YEAR_BUILT','_51');

DEFINE('FIELDNAME_LISTING_ADDITIONAL_ROOMS','RESIADDL');
DEFINE('FIELDNAME_LISTING_ADDRESS_NUM','StreetNumber');
DEFINE('FIELDNAME_LISTING_AGENT_NAME','ListingAgentFullName');
DEFINE('FIELDNAME_LISTING_AMENITIES','RESIAMEN');
DEFINE('FIELDNAME_LISTING_APPLIANCES','RESIAPPL');
//DEFINE('FIELDNAME_LISTING_ASSOCIATION_DUES','_1907');
//DEFINE('FIELDNAME_LISTING_ASSOCIATION_DUES_FREQUENCY','_1861');
DEFINE('FIELDNAME_LISTING_CITY','City');
DEFINE('FIELDNAME_LISTING_CONSTRUCTION','RESIEXTE');
//DEFINE('FIELDNAME_LISTING_CURRENT_DAYS_ON_MARKET','_31');
DEFINE('FIELDNAME_LISTING_OFFICE_NAME','ListingOfficeName');
DEFINE('FIELDNAME_LISTING_FEATURES','RESIAMEN');
//DEFINE('FIELDNAME_LISTING_FLOORING','_477');
DEFINE('FIELDNAME_LISTING_FURNISHED','RESIFURN');
DEFINE('FIELDNAME_LISTING_HEATING','RESIHEAT');
DEFINE('FIELDNAME_LISTING_LATITUDE','Latitude');
DEFINE('FIELDNAME_LISTING_LAUNDRY','RESILAUN');
DEFINE('FIELDNAME_LISTING_LOCATION','RESILOCA');
DEFINE('FIELDNAME_LISTING_LONGITUDE','Longitude');
DEFINE('FIELDNAME_LISTING_LOT_ACREAGE','Acres');
DEFINE('FIELDNAME_LISTING_LOT_SQUARE_FOOTAGE','LotSquareFootage');
DEFINE('FIELDNAME_LISTING_MLS_NUM','MLNumber');
DEFINE('FIELDNAME_LISTING_MLS_BOOK_REMARKS','MarketingRemarks');
DEFINE('FIELDNAME_LISTING_ROOFING','RESIROOF');
DEFINE('FIELDNAME_LISTING_SEWER','RESISEWE');
DEFINE('FIELDNAME_LISTING_STATE','State');
DEFINE('FIELDNAME_LISTING_SUB_TYPE','PropertySubtype1');
DEFINE('FIELDNAME_LISTING_PRICE','ListingPrice');
## added Rich S Wyatt 10/19/2010
DEFINE('FIELDNAME_LISTING_PROP_TYPE','PropertyType');
DEFINE('FIELDNAME_LISTING_SUBDIVISION','Subdivision');
//DEFINE('FIELDNAME_LISTING_TAX_YEAR','_1891');
//DEFINE('FIELDNAME_LISTING_TAXES','_1889');
//DEFINE('FIELDNAME_LISTING_TRANSFER_TAX','_2049');
DEFINE('FIELDNAME_LISTING_UNIT_NUMBER','Unit');
//DEFINE('FIELDNAME_LISTING_UTILITIES','_472');
DEFINE('FIELDNAME_LISTING_VIRTUAL_TOUR_LINK','VirtualTourURL');
DEFINE('FIELDNAME_LISTING_VIEW','RESIVIEW');

DEFINE('FIELDNAME_LAND_ADDITIONAL_ROOMS','_469');
DEFINE('FIELDNAME_LAND_ADDRESS_NUM','StreetNumber');
DEFINE('FIELDNAME_LAND_AGENT_NAME','ListingAgentFullName');
DEFINE('FIELDNAME_LAND_AMENITIES','LANDAMEN');
//DEFINE('FIELDNAME_LAND_APPLIANCES','_470');
DEFINE('FIELDNAME_LAND_AREA','Area');
//DEFINE('FIELDNAME_LAND_ASSOCIATION_DUES','_1907');
//DEFINE('FIELDNAME_LAND_ASSOCIATION_DUES_FREQUENCY','_1861');
DEFINE('FIELDNAME_LAND_CITY','City');
//DEFINE('FIELDNAME_LAND_CONSTRUCTION','_475');
DEFINE('FIELDNAME_LAND_CURRENT_DAYS_ON_MARKET','ListingDate');
DEFINE('FIELDNAME_LAND_OFFICE_NAME','ListingOfficeName');
//DEFINE('FIELDNAME_LAND_FEATURES','_481');
//DEFINE('FIELDNAME_LAND_FLOORING','_477');
//DEFINE('FIELDNAME_LAND_FURNISHED','_1903');
//DEFINE('FIELDNAME_LAND_HEATING','_480');
DEFINE('FIELDNAME_LAND_LATITUDE','Latitude');
//DEFINE('FIELDNAME_LAND_LAUNDRY','_482');
DEFINE('FIELDNAME_LAND_LOCATION','LANDLOCA');
DEFINE('FIELDNAME_LAND_LONGITUDE','Longitude');
DEFINE('FIELDNAME_LAND_LOT_ACREAGE','Acres');
DEFINE('FIELDNAME_LAND_LOT_SQUARE_FOOTAGE','LotSquareFootage');
DEFINE('FIELDNAME_LAND_MLS_BOOK_REMARKS','MarketingRemarks');
DEFINE('FIELDNAME_LAND_MLS_NUM','MLNumber');
//DEFINE('FIELDNAME_LAND_NUM_BEDROOMS','_30');
//DEFINE('FIELDNAME_LAND_NUM_BATHROOMS','_2021');
DEFINE('FIELDNAME_LAND_PRICE','ListingPrice');
DEFINE('FIELDNAME_LAND_PRICE_MIN','ListingPrice');
DEFINE('FIELDNAME_LAND_PRICE_MAX','ListingPrice');
DEFINE('FIELDNAME_LAND_PROP_TYPE','PropertyType');
//DEFINE('FIELDNAME_LAND_ROOFING','_485');
DEFINE('FIELDNAME_LAND_SEWER','LANDSEWE');
DEFINE('FIELDNAME_LAND_SQUAREFEET','LotSquareFootage');
//DEFINE('FIELDNAME_LAND_SQUAREFEET_MIN','_1917');
//DEFINE('FIELDNAME_LAND_SQUAREFEET_MAX','_1917');
DEFINE('FIELDNAME_LAND_STATE','State');
DEFINE('FIELDNAME_LAND_SUB_TYPE','PropertySubtype1');
DEFINE('FIELDNAME_LAND_SUBDIVISION','Subdivision');
//DEFINE('FIELDNAME_LAND_TAX_YEAR','_1891');
//DEFINE('FIELDNAME_LAND_TAXES','_1889');
//DEFINE('FIELDNAME_LAND_TRANSFER_TAX','_2049');
DEFINE('FIELDNAME_LAND_UNIT_NUMBER','_2141');
DEFINE('FIELDNAME_LAND_UTILITIES','_472');
DEFINE('FIELDNAME_LAND_VIRTUAL_TOUR_LINK','VirtualTourURL');
DEFINE('FIELDNAME_LAND_VIEW','LANDVIEW');

DEFINE('FIELDNAME_PROPERTY_TYPE','_1');
DEFINE('FIELDNAME_PROPERTY_REMARKS1','MarketingRemarks');
//DEFINE('FIELDNAME_PROPERTY_REMARKS2','_1969');

//field values
DEFINE('FIELDVALUE_LISTING_SUB_TYPE_SINGLE_FAMILY','Single Family');
DEFINE('FIELDVALUE_LISTING_SUB_TYPE_CONDO','Condo');
DEFINE('FIELDVALUE_LISTING_SUB_TYPE_TOWNHOUSE','Townhouse');


/*****************************************************************************
/*
/*
/*					OPTIONAL FEATURES
/*
/*
/*****************************************************************************/

DEFINE('PROPERTY_DETAILS_NEIGHBORHOOD_FEATURES','0');

//DEFINE('FIELDNAME_RESIDENTIAL_LATITUDE_MIN','latitude');
//DEFINE('FIELDNAME_RESIDENTIAL_LATITUDE_MAX','latitude');
//DEFINE('FIELDNAME_RESIDENTIAL_LONGITUDE_MIN','longitude');
//DEFINE('FIELDNAME_RESIDENTIAL_LONGITUDE_MAX','longitude');

/*
DEFINE('FIELDNAME_CONDO_CITY','city');
DEFINE('FIELDNAME_CONDO_ZIP_CODE','zip_code');
DEFINE('FIELDNAME_CONDO_AREA','area');
DEFINE('FIELDNAME_CONDO_PROP_TYPE','property_type');
DEFINE('FIELDNAME_CONDO_PRICE_MIN','price');
DEFINE('FIELDNAME_CONDO_PRICE_MAX','price');
DEFINE('FIELDNAME_CONDO_NUM_BEDROOMS','bedrooms_total');
DEFINE('FIELDNAME_CONDO_NUM_BATHROOMS','baths_total');
DEFINE('FIELDNAME_CONDO_SQUAREFEET_MIN','total_square_feet');
DEFINE('FIELDNAME_CONDO_SQUAREFEET_MAX','total_square_feet');
DEFINE('FIELDNAME_CONDO_KEYWORD','desc1');
DEFINE('FIELDNAME_CONDO_LATITUDE_MIN','latitude');
DEFINE('FIELDNAME_CONDO_LATITUDE_MAX','latitude');
DEFINE('FIELDNAME_CONDO_LONGITUDE_MIN','longitude');
DEFINE('FIELDNAME_CONDO_LONGITUDE_MAX','longitude');

DEFINE('FIELDNAME_LAND_AREA','area');
DEFINE('FIELDNAME_LAND_PROP_TYPE','property_type');
DEFINE('FIELDNAME_LAND_PRICE_MIN','price');
DEFINE('FIELDNAME_LAND_PRICE_MAX','price');
DEFINE('FIELDNAME_LAND_KEYWORD','desc1');
*/


//yahoo weather id
DEFINE('YAHOOO_WEATHER_ZONE_ID','');

//mls number field
DEFINE('FIELDNAME_MLS_NUM','_sysid');

//agent number
DEFINE('FIELDNAME_AGENT_NUM','131702');

//Yahoo App ID
DEFINE('YAHOO_APP_ID','QtUKCkTIkY3G.o3rKI2Y81BtymWNkDPaAErnfaHg');

//Google Maps API key
DEFINE('GOOGLE_MAPS_API_KEY','ABQIAAAA99sQHyngaFshG3zxfO9_4BShCnhYgnAGGaly_9gE8fqprPFKChRV1KlXWzq8cnCNuGTiAY2Ykx--MQ');

//Google Map Search Default Coordinates
//Denver, CO
DEFINE('DEFAULT_LAT','39.754');
DEFINE('DEFAULT_LONG','-104.99');
//DEFINE('DEFAULT_LONG','-104.85');
DEFINE('DEFAULT_ZOOM','15');

//SEARCH LOGGING STRINGS
DEFINE('VIEWTYPE_FRONT_PAGE_FEATURED','FPF');
DEFINE('VIEWTYPE_INTERNAL_PAGE_FEATURED','IPF');
DEFINE('VIEWTYPE_SEARCH_RESULTS','SR');

/*****************************************************************************
/*
/*
/*					PRINTED LISTING DETAILS
/*
/*
/*****************************************************************************/

DEFINE('PRINTLISTING_FOOTER_CONTACT_US_TEXT',"We're here to help. Call <strong>970-845-8053</strong> or email <strong>dmchugh@slifer.net</strong>");

?>
