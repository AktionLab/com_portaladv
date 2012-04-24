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
 * Interactive Map Model
 *
 * @package		PortalAdv
 * @subpackage	Advanced Search
 * @since 1.5
 */
class PortalAdvModelInteractiveMap extends JModel
{

	/**
	 * Constructor
	 *
	 */
	function __construct()
	{
		parent::__construct();

		global $mainframe;
	
	}

}