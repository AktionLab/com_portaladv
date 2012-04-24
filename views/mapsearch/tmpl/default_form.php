<?php defined('_JEXEC') or die('Restricted access'); ?>

	<div id="mapsearch_form_container">
	<div style="width:100%;background:#581C12;">
		<div style="padding:10px;"><h3 style="padding:0px;margin:0px;">Map Search <span id="searchMessage"></span></h3></div>
	</div>
	<table cellspacing="10" width="100%">
		<tr>
			<td valign="top">
				<h4 style="margin-top:0px;margin-bottom:0px;">City</h4>
				<?
				$cities = PortalAdvHelperIDX::getCities();
				echo PortalAdvHelperLayout::displayCitySelectList($cities, '200', 'DENVER');
				?>
			</td>
			<td valign="top">
				<h4 style="margin-top:0px;margin-bottom:0px;">Price Min</h4>
				<?
					echo PortalAdvHelperLayout::displaySearchPrices('price_min','200',10000,10000000,false,'getListings');
				?>
			</td>
			<td valign="top">
				<h4 style="margin-top:0px;margin-bottom:0px;">Square Feet</h4>
				<select name="squarefeet_min" onchange="getListings();" style="width:200px;">
					<option value="0">- any -</option>
					<option value="500" <? echo PortalAdvHelperLayout::checkSelectState('squarefeet_min','500'); ?>>500+</option>
					<option value="1000" <? echo PortalAdvHelperLayout::checkSelectState('squarefeet_min','1000'); ?>>1000+</option>
					<option value="1500" <? echo PortalAdvHelperLayout::checkSelectState('squarefeet_min','1500'); ?>>1500+</option>
					<option value="2000" <? echo PortalAdvHelperLayout::checkSelectState('squarefeet_min','2000'); ?>>2000+</option>
					<option value="2500" <? echo PortalAdvHelperLayout::checkSelectState('squarefeet_min','2500'); ?>>2500+</option>
					<option value="3000" <? echo PortalAdvHelperLayout::checkSelectState('squarefeet_min','3000'); ?>>3000+</option>
					<option value="3500" <? echo PortalAdvHelperLayout::checkSelectState('squarefeet_min','3500'); ?>>3500+</option>
					<option value="4000" <? echo PortalAdvHelperLayout::checkSelectState('squarefeet_min','4000'); ?>>4000+</option>
				</select>
			</td>
			<td valign="top" rowspan="2">
				<h4 style="margin-top:0px;margin-bottom:0px;">Bedrooms</h4>
					<div class="filter_checkbox">
					<input id="bedrooms_0" name="num_bedrooms[]" type="checkbox" class="checkbox" value="0" onclick="checkInput(this);" onchange="getListings();" <? echo PortalAdvHelperLayout::checkState('num_bedrooms','string','0',true); ?> />
					<label for="bedrooms_0" class="bold">All</label><br />
					<input id="bedrooms_1" name="num_bedrooms[]" type="checkbox" class="checkbox" value="S" onclick="checkInput(this);" onchange="getListings();" <? echo PortalAdvHelperLayout::checkState('num_bedrooms','string','1'); ?> />
					<label for="bedrooms_1">Studio</label><br />
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td>
								<input id="bedrooms_2" name="num_bedrooms[]" type="checkbox" class="checkbox" value="1" onclick="checkInput(this);" onchange="getListings();" <? echo PortalAdvHelperLayout::checkState('num_bedrooms','string','1'); ?> />
								<label for="bedrooms_2">1</label>
							</td>
							<td class="left_pad">
								<input id="bedrooms_3" name="num_bedrooms[]" type="checkbox" class="checkbox" value="2" onclick="checkInput(this);" onchange="getListings();" <? echo PortalAdvHelperLayout::checkState('num_bedrooms','string','2'); ?> />
								<label for="bedrooms_3">2</label>
							</td>
						</tr>
						<tr>
							<td>
								<input id="bedrooms_4" name="num_bedrooms[]" type="checkbox" class="checkbox" value="3" onclick="checkInput(this);" onchange="getListings();" <? echo PortalAdvHelperLayout::checkState('num_bedrooms','string','3'); ?> />
								<label for="bedrooms_4">3</label>
							</td>
							<td class="left_pad">
								<input id="bedrooms_5" name="num_bedrooms[]" type="checkbox" class="checkbox" value="4+" onclick="checkInput(this);" onchange="getListings();" <? echo PortalAdvHelperLayout::checkState('num_bedrooms','string','4+'); ?> />
								<label for="bedrooms_5">4+</label>
							</td>
						</tr>
					</table>
				</div>
			</td>
			<td valign="top" rowspan="2">
				<h4 style="margin-top:0px;margin-bottom:0px;">Bathrooms</h4>
					<div class="filter_checkbox">
					<input id="bathrooms_0" name="num_bathrooms[]" type="checkbox" class="checkbox" value="0" onclick="checkInput(this);" onchange="getListings();" <? echo PortalAdvHelperLayout::checkState('num_bathrooms','string','0',true); ?> />
					<label for="bathrooms_0" class="bold">All</label>
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td>
								<input id="bathrooms_1" name="num_bathrooms[]" type="checkbox" class="checkbox" value="1" onclick="checkInput(this);" onchange="getListings();" <? echo PortalAdvHelperLayout::checkState('num_bathrooms','string','1'); ?> />
								<label for="bathrooms_1">1</label>
							</td>
							<td class="left_pad">
								<input id="bathrooms_2" name="num_bathrooms[]" type="checkbox" class="checkbox" value="1.5" onclick="checkInput(this);" onchange="getListings();" <? echo PortalAdvHelperLayout::checkState('num_bathrooms','string','1.5'); ?> />
								<label for="bathrooms_2">1.5</label>
							</td>
						</tr>
						<tr>
							<td>
								<input id="bathrooms_3" name="num_bathrooms[]" type="checkbox" class="checkbox" value="2" onclick="checkInput(this);" onchange="getListings();" <? echo PortalAdvHelperLayout::checkState('num_bathrooms','string','2'); ?> />
								<label for="bathrooms_3">2</label>
							</td>
							<td class="left_pad">
								<input id="bathrooms_4" name="num_bathrooms[]" type="checkbox" class="checkbox" value="2.5" onclick="checkInput(this);" onchange="getListings();" <? echo PortalAdvHelperLayout::checkState('num_bathrooms','string','2.5'); ?> />
								<label for="bathrooms_4">2.5</label>
							</td>
						</tr>
						<tr>
							<td>
								<input id="bathrooms_5" name="num_bathrooms[]" type="checkbox" class="checkbox" value="3" onclick="checkInput(this);" onchange="getListings();" <? echo PortalAdvHelperLayout::checkState('num_bathrooms','string','3'); ?> />
								<label for="bathrooms_5">3</label>
							</td>
							<td class="left_pad">
								<input id="bathrooms_5" name="num_bathrooms[]" type="checkbox" class="checkbox" value="3.5" onclick="checkInput(this);" onchange="getListings();" <? echo PortalAdvHelperLayout::checkState('num_bathrooms','string','3.5'); ?> />
								<label for="bathrooms_5">3.5</label>
							</td>
						</tr>
						<tr>
							<td>
								<input id="bathrooms_5" name="num_bathrooms[]" type="checkbox" class="checkbox" value="4+" onchange="getListings();" <? echo PortalAdvHelperLayout::checkState('num_bathrooms','string','4+'); ?> />
								<label for="bathrooms_5">4+</label>
							</td>
							<td class="left_pad">
							</td>
						</tr>
					</table>
				</div>
			</td>
			

		</tr>
		<tr>
			<td valign="top">
				<h4 style="margin-top:0px;margin-bottom:0px;">Property Type</h4>
				<select name="prop_type" style="width:200px;" onchange="getListings();">
					<option value="0" selected>- all -</option>
					<option value="residential" <? /*echo PortalAdvHelperLayout::checkSelectState('prop_type','residential'); */?> >Single Family</option>
					<option value="condo" <? /*echo PortalAdvHelperLayout::checkSelectState('prop_type','condo');*/ ?> >Condominium</option>
				</select>
			</td>
			<td valign="top">
				<h4 style="margin-top:0px;margin-bottom:0px;">Price Max</h4>
				<?
					echo PortalAdvHelperLayout::displaySearchPrices('price_max','200',10000,25000000,'no max','getListings');
				?>
			</td>
			
			<td valign="top">
				<!--
				<h4 style="margin-top:0px;margin-bottom:0px;">Lot Size</h4>
				<input name="acres" type="text" class="input" /><br />
				<span class="small">acres</span>
				-->
			</td>
		</tr>	
	</table>

	
	<div id="PortalAdvMapViewTabs">
	<div id="tab_normal" class="PortalAdvMapViewTabs_tab_active" onclick="changeMapView('normal');">Map</div>
	<div id="tab_satellite" class="PortalAdvMapViewTabs_tab" onclick="changeMapView('satellite');">Satellite</div>
	<div id="tab_hybrid" class="PortalAdvMapViewTabs_tab" onclick="changeMapView('hybrid');">Hybrid</div>
	<?
	/*
	<div id="tab_street" class="PortalAdvMapViewTabs_tab" onclick="PortalAdvMap.toggleStreetView();">Street View</div>
	*/
	?>
	<div class="clear" style="height:0px;"><!-- --></div>
</div>
</div>
<input type="hidden" name="search_type" value="map" />
<input type="hidden" name="lat_min" value="<? echo PortalAdvHelperLayout::checkState('lat_min'); ?>" />
<input type="hidden" name="lat_max" value="<? echo PortalAdvHelperLayout::checkState('lat_max'); ?>" />
<input type="hidden" name="lng_min" value="<? echo PortalAdvHelperLayout::checkState('lng_min'); ?>" />
<input type="hidden" name="lng_max" value="<? echo PortalAdvHelperLayout::checkState('lng_max'); ?>" />
<input type="hidden" id="area" name="area[]" value="0" />
	