<?php
/**
 * @package		PortalAdv
 * @subpackage	Advanced Search
 * @copyright	Copyright (C) 2008 Vail Pro Media. All rights reserved.
 * @license		Commercial
 */

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

/**
 * Details View Model
 *
 * @package		PortalAdv
 * @subpackage	Advanced Search
 * @since 1.5
 */
class PortalAdvModelDetails extends JModel
{
	/**
	 * Search data array
	 *
	 * @var array
	 */
	var $_tables = null;

	/**
	 * Search total
	 *
	 * @var integer
	 */
	var $_listing_num = null;
	
	/**
	 * Listing details
	 *
	 * @var object
	 */
	var $_details = null;


	/**
	 * Constructor
	 *
	 * @since 1.5
	 */

	function __construct()
	{

		parent::__construct();

		global $mainframe;

		$tables = array();
		$tables[] = LISTINGS_TABLE_RESIDENTIAL;
		//$tables[] = LISTINGS_TABLE_CONDO;
		$tables[] = LISTINGS_TABLE_LAND;
		$tables[] = LISTINGS_TABLE_PARTIAL;
		//$tables[] = 'listings_income';
		$this->setDetailsTables($tables);
	
		//Set the search areas
		$listing_id = JRequest::getVar('listing');
	 	$this->setListingNum($listing_id);

	}
	
	function setListingNum($listing_id)
	{
		
		$this->_listing_num = $listing_id;
	
	}

	function setDetailsTables($tables)
	{
		
		$this->_tables = $tables;
	
	}

	function getPropertyDetails()
	{

		$idxDB = PortalAdvHelperIDX::getDB();

		foreach($this->_tables as $table) {
	
			$query = 'SELECT * FROM ' . $table . ' WHERE ' . FIELDNAME_RESIDENTIAL_LISTING_DATABASE_ID . ' = ' . $this->_listing_num;			

			$idxDB->setQuery($query);
			
			if ( $results = $idxDB->loadObject() ) {
				$this->_details = $results;
				//get coordinates data for map
				if(defined('FIELDNAME_LISTING_LATITUDE')) {
					$this->_details->latitude = $this->_details->{FIELDNAME_LISTING_LATITUDE};
					$this->_details->longitude = $this->_details->{FIELDNAME_LISTING_LONGITUDE};
				} else {
					$this->getLatLon(&$this->_details);
				}
				
				//find brochure, etc
				$brochure_file = JPATH_BASE.DS.'components'.DS.'com_portaladv'.DS.'assets'.DS.'brochures'.DS.$this->_details->{FIELDNAME_RESIDENTIAL_LISTING_NUM}.'.txt';
				//$brochure_file = JPATH_BASE.DS.'components'.DS.'com_portaladv'.DS.'assets'.DS.'brochures'.DS.'V317113.txt';
				if(file_exists($brochure_file)) {
					$this->_details->brochure = file_get_contents($brochure_file);
				}
				//find floorplan
				$floorplan_file = JPATH_BASE.DS.'components'.DS.'com_portaladv'.DS.'assets'.DS.'floorplans'.DS.$this->_details->{FIELDNAME_RESIDENTIAL_LISTING_NUM}.'.txt';
				//$floorplan_file = JPATH_BASE.DS.'components'.DS.'com_portaladv'.DS.'assets'.DS.'floorplans'.DS.'V317113.txt';
				if(file_exists($floorplan_file)) {
					$this->_details->floorplan = file_get_contents($floorplan_file);
				} 
				//find brochure, etc
				$video_file = JPATH_BASE.DS.'components'.DS.'com_portaladv'.DS.'assets'.DS.'videos'.DS.$this->_details->{FIELDNAME_RESIDENTIAL_LISTING_NUM}.'.txt';
				//$video_file = JPATH_BASE.DS.'components'.DS.'com_portaladv'.DS.'assets'.DS.'videos'.DS.'V317113.txt';
				if(file_exists($video_file)) {
					$this->_details->video = file_get_contents($video_file);
				} 
				
				return $this->_details;
			}
		}
	}
	
	function getLatLon($details)
	{
		$street = str_replace(" ","+",$details->{FIELDNAME_LISTING_ADDRESS_NUM});
		$city = str_replace(" ","+",$details->{FIELDNAME_LISTING_CITY});
		$state = str_replace(" ","+",$details->{FIELDNAME_LISTING_STATE});
		$geourl = "http://local.yahooapis.com/MapsService/V1/geocode?appid=" . YAHOO_APP_ID . "&street=" . $street . "&city=" . $city . "&state=" . $state;

		// Create cUrl object to grab XML content using $geourl
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $geourl);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		$xmlContent = trim(curl_exec($c));
		curl_close($c);
		
		// Create SimpleXML object from XML Content
		$xmlObject = simplexml_load_string($xmlContent);
		
		// Print out all of the XML Object
		//header("Content-type: text/plain");
		//print_r($xmlObject);
		$lat = (string)  $xmlObject->Result->Latitude;
		$long = (string) $xmlObject->Result->Longitude;
		
		$details->latitude = $lat;
		$details->longitude = $long;

	}
}