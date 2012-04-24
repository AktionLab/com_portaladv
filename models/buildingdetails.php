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
 * Buidling Details Model
 *
 * @package		PortalAdv
 * @subpackage	Advanced Search
 * @since 1.5
 */
class PortalAdvModelBuildingDetails extends JModel
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
	 * Constructor
	 *
	 * @since 1.5
	 */

	function __construct()
	{

		parent::__construct();

		global $mainframe;

	}
	

	function getBuildingDetails()
	{
		$db =& JFactory::getDBO();
		$id = JRequest::getVar('id',0,'get','int');
		$query = "SELECT * FROM `#__buildings` WHERE id = $id";
		$db->setQuery($query);
		$result = $db->loadObject();

		return $result;
		
	}
	
}