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
 * HTML View class for the Portal Advantage Search Results
 *
 * @static
 * @package		Joomla
 * @subpackage	Weblinks
 * @since 1.0
 *
 */
class PortalAdvViewSearch extends JView
{
	function display($tpl = null)
	{
		global $mainframe;
		
		//include javascripts
		$document =& Jfactory::getDocument();
		$js = "components/com_portaladv/javascript/portaladv.js";
		$js2 = "includes/js/overlib_mini.js";
		$js3 = "components/com_portaladv/javascript/flashobject.js";
		$document->addScript(JURI::base() . $js);
		$document->addScript(JURI::base() . $js2);
		$document->addScript(JURI::base() . $js3);
		
		//include portaladv styles
		$document->addStyleSheet("components/com_portaladv/portaladv.css");
		
		// Initialize variables
		$listings			=& $this->get('Listings');
		$total 				=& $this->get('TotalListings');
		$limit 				=& $this->get('Limit');
		$limitstart 		=& $this->get('LimitStart');
		$pagination			=& $this->get('Pagination');
		$intro_article		=& $this->get('IntroArticle');
				
		// Get the parameters of the active menu item
		$params	= &$mainframe->getParams();
		
		$this->assignRef('params',$params);
		
		//build lists of search criteria
		$lists = $this->_buildLists();

		$results = $this->_buildResults();
		
		$this->assignRef('lists', $lists);
		$this->assignRef('total', $total);
		$this->assignRef('listings', $listings);
		$this->assignRef('limit',$limit);
		$this->assignRef('limitstart',$limitstart);
		$this->assignRef('pagination',$pagination);
		$this->assignRef('intro_article',$intro_article);
		
		parent::display($tpl);
	}
	
	function _buildResults()
	{
	
	
	
	}
	
	
	
	function _buildLists()
	{
		$idxDB = PortalAdvHelperIDX::getAreas();

		$javascript = "onchange=\"changeDynaList( 'catid', sectioncategories, document.adminForm.sectionid.options[document.adminForm.sectionid.selectedIndex].value, 0, 0);\"";
		
		$lists = array();
		$lists['area'] = PortalAdvHelperIDX::getAreas();
		
		/*
		$query = 'SELECT s.id, s.title' .
				' FROM #__sections AS s' .
				' ORDER BY s.ordering';
		$db->setQuery($query);

		$sections[] = JHTML::_('select.option', '-1', '- '.JText::_('Select Section').' -', 'id', 'title');
		$sections[] = JHTML::_('select.option', '0', JText::_('Uncategorized'), 'id', 'title');
		$sections = array_merge($sections, $db->loadObjectList());
		$lists['sectionid'] = JHTML::_('select.genericlist',  $sections, 'sectionid', 'class="inputbox" size="1" '.$javascript, 'id', 'title', intval($article->sectionid));

		foreach ($sections as $section)
		{
			$section_list[] = (int) $section->id;
			// get the type name - which is a special category
			if ($article->sectionid) {
				if ($section->id == $article->sectionid) {
					$contentSection = $section->title;
				}
			} else {
				if ($section->id == $article->sectionid) {
					$contentSection = $section->title;
				}
			}
		}

		$sectioncategories = array ();
		$sectioncategories[-1] = array ();
		$sectioncategories[-1][] = JHTML::_('select.option', '-1', JText::_( 'Select Category' ), 'id', 'title');
		$section_list = implode('\', \'', $section_list);

		$query = 'SELECT id, title, section' .
				' FROM #__categories' .
				' WHERE section IN ( \''.$section_list.'\' )' .
				' ORDER BY ordering';
		$db->setQuery($query);
		$cat_list = $db->loadObjectList();

		// Uncategorized category mapped to uncategorized section
		$uncat = new stdClass();
		$uncat->id = 0;
		$uncat->title = JText::_('Uncategorized');
		$uncat->section = 0;
		$cat_list[] = $uncat;
		foreach ($sections as $section)
		{
			$sectioncategories[$section->id] = array ();
			$rows2 = array ();
			foreach ($cat_list as $cat)
			{
				if ($cat->section == $section->id) {
					$rows2[] = $cat;
				}
			}
			foreach ($rows2 as $row2) {
				$sectioncategories[$section->id][] = JHTML::_('select.option', $row2->id, $row2->title, 'id', 'title');
			}
		}

		$categories = array();
		foreach ($cat_list as $cat) {
			if($cat->section == $article->sectionid)
				$categories[] = $cat;
		}

		$categories[] = JHTML::_('select.option', '-1', JText::_( 'Select Category' ), 'id', 'title');
		$lists['sectioncategories'] = $sectioncategories;
		$lists['catid'] = JHTML::_('select.genericlist',  $categories, 'catid', 'class="inputbox" size="1"', 'id', 'title', intval($article->catid));

		// Select List: Category Ordering
		$query = 'SELECT ordering AS value, title AS text FROM #__content WHERE catid = '.(int) $article->catid.' ORDER BY ordering';
		$lists['ordering'] = JHTML::_('list.specificordering', $article, $article->id, $query, 1);

		// Radio Buttons: Should the article be published
		$lists['state'] = JHTML::_('select.booleanlist', 'state', '', $article->state);

		// Radio Buttons: Should the article be added to the frontpage
		if($article->id) {
			$query = 'SELECT content_id FROM #__content_frontpage WHERE content_id = '. (int) $article->id;
			$db->setQuery($query);
			$article->frontpage = $db->loadResult();
		} else {
			$article->frontpage = 0;
		}

		$lists['frontpage'] = JHTML::_('select.booleanlist', 'frontpage', '', (boolean) $article->frontpage);

		// Select List: Group Access
		$lists['access'] = JHTML::_('list.accesslevel', $article);

		*/

		return $lists;
		
	}

}
