<?php
/**
 * @package		PortalAdv
 * @subpackage	Advanced Search
 * @copyright	Copyright (C) 2008 Vail Pro Media. All rights reserved.
 * @license		Commercial
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the Portal Advantage Details View
 *
 * @static
 * @package		Joomla
 * @subpackage	Weblinks
 * @since 1.0
 *
 */
 
class PortalAdvViewDetails extends JView
{
	function display($tpl = null)
	{
		global $mainframe;
		
		//include PortalAdv javascripts
		$document =& Jfactory::getDocument();
		
		$js  = "components/com_portaladv/javascript/portaladv.js";		
		$js1 = "http://maps.google.com/maps?file=api&v=2&key=" . GOOGLE_MAPS_API_KEY;
		$js2 = "http://www.google.com/jsapi?key=ABCDEFG";
		$js3 = "http://www.google.com/uds/api?file=uds.js&amp;v=1.0&amp;key=internal-sample";
		$js4 = "components/com_portaladv/javascript/portaladv_mapsearch.js";
		
		$document->addScript(JURI::base() . $js);		
		$document->addScript($js1);
		$document->addScript($js2);
		$document->addScript($js3);
		$document->addScript(JURI::base() . $js4);
		
		if (JRequest::getVar('format') == 'portaladv_printlisting') {
			$document->addStyleSheet("/components/com_portaladv/portaladv_print.css");
		} else {
			$document->addStyleSheet("/components/com_portaladv/portaladv.css");
		}

		$details =& $this->get('PropertyDetails');
		
		$this->assignRef('details', $details);
		parent::display($tpl);
	}
}
