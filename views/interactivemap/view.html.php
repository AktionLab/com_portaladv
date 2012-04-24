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
class PortalAdvViewInteractiveMap extends JView
{
	function display($tpl = null)
	{
		global $mainframe;
		
		//include javascripts
		$document =& JFactory::getDocument();
		
		$js1 = "/components/com_portaladv/javascript/flashobject.js";

		$document->addScript($js1);

		parent::display($tpl);
	}
	
}
