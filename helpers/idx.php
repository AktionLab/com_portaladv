<?php
/**
 * @package		PortalAdv
 * @copyright	Copyright (C) 2008 Vail Pro Media. All rights reserved.
 * @license		Commercial
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * PortalAdv Component IDX Helper
 */
class PortalAdvHelperIDX
{
	/**
	 *
	 * Constructor
	 *
	 */
	function PortalAdvHelperIDX() {
		
	}
	
	function getAreas()
	{
		$idxDB = PortalAdvHelperIDX::getDB();
		
		/*
		$query = "SELECT code, description FROM " . TABLE_ABBREV_CODES_RESIDENTIAL . " WHERE field = '" . AREA_FIELD_NAME . "' ORDER BY description ASC";
		$idxDB->setQuery($query);
		$areas = $idxDB->loadObjectList();
		*/
		
		$query = "SELECT " . FIELDNAME_RESIDENTIAL_AREA . " FROM " . LISTINGS_TABLE_RESIDENTIAL . " GROUP BY " . FIELDNAME_RESIDENTIAL_AREA;
		//echo $query;
		$idxDB->setQuery($query);
		$areas1 = $idxDB->loadResultArray();
		
		$query = "SELECT " . FIELDNAME_LAND_AREA . " FROM " . LISTINGS_TABLE_LAND . " GROUP BY " . FIELDNAME_LAND_AREA;
		$idxDB->setQuery($query);
		$areas2 = $idxDB->loadResultArray();
		
		/*
		
		$query = "SELECT area FROM " . LISTINGS_TABLE_LAND . " GROUP BY area";
		$idxDB->setQuery($query);
		$areas3 = $idxDB->loadResultArray();
		
		$query = "SELECT area FROM " . LISTINGS_TABLE_INCOME . " GROUP BY area";
		$idxDB->setQuery($query);
		$areas4 = $idxDB->loadResultArray();
		
		*/
		
		$combined_results = array_merge($areas1,$areas2);
		$combined_results = array_unique($combined_results);

		//remove preferred areas from list
		$preferred_areas = PortalAdvHelperIDX::getPreferredAreas();
		$filtered_combined_results = array();
		
		foreach($combined_results as $key=>$value) {
			if(!in_array($value,$preferred_areas)) {
				$filtered_combined_results[] = $value;
			} 
		}
		
		asort(&$filtered_combined_results);

		return $filtered_combined_results;

	}
	
	/**
	 *
	 * Returns an array of preferred areas/locations
	 * to be listed above all others and always be visible in the filter.
	 *
	 * @since	1.0
	 * @return	array	Array or preferred location strings
	 *
	 */
	function getPreferredAreas() {
		if(defined('PREFERRED_LOCATION1')) {
			$preferred_areas = array();
			$preferred_areas[] = PREFERRED_LOCATION1;
		}
		if(defined('PREFERRED_LOCATION2')) { $preferred_areas[] = PREFERRED_LOCATION2; }
		if(defined('PREFERRED_LOCATION3')) { $preferred_areas[] = PREFERRED_LOCATION3; }
		if(defined('PREFERRED_LOCATION4')) { $preferred_areas[] = PREFERRED_LOCATION4; }
		if(defined('PREFERRED_LOCATION5')) { $preferred_areas[] = PREFERRED_LOCATION5; }
		if(defined('PREFERRED_LOCATION6')) { $preferred_areas[] = PREFERRED_LOCATION6; }
		if(defined('PREFERRED_LOCATION7')) { $preferred_areas[] = PREFERRED_LOCATION7; }
		if(defined('PREFERRED_LOCATION8')) { $preferred_areas[] = PREFERRED_LOCATION8; }
		if(defined('PREFERRED_LOCATION9')) { $preferred_areas[] = PREFERRED_LOCATION9; }
		if(defined('PREFERRED_LOCATION10')) { $preferred_areas[] = PREFERRED_LOCATION10; }
		
		return $preferred_areas;
	}
	
	function getCities()
	{
		$idxDB = PortalAdvHelperIDX::getDB();
		
		$query = "SELECT " . FIELDNAME_RESIDENTIAL_CITY . " FROM " . LISTINGS_TABLE_RESIDENTIAL . " GROUP BY city";
		$idxDB->setQuery($query);
		$values1 = $idxDB->loadResultArray();
		/*
		$query = "SELECT city FROM " . LISTINGS_TABLE_CONDO . " GROUP BY city";
		$idxDB->setQuery($query);
		$values2 = $idxDB->loadResultArray();
		*/
		$query = "SELECT " . FIELDNAME_LAND_CITY . " FROM " . LISTINGS_TABLE_LAND . " GROUP BY city";
		$idxDB->setQuery($query);
		$values3 = $idxDB->loadResultArray();
		/*
		$query = "SELECT city FROM " . LISTINGS_TABLE_INCOME . " GROUP BY city";
		$idxDB->setQuery($query);
		$values4 = $idxDB->loadResultArray();
		*/
		$combined_results = array_merge($values1,$values2,$values3,$values4);
		$combined_results = array_unique($combined_results);
		sort($combined_results);

		return $combined_results;
	}

	function orderbySecondary($orderby)
	{
		switch ($orderby)
		{
			case 'date' :
				$orderby = 'a.created';
				break;

			case 'rdate' :
				$orderby = 'a.created DESC';
				break;

			case 'alpha' :
				$orderby = 'a.title';
				break;

			case 'ralpha' :
				$orderby = 'a.title DESC';
				break;

			case 'hits' :
				$orderby = 'a.hits DESC';
				break;

			case 'rhits' :
				$orderby = 'a.hits';
				break;

			case 'order' :
				$orderby = 'a.ordering';
				break;

			case 'author' :
				$orderby = 'a.created_by_alias, u.name';
				break;

			case 'rauthor' :
				$orderby = 'a.created_by_alias DESC, u.name DESC';
				break;

			case 'front' :
				$orderby = 'f.ordering';
				break;

			default :
				$orderby = 'a.ordering';
				break;
		}

		return $orderby;
	}

	function buildVotingQuery($params=null)
	{
		if (!$params) {
			$params = &JComponentHelper::getParams( 'com_content' );
		}
		$voting = $params->get('show_vote');

		if ($voting) {
			// calculate voting count
			$select = ' , ROUND( v.rating_sum / v.rating_count ) AS rating, v.rating_count';
			$join = ' LEFT JOIN #__content_rating AS v ON a.id = v.content_id';
		} else {
			$select = '';
			$join = '';
		}

		$results = array ('select' => $select, 'join' => $join);

		return $results;
	}
	
	function getDB() {

		//Create db object & connect to the Portal Advantage IDX listings database
		$options = array();
		$options['host'] = PA_HOST;
		$options['user'] = PA_USER;
		$options['password'] = PA_PASS;
		$options['database'] = PA_DB;
    
        
		$idxDB = new JDatabaseMySQL($options);

		return $idxDB;
	}
}
