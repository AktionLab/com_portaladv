<?php
/**
 * @package		PortalAdv
 * @subpackage	Contact Forms
 * @copyright	Copyright (C) 2008 Vail Pro Media. All rights reserved.
 * @license		Commercial
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the Portal Advantage Contact Forms
 *
 * @static
 * @package		Joomla
 * @subpackage	Weblinks
 * @since 1.0
 *
 */
 
class PortalAdvViewContact extends JView
{
	function display($tpl = null)
	{
		global $mainframe;
		
		//include PortalAdv javascripts
		$document =& Jfactory::getDocument();
				
		$document->addStyleSheet("/components/com_portaladv/portaladv.css");

		parent::display($tpl);	
	}
}
