<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML Article View class for the Content component
 *
 * @package		Joomla
 * @subpackage	Content
 * @since 1.5
 */
class PortalAdvViewDetails extends JView
{
	function display($tpl = null)
	{
		global $mainframe;
	
		//include PortalAdv constants
		require_once(JPATH_ROOT.DS."components/com_portaladv/constants.php");
		
		// Initialize some variables
		$listing = $this->get('PropertyDetails');
		
		$document = &JFactory::getDocument();
		
		$document->setTitle('');

		
		$output .= "
			<table>
				<tr>
					<td bgcolor=blue>";
					
/*
* 
* BEGIN CUSTOM BCO INTEGRATION
* - if condo or townhouse, user subdivision and unit #, else use address -
*
**/			

if ($listing->{FIELDNAME_LISTING_SUB_TYPE} == 'Condo' || $listing->{FIELDNAME_LISTING_SUB_TYPE} == 'Townhouse') {
	echo ucwords(strtolower($listing->{FIELDNAME_RESIDENTIAL_SUBDIVISION})) . " - Unit # " . $listing->{FIELDNAME_LISTING_UNIT_NUMBER};
} else {
	echo ucwords(strtolower($listing->{FIELDNAME_RESIDENTIAL_ADDRESS_NUM}));
}

/*
* 
* END CUSTOM BCO INTEGRATION
*
**/			

			$output .= "
					</td>
				</tr>
		";
		
		echo $output;
	}
}
?>