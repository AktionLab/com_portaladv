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
 * Search Component Results Model
 *
 * @package		PortalAdv
 * @subpackage	Advanced Search
 * @since 1.5
 */
class SearchModelResults extends JModel
{
	/**
	 * Sezrch data array
	 *
	 * @var array
	 */
	var $_data = null;

	/**
	 * Search total
	 *
	 * @var integer
	 */
	var $_total = null;

	/**
	 * Search areas
	 *
	 * @var integer
	 */
	var $_areas = null;

	/**
	 * Pagination object
	 *
	 * @var object
	 */
	var $_pagination = null;

	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct()
	{
		parent::__construct();

		global $mainframe;

		//Get configuration
		$config = JFactory::getConfig();

		// Get the pagination request variables
		$this->setState('limit', $mainframe->getUserStateFromRequest('com_search.limit', 'limit', $config->getValue('config.list_limit'), 'int'));
		$this->setState('limitstart', JRequest::getVar('limitstart', 0, '', 'int'));

		// Set the search parameters
		$keyword		= urldecode(JRequest::getString('searchword'));
		$match			= JRequest::getWord('searchphrase', 'all');
		$ordering		= JRequest::getWord('ordering', 'newest');
		$this->setSearch($keyword, $match, $ordering);

		//Set the search areas
		$areas = JRequest::getVar('areas');
		$this->setAreas($areas);
	}

	/**
	 * Method to set the search parameters
	 *
	 * @access	public
	 * @param string search string
 	 * @param string mathcing option, exact|any|all
 	 * @param string ordering option, newest|oldest|popular|alpha|category
	 */
	function setSearch($keyword, $match = 'all', $ordering = 'newest')
	{
		if(isset($keyword)) {
			$this->setState('keyword', $keyword);
		}

		if(isset($match)) {
			$this->setState('match', $match);
		}

		if(isset($ordering)) {
			$this->setState('ordering', $ordering);
		}
	}

	/**
	 * Method to set the search areas
	 *
	 * @access	public
	 * @param	array	Active areas
	 * @param	array	Search areas
	 */
	function setAreas($active = array(), $search = array())
	{
		$this->_areas['active'] = $active;
		$this->_areas['search'] = $search;
	}

	/**
	 * Method to get weblink item data for the category
	 *
	 * @access public
	 * @return array
	 */
	function getData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$areas = $this->getAreas();

			JPluginHelper::importPlugin( 'search');
			$dispatcher =& JDispatcher::getInstance();
			$results = $dispatcher->trigger( 'onSearch', array(
				$this->getState('keyword'),
				$this->getState('match'),
				$this->getState('ordering'),
				$areas['active']) );

			$rows = array();
			for ($i = 0, $n = count( $results); $i < $n; $i++) {
				$rows = array_merge( (array)$rows, (array)$results[$i] );
			}

			$this->_total	= count($rows);
			if($this->getState('limit') > 0) {
				$this->_data    = array_splice($rows, $this->getState('limitstart'), $this->getState('limit'));
			} else {
				$this->_data = $rows;
			}
		}

		return $this->_data;
	}

	/**
	 * Method to get the total number of weblink items for the category
	 *
	 * @access public
	 * @return integer
	 */
	function getTotal()
	{
		return $this->_total;
	}

	/**
	 * Method to get a pagination object of the weblink items for the category
	 *
	 * @access public
	 * @return integer
	 */
	function getPagination()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_pagination))
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		}

		return $this->_pagination;
	}

	/**
	 * Method to get the search areas
	 *
	 * @since 1.5
	 */
	function getAreas()
	{
		global $mainframe;

		// Load the Category data
		if (empty($this->_areas['search']))
		{
			$areas = array();

			$dispatcher =& JDispatcher::getInstance();
			$searchareas = $dispatcher->trigger( 'onSearchAreas' );

			foreach ($searchareas as $area) {
				$areas = array_merge( $areas, $area );
			}

			$this->_areas['search'] = $areas;
		}

		return $this->_areas;
	}
}