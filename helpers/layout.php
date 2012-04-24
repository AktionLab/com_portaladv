<?php
/**
 * @package		PortalAdv
 * @copyright	Copyright (C) 2008 Vail Pro Media. All rights reserved.
 * @license		Commercial
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * PortalAdv Component HTML Layout Helper
 */
class PortalAdvHelperLayout
{
	
	function displayAreas($areas)
	{
		global $mainframe;
		
		$counter = 1;
		$html = '';
		
		//display preferred areas
		$preferred_areas = PortalAdvHelperIDX::getPreferredAreas();
		if (count($preferred_areas) > 0) {
			for($i=0;$i<count($preferred_areas);$i++) {
				$area = $preferred_areas[$i];
				if ($area) {
					$html .= '<input id="' . $area . '" type="checkbox" class="checkbox" name="area[]" value="' . $area  . '" onclick="checkInput(this);" ' . PortalAdvHelperLayout::checkState('area','string',$area) . '/><label class="area_label" for="' . $area . '"> ' . ucwords(str_replace("/"," / ",strtolower($area))) . '</label><br />';
				}
			}

		}
		
		//pull out areas that the user has selected
		for($i=0;$i<count($areas);$i++) {
			$area = $areas[$i];
			if ($areas[$i] && is_array($mainframe->getUserState('com_portaladv.searchparams.area')) && in_array($area,$mainframe->getUserState('com_portaladv.searchparams.area'))) {
				$html .= '<input id="' . $area . '" type="checkbox" class="checkbox" name="area[]" value="' . $area  . '" onclick="checkInput(this);" ' . PortalAdvHelperLayout::checkState('area','string',$area) . '/><label class="area_label" for="' . $area . '"> ' . ucwords(str_replace("/"," / ",strtolower($area))) . '</label><br />';
				unset($areas[$i]);
			}
		}
		
		//show the rest of the areas
		if (count($areas) > 0) {
			$html .= '<div style="padding:4px 0px 6px 0px;"><span class="small pointer" id=\"toggle_locations\" style="color:#ffffff;" onclick="showAreas(\'seeAreas\');">&raquo;show/hide more locations</span></div>';
			$html .= '<div id="seeAreas" class="hidden" style="margin-bottom:6px;">';
			$html .= '<div align="center" style="margin-left:-10px;"><input type="submit" class="button" value=" ' . FILTER_LABEL_UPDATE_LOCATIONS . ' " /></div>';
			for($i=0;$i<count($areas);$i++) {
				$area = $areas[$i];
				if ($area) {
					$html .= '<input id="' . $area . '" type="checkbox" class="checkbox" name="area[]" value="' . $area  . '" onclick="checkInput(this);" ' . PortalAdvHelperLayout::checkState('area','string',$area) . '/><label class="area_label" for="' . $area . '"> ' . ucwords(str_replace("/"," / ",strtolower($area))) . '</label><br />';
				}
			}
			$html .= '</div>';
			$html .= '<div align="center" style="margin-left:-10px;"><input type="submit" class="button" value=" ' . FILTER_LABEL_UPDATE_LOCATIONS . ' " /></div>';
		}

		
		
		return $html;
	}
	
	function displayCitySelectList($values, $width=false, $selected=false)
	{
		global $mainframe;

		$html = '';
		
		//show the rest of the areas
		if (count($values) > 0) {
			$html .= "\n" . '<select name="city" ';
			if ($width) {
				$html .= 'style="width:' . $width . 'px"';
			}
			$html .= ' onchange="PortalAdvMap.changeCity(this.value + \' ,CO\');" >';
			for($i=0;$i<count($values);$i++) {
				$value = $values[$i];
				if ($value) {
					$html .= "\n" . '<option value="' . $value . '" ';
					if ($selected && $selected == $value) {
						$html .= 'selected';
					}
					$html .= '>' . $value . '</option>';
				}
			}
			$html .= "\n" . '</select>';
		}
		
		return $html;
	}
	
	function checkState($field,$format = 'string',$value = null,$checkIfEmpty = false) {
		global $mainframe;
		$stateVarKey = 'com_portaladv.searchparams.' . $field;
		$stateVar = $mainframe->getUserState($stateVarKey);
		if (is_array($stateVar)) {
			if (in_array($value,$stateVar)) {
				return 'checked';
			}
		}
		if (!is_array($stateVar)) {
			if ($format == 'number' && number_format($stateVar) != 0) {
				$stateVar = number_format($stateVar);
				return $stateVar;
			} else if($format == 'string') {
        return $stateVar;
      }
		}
		if ($checkIfEmpty == true && $stateVar == null) {
			return 'checked';
		}
	}
	
	function checkSelectState($field,$value = null,$checkIfEmpty = false) {
		global $mainframe;
		$stateVarKey = 'com_portaladv.searchparams.' . $field;
		$stateVar = $mainframe->getUserState($stateVarKey);
		if (is_array($stateVar)) {
			if (in_array($value,$stateVar)) {
				return 'selected="selected"';
			}
		}
		if (!is_array($stateVar) && $stateVar == $value) {
				return 'selected="selected"';
		}
		if ($checkIfEmpty == true && $stateVar == null) {
			return 'selected="selected"';
		}
	}
		
	function displayPropTypes($name, $columns = 2)
	{
		$counter = 1;
		$html = '';
		
		$proptype1->dbname = 'RESIDENTIAL';
		$proptype1->description = 'Residential';
		$proptype2->dbname = 'CONDOMINIUM';
		$proptype2->description = 'Condo';
		$proptype3->dbname = 'LAND';
		$proptype3->description = 'Land';
		$proptype4->dbname = 'INCOME';
		$proptype4->description = 'Income';
		
		$proptypes = array($proptype1,$proptype2,$proptype3,$proptype4);

		foreach ($proptypes as $proptype) {
			if ($counter == 1) {
				$html .= "<tr>";
			}
			$html .= "<td colspan=\"$columns\"><input type=\"checkbox\" name=\"" . $name . "[]\" value=\"" . $proptype->description . "\" /> " . $proptype->description . '</td>';
			if ($counter == $columns) {
				$html .= "</tr>";
				$counter = 1;
			} else {
				$counter++;
			}
		}
		
		return $html;
	}
	
	function displaySearchPrices($name, $width, $min = 0, $max = 1000000000, $lastValue = false, $onchange = false) {
		$priceStep = $min;
		$html = '<select name="' . $name . '" style="width:' . $width . 'px;" ';
		if ($onchange) {
			$html .= 'onchange="getListings();"';
		}
		$html .= '>';
		setlocale(LC_MONETARY, 'en_US');
		$html .= "\n<option value=\"0\" >- any -</option>\n";
		while ($priceStep <= $max) {
			$html .= "\n<option value=\"$priceStep\" ";
			$html .= PortalAdvHelperLayout::checkSelectState($name,$priceStep);
			$html .= ">$" . number_format($priceStep) . "</option>\n";
			$increment = PortalAdvHelperLayout::getPriceIncrement($priceStep);
			$priceStep += $increment;
		}
		if ($lastValue) {
			$html .= "\n<option value=\"0\" >- $lastValue -</option>\n";
		}
		$html .= '</select>';
		
		return $html;
	}
	
	function getPriceIncrement($priceStep) {
		if ($priceStep < 200000) {
			$increment = 10000;
		} else if ($priceStep >= 200000 && $priceStep < 500000) {
			$increment = 25000;
		} else if ($priceStep >= 500000 && $priceStep < 1000000) {
			$increment = 50000;
		} else if ($priceStep >= 1000000 && $priceStep < 2000000) {
			$increment = 100000;
		} else if ($priceStep >= 2000000 && $priceStep < 5000000) {
			$increment = 500000;
		} else if ($priceStep >= 5000000) {
			$increment = 1000000;
		}
		
		return $increment;
	}
	
	function displayNumericCheckboxes($name, $num = 5) {
		$html = '';
		$html .= "<input name=\"$name" . "[]\" type=\"checkbox\" value=\"\" /> Any";
		for ($i=1;$i<$num;$i++) {
			$html .= "<input name=\"$name" . "[]\" type=\"checkbox\" value=\"$i\" /> $i";
		}
		$html .= "<input name=\"$name" . "[]\" type=\"checkbox\" value=\"$i+\" /> $num+";
		return $html;
	}
	
	function displayIncrementalList($name, $start, $finish, $increment, $any = false, $suffix = false) {
		$html = '';
		$html .= "<select name=\"$name\" >";
		$html .= "\n<option value=\"\" >- select -</option>\n";
		if ($any) {
			
		}
		for ($i=$start;$i<=$finish;) {
			$html .= "\n<option value=\"$i\" >$i</option>\n";
			$i += $increment;
		}
		$html .= '</select>';
		return $html;
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
		//set constants
		require_once (JPATH_COMPONENT.DS.'constants.php');
		
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
