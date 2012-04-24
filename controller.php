<?php
/**
 * @package		PortalAdv
 * @copyright	Copyright (C) 2008 Vail Pro Media. All rights reserved.
 * @license		Commercial
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.application.component.controller');

/**
 * The Portal Advantage Controller
 *
 * @package		PortalAdv
 */
class PortalAdvController extends JController
{
	/**
	 * Method to show the search view
	 *
	 * @access	public
	 * @since	1.5
	 */
	function display() {
		
		// If the task was not set, use start
		//$uri =& JURI::getInstance();
		//if (!$uri->_vars['task']) {
		//	$redirect = $uri->_uri . '&task=' . $uri->_vars['view']; 
		//	$this->setRedirect($redirect);
		//}
		
		parent::display();
		
	}
	
	function search() {	
		
		// set Itemid id for links
		//$menu = &JSite::getMenu();
		//$items	= $menu->getItems('link', 'index.php?option=com_portaladv&view=advancedsearch');

		//if(isset($items[0])) {
			//$post['Itemid'] = $items[0]->id;
		//}
		
		//unset($post['task']);
		//unset($post['submit']);

		//$uri = JURI::getInstance();
		//$uri->setQuery($post);
		//$uri->setVar('option', 'com_portaladv');
		//$uri->setVar('view', 'searchresults');
		
		// Create the view
		$view = & $this->getView('search', 'html');

		// Get/Create the model
		if ($_GET['task'] == 'search') {
			$model = &$this->getModel('search');
		}
		//Record the search
		//-- records the search criteria and user info to the database
		//$model->recordSearch();

		// Push the model into the view (as default)
		$view->setModel($model, true);

		// Set the layout
		$view->setLayout('default');

		// Display the view
		$view->display();
		
	}
	
	function mapsearch() {	
		
		// Set default task
		if (!JRequest::getVar('task')) {
			$_GET['task'] = 'mapsearch';
		}
		// Get the view
		$view = & $this->getView('mapsearch', 'html');

		// Get the model
		$model = &$this->getModel('search');

		//Record the search 
		//-- records the search criteria and user info to the database
		//$model->recordSearch();

		// Push the model into the view (as default)
		$view->setModel($model, true);

		// Set the layout
		$view->setLayout('default');

		// Display the view
		$view->display();
		
	}
	
	function printlisting() {
	
		// Create the view
		$view =& $this->getView('details', 'html');

		// Get/Create the model
		$model =& $this->getModel('details');

		// Push the model into the view (as default)
		$view->setModel($model, true);

		// Set the layout
		$view->setLayout('print');
		
		// Display the view
		$view->display();
		
	}
	
	function interactivemap() {
		
		// Create the view
		$view =& $this->getView('interactivemap', 'html');
		
		// Get/Create the model
		$model =& $this->getModel('interactivemap');

		// Push the model into the view (as default)
		$view->setModel($model, true);

		// Set the layout
		$view->setLayout('default');

		// Display the view
		$view->display();
	}
	
	function buildingdetails() {
		
		// Create the view
		$view =& $this->getView('buildingdetails', 'html');
		
		// Get/Create the model
		$model =& $this->getModel('buildingdetails');

		// Push the model into the view (as default)
		$view->setModel($model, true);

		// Set the layout
		$view->setLayout('default');

		// Display the view
		$view->display();
	}
	
	function contact() {
		
		// Create the view
		$view =& $this->getView('contact', 'html');
		
		// Get/Create the model
		$model =& $this->getModel('contact');

		// Push the model into the view (as default)
		$view->setModel($model, true);

		// Set the layout
		$view->setLayout('default');

		// Display the view
		$view->display();
	}
	
	function getrecentsales() {
		
		// Create the view
		$view =& $this->getView('contact', 'html');
		
		// Get/Create the model
		$model =& $this->getModel('contact');

		// Push the model into the view (as default)
		$view->setModel($model, true);

		// Set the layout
		$view->setLayout('default');

		// Display the view
		$view->display();
	}
	
	function ajax() {
		// Get/Create the model
		$model =& $this->getModel('search');
		
		$listings = $model->getListings();
		//$listings = $model->getFullQueryText();
		$return = $listings;
		$return = "var listings = new Array;";
		//prepare as javascript array
		
		foreach($listings as $listing) {
			$return .= "var listing = new Array;\n";
			$return .= "listing['latitude'] = " . $listing->latitude . "\n";
			$return .= "listing['longitude'] = " . $listing->longitude . "\n";
			$return .= "listing['listing_num'] = " . $listing->listing_num . "\n";
			$return .= "listing['address'] = '" . str_replace("'","&apos;",ucwords(strtolower($listing->address_num . ' ' . $listing->street_name . ' ' . $listing->street_type))) . "'\n";
			$return .= "listing['price'] = '$" . number_format($listing->price) . "'\n";
			$return .= "listing['city'] = '" . $listing->city . "'\n";
			$return .= "listing['state'] = 'CO'\n";
			$return .= "listing['zip'] = '" . $listing->zip_code . "'\n";
			$return .= "listing['bedrooms_total'] = '" . $listing->bedrooms_total . "'\n";
			$return .= "listing['baths_total'] = '" . $listing->baths_total . "'\n";
			$return .= "listing['total_square_feet'] = '" . $listing->total_square_feet . "'\n";
			$return .= "listing['office_name'] = '" . str_replace("'","&apos;",ucwords(strtolower($listing->office_name))) . "'\n";
			$return .= "listings.push(listing);\n";
		}
		
		//echo 'alert("test");';
		echo $return;
	}

}
