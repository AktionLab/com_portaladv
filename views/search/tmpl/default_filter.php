<?php defined('_JEXEC') or die('Restricted access'); ?>
<? $user =& JFactory::getUser(); ?>
<script type="text/javascript">
function save_search() {
	var url = window.location.search.substring(1);
	var xmlHttp;
	try {
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	} catch (e) {
		// Internet Explorer
		try {
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				alert("Your browser does not support AJAX!");
				return false;
			}
		}
	}
			
	xmlHttp.onreadystatechange=function() {
		if(xmlHttp.readyState==1 || xmlHttp.readyState==2 || xmlHttp.readyState==3){
		}
		if(xmlHttp.readyState==4) {
			alert(xmlHttp.responseText);
			hide_overlib();
		}
	}
	
	var script = "components/com_portaladv/includes/save_search.php?" + url + "&user_id=" + "<? echo $user->id; ?>" + "&search_name=" + document.getElementById('saved_search_name').value;
	
	xmlHttp.open("get",script,true);
	xmlHttp.send(null);
}

function focus_on_search_name() {
	document.getElementById('saved_search_name').focus();
}
</script>
<?
if ($_GET['task'] =='search') {
if ($user->id)
{

	$save_search = "<input type=\"button\" class=\"portaladv_button\" style=\"width:180px;\" onmouseover=\"this.className='portaladv_button_hover';\" onmouseout=\"this.className='portaladv_button';\" onclick=\"overlib('<div id=\'overlib_save_search\' style=\'width:250px;text-align:center;background:#ffffff;border:2px solid #888888;padding:20px;\'  ><form name=\'save_search_form\' >Enter a name for this search<br /><input type=\'text\' name=\'saved_search_name\' id=\'saved_search_name\' style=\'width:100%;\' /><br /><br /><input type=\'submit\' value=\'Save Search\' onclick=\'save_search();return false;\' /><input type=\'button\' value=\'Cancel\' onclick=\'hide_overlib();\' /></form></div>', OFFSETX, 20, OFFSETY, -50, STICKY, 1); window.setTimeout(focus_on_search_name,300);\" value=\"" . BUTTON_SAVE_SEARCH . "\"></input>";
		 					
}
else
{
		 				
	$save_search = "<input type=\"button\" class=\"portaladv_button\" style=\"width:180px;\" id=\"favorite_link\" onmouseover=\"this.className='portaladv_button_hover';\" onmouseout=\"this.className='portaladv_button';\" onclick=\"window.open('index.php?option=com_comprofiler&task=registers','_self');\" value=\"" . BUTTON_SAVE_SEARCH . "\" ></input>";
		 					
}	
		 				
echo $save_search;
}
?>
	<div class="filter_container">
	
	<? echo "<h2 class=\"search_filter_title\">" . SEARCH_FILTER_TITLE . "</h2>"; ?>
	<div class="filter_container_border_right">
	<div class="filter_container_border_bottom">
	<div class="filter_container_border_top">
  <div>
    <h4><? echo FILTER_HEADER_MLS_NUM; ?></h4>
		<div class="filter_options" style="padding-right: 10px;">
      <input id="mls_num" name="mls_num" maxlength="16" type="text" style="width:100%;" value="<? echo PortalAdvHelperLayout::checkState('mls_num','string'); ?>" />
    </div>
  </div>
	<? if ($_GET['subdivision']) { ?>
	<div id="filter_location">
		<h4 style="margin-top:0px;"><? echo FILTER_HEADER_SUBDIVISION; ?></h4>
		<div class="filter_options">
			<div class="filter_checkbox">
				<input type="hidden" name="subdivision" value="" style="display:none;"/>
				<input class="checkbox" id="subdivision" name="subdivision" type="checkbox" value="<?=$_GET['subdivision']?>" checked />
				<label for="subdivision" class="area_label" ><?=ucwords(strtolower($_GET['subdivision']))?></label>
			</div>
		</div>
	</div>
	<? } else { ?>
	<input type="hidden" name="subdivision" value="" />
	<? } ?>
	<div id="filter_location">
		<h4 style="margin-top:0px;"><? echo FILTER_HEADER_LOCATION; ?></h4>
		<div class="filter_options">
			<div class="filter_checkbox">
				<input id="area_0" name="area[]" type="checkbox" class="checkbox" value="0" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('area','string','0',true); ?> />
				<label for="area_0" class="bold">All Locations</label><br />
								
<?
/*****************************************
/*
/* GENERATE AREAS LIST
/*
/*****************************************/

	$areas = PortalAdvHelperIDX::getAreas();
	echo PortalAdvHelperLayout::displayAreas($areas);


/**
*
*/

?>
		
			</div>
		</div>
	</div>
	
	<div id="filter_pricerange">
		<h4><? echo FILTER_HEADER_PRICE_RANGE; ?></h4>
		<div class="filter_options">
			<div class="filter_pricebox">
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td><label for="price_min">Min </label><span class="bold">$</span></td>
						<td class="left_pad"><label for="price_max">Max </label><span class="bold">$</span></td>
					</tr>
					<tr>
						<td><input id="price_min" name="price_min" maxlength="16" type="text" value="<? echo PortalAdvHelperLayout::checkState('price_min', 'number'); ?>" ></td>
						<td class="left_pad"><input id="price_max" name="price_max" maxlength="16" type="text" value="<? echo PortalAdvHelperLayout::checkState('price_max', 'number'); ?>" ></td>
					</tr>
				</table>
				<div class="error" id="price_msg"></div>
			</div>
		</div>
	</div>
	
	<div align="center">
		<input type="submit" class="button" value=" <? echo FILTER_LABEL_UPDATE_PRICE; ?> " />
	</div>
	<br />
	
	<div id="filter_proptype">
		<h4><? echo FILTER_HEADER_PROPERTY_TYPE; ?></h4>
		<div class="filter_options">
			<div class="filter_checkbox">
				<input id="proptype_0" name="prop_type[]" type="checkbox" class="checkbox" value="0" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('prop_type','string','0',true); ?> />
				<label for="proptype_0" class="bold">All Property Types</label><br />
				<input id="proptype_1" name="prop_type[]" type="checkbox" class="checkbox" value="single family" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('prop_type','string','single family'); ?> />
				<label for="proptype_1">Single Family</label><br />
				<input id="proptype_2" name="prop_type[]" type="checkbox" class="checkbox" value="condo" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('prop_type','string','condo'); ?> />
				<label for="proptype_2">Condo</label><br />
				<input id="proptype_3" name="prop_type[]" type="checkbox" class="checkbox" value="duplex" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('prop_type','string','duplex'); ?> />
				<label for="proptype_3">Duplex</label><br />
				<input id="proptype_4" name="prop_type[]" type="checkbox" class="checkbox" value="townhouse" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('prop_type','string','townhouse'); ?> />
				<label for="proptype_4">Townhouse</label><br />
				<input id="proptype_5" name="prop_type[]" type="checkbox" class="checkbox" value="land" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('prop_type','string','land'); ?> />
				<label for="proptype_5">Land / Farm / Ranch</label><br />
				<input id="proptype_5" name="prop_type[]" type="checkbox" class="checkbox" value="partial" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('prop_type','string','partial'); ?> />
				<label for="proptype_5">Fractional Ownership</label><br />
				<?
				/*
				<input id="proptype_4" name="prop_type[]" type="checkbox" class="checkbox" value="land" <? PortalAdvHelperLayout::checkState('prop_type','land'); ?> />
				<label for="proptype_4">Land</label><br />
				<input id="proptype_5" name="prop_type[]" type="checkbox" class="checkbox" value="income" <? PortalAdvHelperLayout::checkState('prop_type','income'); ?> />
				<label for="proptype_5">Income</label>
				*/
				?>
			</div>
		</div>
	</div>
	
	<div align="center">
		<input type="submit" class="button" value=" <? echo FILTER_LABEL_UPDATE_PROPERTY_TYPE; ?> " />
	</div>
	<br />
	
	<div id="filter_bedrooms">
		<h4><? echo FILTER_HEADER_BEDROOMS; ?></h4>
		<div class="filter_options_left">
			<div class="filter_checkbox">
				<input id="bedrooms_0" name="num_bedrooms[]" type="checkbox" class="checkbox" value="0" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('num_bedrooms','string','0',true); ?> />
				<label for="bedrooms_0" class="bold">All</label><br />
				<input id="bedrooms_1" name="num_bedrooms[]" type="checkbox" class="checkbox" value="S" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('num_bedrooms','string','S'); ?> />
				<label for="bedrooms_1">Studio</label><br />
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td>
							<input id="bedrooms_2" name="num_bedrooms[]" type="checkbox" class="checkbox" value="1" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('num_bedrooms','string','1'); ?> />
							<label for="bedrooms_2">1</label>
						</td>
						<td class="left_pad">
							<input id="bedrooms_3" name="num_bedrooms[]" type="checkbox" class="checkbox" value="2" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('num_bedrooms','string','2'); ?> />
							<label for="bedrooms_3">2</label>
						</td>
					</tr>
					<tr>
						<td>
							<input id="bedrooms_4" name="num_bedrooms[]" type="checkbox" class="checkbox" value="3" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('num_bedrooms','string','3'); ?> />
							<label for="bedrooms_4">3</label>
						</td>
						<td class="left_pad">
							<input id="bedrooms_5" name="num_bedrooms[]" type="checkbox" class="checkbox" value="4" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('num_bedrooms','string','4'); ?> />
							<label for="bedrooms_5">4</label>
						</td>
					</tr>
					<tr>
						<td>
							<input id="bedrooms_6" name="num_bedrooms[]" type="checkbox" class="checkbox" value="5+" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('num_bedrooms','string','5+'); ?> />
							<label for="bedrooms_6">5+</label>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	
	<div id="filter_bathrooms">
		<h4><? echo FILTER_HEADER_BATHROOMS; ?></h4>
		<div class="filter_options_right">
			<div class="filter_checkbox">
				<input id="bathrooms_0" name="num_bathrooms[]" type="checkbox" class="checkbox" value="0" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('num_bathrooms','string','0',true); ?> />
				<label for="bathrooms_0" class="bold">All</label>
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td>
							<input id="bathrooms_1" name="num_bathrooms[]" type="checkbox" class="checkbox" value="1" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('num_bathrooms','string','1'); ?> />
							<label for="bathrooms_1">1</label>
						</td>
						<td class="left_pad">
							<input id="bathrooms_2" name="num_bathrooms[]" type="checkbox" class="checkbox" value="1.5" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('num_bathrooms','string','1.5'); ?> />
							<label for="bathrooms_2">1.5</label>
						</td>
					</tr>
					<tr>
						<td>
							<input id="bathrooms_3" name="num_bathrooms[]" type="checkbox" class="checkbox" value="2" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('num_bathrooms','string','2'); ?> />
							<label for="bathrooms_3">2</label>
						</td>
						<td class="left_pad">
							<input id="bathrooms_4" name="num_bathrooms[]" type="checkbox" class="checkbox" value="2.5" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('num_bathrooms','string','2.5'); ?> />
							<label for="bathrooms_4">2.5</label>
						</td>
					</tr>
					<tr>
						<td>
							<input id="bathrooms_5" name="num_bathrooms[]" type="checkbox" class="checkbox" value="3" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('num_bathrooms','string','3'); ?> />
							<label for="bathrooms_5">3</label>
						</td>
						<td class="left_pad">
							<input id="bathrooms_6" name="num_bathrooms[]" type="checkbox" class="checkbox" value="3.5" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('num_bathrooms','string','3.5'); ?> />
							<label for="bathrooms_6">3.5</label>
						</td>
					</tr>
					<tr>
						<td>
							<input id="bathrooms_7" name="num_bathrooms[]" type="checkbox" class="checkbox" value="4+" onclick="checkInput(this);" <? echo PortalAdvHelperLayout::checkState('num_bathrooms','string','4+'); ?> />
							<label for="bathrooms_7">4+</label>
						</td>
						<td class="left_pad">
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<div class="clear"></div>

	<div align="center">
		<input type="submit" class="button" value=" <? echo FILTER_LABEL_UPDATE_BED_BATH; ?> " />
	</div>
	<br />
	
	<div id="filter_squarefeet">
		<h4><? echo FILTER_HEADER_SQUARE_FEET; ?></h4>
		<div class="filter_options">
			<div class="filter_squarefeetbox">
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td><label for="squarefeet_min" class="bold">Min</label></td>
						<td class="left_pad"><label for="squarefeet_max" class="bold">Max</label></td>
					</tr>
					<tr>
						<td><input id="squarefeet_min" name="squarefeet_min" type="text" value="<? echo PortalAdvHelperLayout::checkState('squarefeet_min', 'number'); ?>" /></td>
						<td class="left_pad"><input id="squarefeet_max" name="squarefeet_max" type="text" value="<? echo PortalAdvHelperLayout::checkState('squarefeet_max', 'number'); ?>" /></td>
					</tr>
				</table>
				<div class="error" id="squarefeet_msg"></div>
			</div>
		</div>
	</div>
	
	<?
	/*
	<div id="filter_squarefeet">
		<h4><? echo FILTER_HEADER_FEATURES; ?></h4>
		<div class="filter_options">
			<div class="filter_features">
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td><input id="keyword" name="keyword" type="text" value="<? echo PortalAdvHelperLayout::checkState('keyword'); ?>" onclick="if(this.value == 'ex: garage, backyard') { this.value = ''; }"/></td>
					</tr>
				</table>
				<div class="error" id="squarefeet_msg"></div>
			</div>
		</div>
	</div>
	*/
	?>
	
	<div align="center">
		<input type="submit" class="button" value=" <? echo FILTER_LABEL_UPDATE_SQUAREFEET; ?> " />
	</div>
	
<br />
<?php if($this->total > 0) : ?>
<div align="center">
	<div style="float: right;">
				<?php /*echo $this->pagination->getLimitBox( ); */ ?>
	</div>
	<div>
		<?php /*echo $this->pagination->getPagesCounter();*/ ?>
	</div>
</div>
<?php endif; ?>

<input type="hidden" name="lat_min" value="0" />
<input type="hidden" name="lat_max" value="0" />
<input type="hidden" name="lng_min" value="0" /> 
<input type="hidden" name="lng_min" value="0" /> 
<input type="hidden" name="task" value="search" />
<input type="hidden" name="limit" value="10" />
<input type="hidden" name="task" value="search" />
<input type="hidden" name="search_type" value="filter" />
	</div>
	</div>
	</div>
	</div>


