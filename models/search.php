<?php
/**
 * @package		PortalAdv
 * @subpackage	Advanced Search
 * @copyright	Copyright (C) 2008 Vail Pro Media. All rights reserved.
 * @license		Commercial
 */

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );
ini_set('memory_limit','100M');
jimport('joomla.application.component.model');

/**
 * Portal Advantage Search Model
 *f * @package		PortalAdv
 */
class PortalAdvModelSearch extends JModel
{
	/**
	 * Search listings array
	 *
	 * @var array
	 */
	var $_listings = null;

	/**
	 * Search total
	 *
	 * @var integer
	 */
	var $_total = null;
	
	/**
	 * Search params
	 *
	 * @var array
	 */
	var $_searchparams = null;
	
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
		
		// Get the pagination request variables
		$this->setState('limit', JRequest::getVar('limit', 10, 'int'));
		$this->setState('limitstart', JRequest::getVar('limitstart', 0, '', 'int'));
		
		$this->setState('sort' , $mainframe->getUserStateFromRequest('com_portaladv.searchparams.sort', 'sort', 'price_d', 'string'));
	
		//$filter_order = $mainframe->getUserStateFromRequest( "$option.viewbanners.filter_order", 'filter_order', 'b.bid' );
		
		// Update the search state and set searchparams for this object
		$this->updateSearchState();
		
		// Retrieve the listings
		$proptypes = $this->getState('prop_type');
		
        
        /*
		if(is_array($proptypes) && in_array('partial',$proptypes)) {
            
			$proptypes = array();
			//$proptypes[] = 'residential';
			//$proptypes[] = 'land';
			$proptypes[] = 'partial';
		} else {
			if (!is_null($proptypes) && $proptypes[0] != '0') {
				$proptypes = array();
				$proptypes[] = 'residential';
				$proptypes[] = 'land';
			} else {
				$proptypes = array();
				$proptypes[] = 'residential';
				//$proptypes[] = 'condo';
				$proptypes[] = 'land';
				$proptypes[] = 'partial';
				//$proptypes[] = 'income';
			}
		}*/ 
        
        //echo "<!-- get vars : "; 
        //print_r($_REQUEST); 
        //echo "-->"; 
        
        ## re-wrote handling of prop_type searching		
        $propSrchQry = array();         
        $propSrchQry['Residential'] = array(); 
        $propSrchQry['Land'] = array(); 
        //$propSrchQry['Rental'] = array(); 
        $propSrchQry['Partial Ownership'] = array(); 
        if(in_array("0",$proptypes))
        {
            $propSrchQry['Residential'] = true; 
            $propSrchQry['Land'] = true; 
            //$propSrchQry['Rental'] = true; 
            $propSrchQry['Partial Ownership'] = true; 
        }
        else
        {
            if(in_array("condo",$proptypes))
            {
                if(!in_array("partial",$proptypes))
                {
                    $propSrchQry['Residential'][] = "Condo";     
                    $propSrchQry['Partial Ownership'][] = "Condo"; 
                }
                else
                {
                    $propSrchQry['Partial Ownership'][] = "Condo"; 
                }
            }
            if(in_array("single family",$proptypes))
            {
                $propSrchQry['Residential'][] = "Single Family"; 
            }
            if(in_array("land",$proptypes))
            {
                $propSrchQry['Land'][] = "Sf/Mf/Acreage"; 
                $propSrchQry['Land'][] = "Farm/Ranch"; 
            }
            if(in_array("duplex",$proptypes))
            {
                $propSrchQry['Residential'][] = "Duplex"; 
                $propSrchQry['Partial Ownership'][] = "Duplex"; 
            }
            if(in_array("townhouse",$proptypes))
            {
                $propSrchQry['Residential'][] = "Townhouse"; 
                $propSrchQry['Partial Ownership'][] = "Townhouse"; 
            }
            if(in_array("partial",$proptypes) && count($propSrchQry['Partial Ownership']) < 1)
            {
                $propSrchQry['Partial Ownership'] = true; 
            }
        }
        
		//log search to database
		//$this->logSearch();
		
		$this->findListings($propSrchQry);

		//Retrieve the listings
		//$this->setAreas($areas);
		
	}
    
    
    /**
     * Method to find listings
     *
     * @access public
     * @return array
     */
    function findListings($srchqry)
    {
        
        ## modified Rich S Wyatt - 10/19/2010
            
        $idxDB = PortalAdvHelperIDX::getDB();
        $searchparams = $this->getSearchParams();
        //print_r($searchparams);
        $combined_results = array();
        ## modified to search only tables referenced in $srchqry 
        $tables = array(); 
        foreach($srchqry as $k=>$v)
        {
            if(count($v) > 0 || $v == true)
            {
                if($k == "Partial Ownership")
                {
                    $k = "partial"; 
                }
                $tables[] = strtolower($k); 
            }
            
        }
        
       // print_r($tables); 
        
        //echo "<!-- TEST HERE"; 
        //print_r($searchparams);
        //echo " --> "; 
        foreach($tables as $table) 
        
        {
            //create an array to hold all the where conditions
            $where = array();        
            
            foreach ($searchparams as $key=>$value) {    
                
                $constantName = 'FIELDNAME_' . strtoupper($table) . '_' . strtoupper($key);
                
                if (defined($constantName)) {
                    ## modified to send $srchqry array
                    if ($fragment = $this->getQueryFragment($key,$srchqry)) {
                        $where[] = $fragment;
                        //echo "fragment: ".$fragment ." \r\n"; 
                    }
                }
            
            }
                
            //build the entire search query
            
            $query = $this->getFullQuery($table,$where);
            //echo "<!-- query ";
            //echo $query . "<BR>";
            //echo "-->"; 
            //get the total number of listings, not jsut those pulled in the result set
            //$this->setTotal($where);
            
            $this->_fullQuery = $query;
            
            
            
            //echo $query . "<br /><br />";
            $idxDB->setQuery($query);
            $results = $idxDB->loadObjectList();
            
            //echo "<!-- results array: "; 
           // print_r($results); 
           // echo "-->"; 
            
            //print_r($results); 
              
            
            if (is_array($results)) {
                $combined_results = array_merge($results,$combined_results);
            }
    
        }
        
        
        //sort listings according to user's selection
        
        $this->sortListings(&$combined_results);
        
        $this->_total    = count($combined_results);
    
        if($this->getState('limit') > 0) {
            $this->_listings    = array_splice($combined_results, $this->getState('limitstart'), $this->getState('limit'));
        } else {
            $this->_listings = $combined_results;
        }

    }
    

	/**
	 * Method to set the searchparams
	 *
	 * @access private
	 */
	function updateSearchState()
	{
		global $mainframe;
		
		//clean request vars of non-numeric characters
		$_REQUEST['price_min'] = preg_replace("/[^0123456789]*/","",$_REQUEST['price_min']);
		$_REQUEST['price_max'] = preg_replace("/[^0123456789]*/","",$_REQUEST['price_max']);
		$_REQUEST['squarefeet_min'] = preg_replace("/[^0123456789]*/","",$_REQUEST['squarefeet_min']);
		$_REQUEST['squarefeet_max'] = preg_replace("/[^0123456789]*/","",$_REQUEST['squarefeet_max']);
		
		//update user state vars and build searchparams array
		$searchparams['search_type'] 			= $mainframe->getUserStateFromRequest('com_portaladv.searchparams.search_type', 'search_type', null, 'string' );
		$searchparams['city'] 					= $mainframe->getUserStateFromRequest('com_portaladv.searchparams.city', 'city', null, 'string' );
		$searchparams['area'] 					= $mainframe->getUserStateFromRequest('com_portaladv.searchparams.area', 'area', array(), 'array' );
		$searchparams['current_days_on_market'] = $mainframe->getUserStateFromRequest('com_portaladv.searchparams.current_days_on_market', 'current_days_on_market', null, 'string' );
		$searchparams['subdivision'] 			= $mainframe->getUserStateFromRequest('com_portaladv.searchparams.subdivision', 'subdivision', null, 'string' );
		$searchparams['zip_code'] 				= $mainframe->getUserStateFromRequest('com_portaladv.searchparams.zip_code', 'zip_code', null, 'string' );
		$searchparams['mls_num'] 				= $mainframe->getUserStateFromRequest('com_portaladv.searchparams.mls_num', 'mls_num', null, 'string');
		$searchparams['prop_type'] 				= $mainframe->getUserStateFromRequest('com_portaladv.searchparams.prop_type', 'prop_type', array(), 'array');
		$searchparams['price_min']				= $mainframe->getUserStateFromRequest('com_portaladv.searchparams.price_min', 'price_min', null, 'int'); 
		$searchparams['price_max']				= $mainframe->getUserStateFromRequest('com_portaladv.searchparams.price_max', 'price_max', null, 'int');
		$searchparams['num_bedrooms']			= $mainframe->getUserStateFromRequest('com_portaladv.searchparams.num_bedrooms', 'num_bedrooms', array(), 'array');
		$searchparams['num_bathrooms']			= $mainframe->getUserStateFromRequest('com_portaladv.searchparams.num_bathrooms', 'num_bathrooms', array(), 'array');
		$searchparams['squarefeet_min']  		= $mainframe->getUserStateFromRequest('com_portaladv.searchparams.squarefeet_min', 'squarefeet_min', null, 'string');
		$searchparams['squarefeet_max']  		= $mainframe->getUserStateFromRequest('com_portaladv.searchparams.squarefeet_max', 'squarefeet_max', null, 'string');
		$searchparams['keyword']  				= $mainframe->getUserStateFromRequest('com_portaladv.searchparams.keyword', 'keyword', null, 'string');
		$searchparams['latitude_min']  			= $mainframe->getUserStateFromRequest('com_portaladv.searchparams.lat_min', 'lat_min', null, 'string');
		$searchparams['latitude_max']  			= $mainframe->getUserStateFromRequest('com_portaladv.searchparams.lat_max', 'lat_max', null, 'string');
		$searchparams['longitude_min']  		= $mainframe->getUserStateFromRequest('com_portaladv.searchparams.lng_min', 'lng_min', null, 'string');
		$searchparams['longitude_max']  		= $mainframe->getUserStateFromRequest('com_portaladv.searchparams.lng_max', 'lng_max', null, 'string');
		if ($_GET['view'] != 'mapsearch') { 
			$searchparams['quick_search']  		= $mainframe->getUserStateFromRequest('com_portaladv.searchparams.quick_search', 'quick_search', '', 'string');
		} else {
			$searchparams['quick_search'] == '';
		}

		//print_r($searchparams);
		
		//set the model state vars

		$this->_searchparams = $searchparams;
		$this->handleQuickSearch();
		$this->setStateVars($this->_searchparams);
					
		//print_r($searchparams);
	}

	/**
	 * Method to set the search areas
	 *
	 * @access	public
	 * @param	array	Active areas
	 * @param	array	Search areas
	 */
	function setStateVars($vars = array())
	{
		foreach($vars as $key=>$value) {
			$this->setState($key,$value);
		}
	}
	
	/**
	 * Getter: search parameters
	 *
	 * @access	private
	 */
	private function getSearchParams()
	{
		return $this->_searchparams;
	}
	
	/**
	 * Getter: listings
	 *
	 * @access	private
	 */
	function getListings()
	{
		return $this->_listings;
	}
	
	/**
	 * Getter: fullQuery
	 *
	 * @access	private
	 */
	function getFullQueryText()
	{
		return $this->_fullQuery;
	}
	
	/**
	 * Getter: search limit
	 *
	 * @access	private
	 */
	function getLimit()
	{
		return $this->getState('limit');
	}
	
	/**
	 * Getter: search limit start
	 *
	 * @access	private
	 */
	function getLimitStart()
	{
		return $this->getState('limitstart');
	}
	
	/**
	 * Method to get query fragment
	 *
	 * @access	public
	 */
     
     ## added by Rich S Wyatt - 10/19/2010
	function getQueryFragment($key,$srchqry)
	{
		$method = 'buildQuery_' . $key;
		//echo $method."<br />";
		$fragment = $this->$method($srchqry);
		return $fragment;
	}
	
	/**
	 * Method to get full query string
	 *
	 * @access	public
	 */
	function getFullQuery($table,$where)
	{	
		$tablename = TABLE_PREFIX . '_' . $table;
		$query = 'SELECT * FROM ' . $tablename;
		$whereString = implode(" AND ",$where);
		if ($whereString) {
			$query .= ' WHERE ' . $whereString;
		}
		//echo $query;
		return $query;
	}
	
	/**
	*Method to handle quick search
	*
	*
	*/
	function handleQuickSearch() {

		if ($this->_searchparams['quick_search'] && $this->_searchparams['quick_search'] != 'City or Zip') {
		
			if (preg_match('/^([a-zA-Z]+)/', $this->_searchparams['quick_search'], $match)) {

			$this->_searchparams['city'] = $match[0];
			
			$this->_searchparams['zip_code'] = null;

			} else if (preg_match('/^([0-9]+)/', $this->_searchparams['quick_search'], $match)) {

			$this->_searchparams['city'] = null;
			
			$this->_searchparams['zip_code'] = $match[0];

			}
		}
	}

	/**
	*Method to log search params to database
	*
	*
	*/
	function logSearch() {
		
		$db =& JFactory::getDBO();
		$searchparams = $this->getSearchParams();
		$query = "INSERT INTO jos_portaladv_stats_search (search_type,keyword,price_min,price_max,prop_type,num_bedrooms,num_bathrooms,squarefeet_min,squarefeet_max,city,area) VALUES(" .
		"'" . $searchparams['search_type'] . "'," .
		"'" . $searchparams['keyword'] . "'," .
		"'" . $searchparams['price_min'] . "'," .
		"'" . $searchparams['price_max'] . "'," .
		"'" . implode(",",$searchparams['prop_type']) . "'," .
		"'" . implode(",",$searchparams['num_bedrooms']) . "'," .
		"'" . implode(",",$searchparams['num_bathrooms']) . "'," .
		"'" . $searchparams['squarefeet_min'] . "'," .
		"'" . $searchparams['squarefeet_max'] . "'," .
		"'" . $searchparams['city'] . "'," .
		"'" . implode(",",$searchparams['area']) . 
		"');";
		
		//$db->setQuery($query);
		//$db->query();
		//mail('daniel@vailpm.com','PortalAdv Search Query',$query);
	}
	
	

	/**
	 * Method to sort listings array
	 *
	 * @access public
	 */
	function sortListings($listings = array())
	{

		switch($this->getState('sort')) {
			case 'default':
				break;
			case 'date':
				usort($listings,'sortByDateListed');
				break;
			case 'price_d':
				usort($listings,'sortByPriceDescending');
				break;
			case 'price_a':
				usort($listings,'sortByPriceAscending');
				break;
			case 'num_bedrooms':
				usort($listings,'sortByNumBedrooms');
				break;
			case 'num_bathrooms':
				usort($listings,'sortByNumBathrooms');
				break;
			case 'type':
				usort($listings,'sortByPropType');
				break;
			default:
				break;
		}
	}
	

	/**
	 * Method to get the total number of matched listings
	 *
	 * @access public
	 * @return integer
	 */
	function getTotalListings()
	{
		return $this->_total;
	}
	
	/**
	 * Method to get a pagination object
	 *
	 * @access public
	 */
	function getPagination()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_pagination))
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotalListings(), $this->getState('limitstart'), $this->getState('limit') );
		}
		return $this->_pagination;
	}
	
	/**
	 * Method to get intro article for search page
	 *
	 * @access public
	 */
	function getIntroArticle()
	{
		$article = 'TEST';
		
		return $article;
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
	
	/**
	 * Method to set query fragment for city
	 *
	 */
	function buildQuery_city()
	{
		$param = $this->getState('city');
		
		if ($param == '' || $param == null) {
			return false;
		} else {
			$fragment = "city = '$param'";
		}
		
		return $fragment; 
	}

	/**
	 * Method to set query fragment for an area
	 *
	 */
	function buildQuery_area()
	{
		$param = $this->getState('area');

		$fragment = "(" . FIELDNAME_RESIDENTIAL_AREA . " = '";

		if ($param[0] == '0' || $param == null) {
			return false;
		} else {
			$fragment .= implode("' OR " . FIELDNAME_RESIDENTIAL_AREA . " = '",$param);
		}
		
		$fragment .= "')";
		
		return $fragment; 
	}
	
	/**
	 * Method to set query fragment for a subdivision
	 *
	 */
	function buildQuery_subdivision()
	{
		$param = $this->getState('subdivision');

		if ($param == '' || $param == null) {
			return false;
		} else {
			$fragment = FIELDNAME_LISTING_SUBDIVISION . " = '$param'";
		}		
		
		return $fragment; 
	}
	
	
	/**
	 * Method to set query fragment for zip codes
	 *
	 */
	function buildQuery_zip_code()
	{
		$param = $this->getState('zip_code');

		if ($param == '' || $param == null) {
			return false;
		} else {
			$fragment = "zip_code = '$param'";
		}
			
		return $fragment; 
	}
	
	/**
	 * Method to set query fragment for price_min
	 *
	 * @access public
	 * @return string
	 */
	function buildQuery_price_min()
	{
		global $mainframe;
		$param = $this->getState('price_min');
		
		if ($param == null) {
			return false;
		} else {
			$fragment = FIELDNAME_RESIDENTIAL_PRICE . " >= ";
			$fragment .= $param;
			return $fragment; 
		}

	}
	
	/**
	 * Method to set query fragment for price range
	 *
	 * @access public
	 * @return string
	 */
	function buildQuery_price_max()
	{
		global $mainframe;
		$param = $this->getState('price_max');

		if ($param == null) {
			return false;
		} else {
			$fragment = FIELDNAME_RESIDENTIAL_PRICE . " <= ";
			$fragment .= $param;
			return $fragment; 
		}
	}

  /**
	 * Method to set query fragment for price range
	 *
	 * @access public
	 * @return string
	 */
	function buildQuery_mls_num()
	{
		global $mainframe;
		$param = $this->getState('mls_num');
		
    if ($param == null) {
			return false;
		} else {
			$fragment = FIELDNAME_LISTING_MLS_NUM . " = '";
			$fragment .= $param . "'";
			return $fragment; 
		}
	}
	
	/**
	 * Method to set query fragment for prop_type
	 *
	 * @access public
	 * @return string
	 */
	function buildQuery_prop_type($srchqry)
	{
		global $mainframe;
		//$param = $this->getState('prop_type');
	    
        ## re-writing this functionality - Rich S Wyatt - 10/19/2010
        
        
        $fragment = "("; 
        
        $zz = 0; 
        foreach($srchqry as $k=>$v)
        {
            if(count($v) > 0 || $v == true)
            {
                if(count($v) > 0 && $v != 1)
                {
                    
                    if($zz != 0)
                    {
                        $fragment .= " OR "; 
                    }
                    $fragment .= " (". FIELDNAME_LISTING_PROP_TYPE . " = '". $k . "' AND"; 
                    $fragment .= "( "; 
                    $z = 0; 
                    foreach($v as $kk=>$vv)
                    {
                        if($z == 0)
                        {
                            $fragment .= FIELDNAME_LISTING_SUB_TYPE . " = '". $vv . "' "; 
                        }
                        else
                        {
                            $fragment .= "OR ". FIELDNAME_LISTING_SUB_TYPE . " = '". $vv . "' "; 
                        }
                        
                        $z++; 
                    }
                    
                    $fragment .= "))"; 
                }
                if($v == 1)
                {
                    // this is without subtypes
                    if($zz != 0)
                    {
                        $fragment .= " OR "; 
                    }
                    $fragment .= " (". FIELDNAME_LISTING_PROP_TYPE . " = '". $k . "' "; 
                    
                    $fragment .= ")"; 
                }   
                $zz++;                  
            }
            
        }
        $fragment .= ")";
        /*
		$fragment = "(" . FIELDNAME_LISTING_SUB_TYPE . " = '";

		if ($param[0] === '0' ) {
			return false;
		} else {
			$fragment .= implode("' OR " . FIELDNAME_LISTING_SUB_TYPE . " = '",$param);
		}
		
		$fragment .= "'";
		
		//CUSTOM BCO INTEGRATION
		if(in_array('land',$param)) {
			$fragment .= " OR " . FIELDNAME_LISTING_SUB_TYPE . " = 'Farm/Ranch'";
			$fragment .= " OR " . FIELDNAME_LISTING_SUB_TYPE . " = 'Sf/Mf/Acreage'";
		}
		if(in_array('partial',$param)) {
			$fragment .= " OR " . FIELDNAME_LISTING_SUB_TYPE . " LIKE '%partial%'";
		}
		//EOF
		
		$fragment .= ")";
        **/
		return $fragment; 
	}
	
	/**
	 * Method to set query fragment for num_bedrooms
	 *
	 * @access public
	 * @return string
	 */
	function buildQuery_num_bedrooms()
	{
		global $mainframe;
		$param = $this->getState('num_bedrooms');
	
		$fragment = "(" . FIELDNAME_RESIDENTIAL_NUM_BEDROOMS . " = ";
		
		if ($param[0] == 0 || $param == null) {
			return false;
		} else {
			$fragment .= implode(" OR " . FIELDNAME_RESIDENTIAL_NUM_BEDROOMS . " = ",str_replace("+","",$param));
		}
		
		//handle 'n+' values
		if (strstr($param[count($param)-1],"+")) {
			$fragment .= " OR " . FIELDNAME_RESIDENTIAL_NUM_BEDROOMS . " > " . str_replace("+","",$param[count($param)-1]);
		}
		
		$fragment .= ")";
		
		return $fragment; 
	}
	
	/**
	 * Method to set query fragment for num_bathrooms
	 *
	 * @access public
	 * @return string
	 */
	function buildQuery_num_bathrooms()
	{
		$param = $this->getState('num_bathrooms');

		$fragment = "(" . FIELDNAME_RESIDENTIAL_NUM_BATHROOMS . " = '";

		if ($param[0] == '0' || $param == null) {
			return false;
		} else {
			$fragment .= implode("' OR " . FIELDNAME_RESIDENTIAL_NUM_BATHROOMS . " = '",$param);
		}
		
		//handle 'n+' values
		if (strstr($param[count($param)-1],"+")) {
			$fragment .= " OR " . FIELDNAME_RESIDENTIAL_NUM_BATHROOMS . " > " . str_replace("+","",$param[count($param)-1]);
		}

		
		$fragment .= "')";
		
		return $fragment; 
	}
	
	/**
	 * Method to set query fragment for squarefeet_min
	 *
	 * @access public
	 * @return string
	 */
	function buildQuery_squarefeet_min()
	{
		$param = $this->getState('squarefeet_min');

		if ($param == 0) {
			return false;
		} else {
			$fragment = FIELDNAME_RESIDENTIAL_SQUAREFEET . " >= ";
			$fragment .= $param;
			return $fragment; 
		}
	}
	
	/**
	 * Method to set query fragment for squarefeet_max
	 *
	 * @access public
	 * @return string
	 */
	function buildQuery_squarefeet_max()
	{
		$param = $this->getState('squarefeet_max');

		if ($param == 0) {
			return false;
		} else {
			$fragment = FIELDNAME_RESIDENTIAL_SQUAREFEET . " <= ";
			$fragment .= $param;
			return $fragment; 
		}
	}
	
	/**
	 * Method to set query fragment for keyword
	 *
	 * @access public
	 * @return string
	 */
	function buildQuery_keyword()
	{
		global $mainframe;
		$param = $this->getState('keyword');

		if ($param == null || $param == 'ex: garage, backyard') {
			return false;
		} else {
			$fragment = "(desc1 LIKE '%$param%' OR desc1 LIKE '$param%' OR desc1 LIKE '%$param')";
			return $fragment; 
		}
	}
	
	/**
	 * Method to set query fragment for keyword
	 *
	 * @access public
	 * @return string
	 */
	function buildQuery_latitude_min()
	{
		global $mainframe;
		$param = $this->getState('latitude_min');

		if ($param == null || $param == '' || $param == 0) {
			return false;
		} else {
			$fragment = "latitude > $param";
			return $fragment; 
		}
	}
	
	/**
	 * Method to set query fragment for keyword
	 *
	 * @access public
	 * @return string
	 */
	function buildQuery_latitude_max()
	{
		global $mainframe;
		$param = $this->getState('latitude_max');

		if ($param == null || $param == '' || $param == 0) {
			return false;
		} else {
			$fragment = "latitude < $param";
			return $fragment; 
		}
	}
	
	/**
	 * Method to set query fragment for keyword
	 *
	 * @access public
	 * @return string
	 */
	function buildQuery_longitude_min()
	{
		global $mainframe;
		$param = $this->getState('longitude_min');

		if ($param == null || $param == '' || $param == 0) {
			return false;
		} else {
			$fragment = "longitude > $param";
			return $fragment; 
		}
	}
	
	/**
	 * Method to set query fragment for keyword
	 *
	 * @access public
	 * @return string
	 */
	function buildQuery_longitude_max()
	{
		global $mainframe;
		$param = $this->getState('longitude_max');

		if ($param == null || $param == '' || $param == 0) {
			return false;
		} else {
			$fragment = "longitude < $param";
			return $fragment; 
		}
	}
	
	/**
	 * Method to set query fragment for days_on_market
	 *
	 * @access public
	 * @return string
	 */
	function buildQuery_current_days_on_market()
	{
		global $mainframe;
		$param = $this->getState('current_days_on_market');
		if ($param == null || $param == '' || $param == 0) {
			return false;
		} else {
			$fragment = FIELDNAME_LISTING_CURRENT_DAYS_ON_MARKET . " < $param";
			return $fragment; 
		}
	}
}
