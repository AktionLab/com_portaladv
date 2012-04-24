<?php
/**
 * @package		PortalAdv
 * @subpackage	Interactive Map
 * @copyright	Copyright (C) 2008 Vail Pro Media. All rights reserved.
 * @license		Commercial
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the Portal Advantage Interactive Map for Beaver Creek
 *
 */
class PortalAdvViewBuildingDetails extends JView
{
	function display($tpl = null)
	{
		global $mainframe;
		
		//include helpers
		include_once(JPATH_ROOT.DS."/components/com_portaladv/helpers/idx.php");
		
		//include javascripts
		$document =& JFactory::getDocument();
		
		$js1 = "components/com_portaladv/javascript/flashobject.js";
		$js2 = "components/com_portaladv/javascript/portaladv.js";		
		//$js3 = "http://maps.google.com/maps?file=api&v=2&key=ABQIAAAA99sQHyngaFshG3zxfO9_4BShCnhYgnAGGaly_9gE8fqprPFKChRV1KlXWzq8cnCNuGTiAY2Ykx--MQ";
		$js4 ="http://www.google.com/jsapi?key=ABCDEFG";
		$js5 = "http://www.google.com/uds/api?file=uds.js&amp;v=1.0&amp;key=internal-sample";
		$js6 = "components/com_portaladv/javascript/portaladv_mapsearch.js";
		$js7 = "components/com_portaladv/includes/xc2/config/xc2_default.js";
		$js8 = "components/com_portaladv/includes/xc2/script/xc2_inpage.js";
		$js9 = "includes/js/sexy-alert-box-1.2.2/mootools/sexyalertbox.v1.2.moo.js";
		$js10 = "http://ajax.googleapis.com/ajax/libs/mootools/1.2.1/mootools-yui-compressed.js";


		//add javascripts
		$document->addScript($js10);
		$document->addScript(JURI::base() . $js1);
		$document->addScript(JURI::base() . $js2);
		$document->addScript($js3);
		$document->addScript($js4);
		$document->addScript($js5);
		$document->addScript(JURI::base() . $js6);
		$document->addScript(JURI::base() . $js7);
		$document->addScript(JURI::base() . $js8);
		$document->addScript(JURI::base() . $js9);
		
		
		//add stylesheets
		$document->addStyleSheet("/components/com_portaladv/portaladv.css");
		$document->addStyleSheet("/components/com_portaladv/includes/xc2/css/xc2_default.css");
		$document->addStyleSheet("/includes/js/sexy-alert-box-1.2.2/mootools/sexyalertbox.css");
		$document->addStyleSheet("/includes/js/sexy-alert-box-1.2.2/mootools/global.css");
		
		$details =& $this->get('BuildingDetails');

		switch($details->title) {
			case 'Stonegate':
				$string = "HIGHLANDS TOWNHOMES";
				break;
			case 'Custom Homes on Village Walk':
				$string = "VILLAGE WALK";
				break;
			case 'The Kiva':
				$string = "FREMONT HOUSE ( KIVA )";
				break;
			case 'The Aspens':
				$string = "ASPENS THE";
				break;
			case 'Royal Elk Villas':
				$string = "BORDERS TOWNHOMES";
				break;
			case 'The Pines Townhomes':
				$string = "PINES TH AT BEAVER CREEK THE";
				break;
			case 'The Chateau Chalets':
				$string = "CHATEAU THE SF";
				break;
			case 'The Chateau Terrace':
				$string = "CHATEAU TERRACE THE";
				break;
			case 'Strawberry Park Condominiums':
				$string = "STRAWBERRY PARK CONDO";
				break;
			case 'The Meadows':
				$string = "THE MEADOWS";
				break;
			case 'Snow Cloud':
				//$string = "SNOW CLOUD PHASE 1,SNOW CLOUD PHASE 2";
			default:
				$string = $details->searchstring;// strtoupper($details->title);
				break;
		}

		$string = $details->searchstring;
		$aString = explode(",",$string);
		foreach($aString as $str) {
			$searchString .= FIELDNAME_LISTING_SUBDIVISION . " LIKE '%" . trim($str) . "%' OR ";
		}
		$searchString = substr($searchString,0,strlen($searchString)-4);
		
		$document->setTitle($details->title);
		
		$idxDB = PortalAdvHelperIDX::getDB();
		$query = "SELECT * FROM " . LISTINGS_TABLE_RESIDENTIAL . " WHERE " . $searchString;
		//echo $query;
		//die();
		//$query .= "";
		
		$idxDB->setQuery($query);
		
		if($result = $idxDB->loadObjectList()) {
			$count = count($result);
		} else {
			$count = 0;
		}
		
		$details->properties_available = $count;
		$details->subdivision = $string;

		$this->assignRef('details', $details);

		
		parent::display($tpl);	
	}
	
}