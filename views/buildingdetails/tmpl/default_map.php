<?php defined('_JEXEC') or die('Restricted access'); ?>
<?
$listing = $this->details;
//$listing->brochure = true;
//$listing->floorplan = true;
//$listing->video = true;
?>
<div id="PortalAdvMapViewTabs">
	<div id="tab_normal" class="PortalAdvMapViewTabs_tab" onmouseover="if (this.className != 'PortalAdvMapViewTabs_tab_active') { this.className='PortalAdvMapViewTabs_tab_hover'; }" onmouseout="if (this.className != 'PortalAdvMapViewTabs_tab_active') { this.className='PortalAdvMapViewTabs_tab'; }" onclick="changeMapView('normal');">Map</div>
	<div id="tab_satellite" class="PortalAdvMapViewTabs_tab" onmouseover="if (this.className != 'PortalAdvMapViewTabs_tab_active') { this.className='PortalAdvMapViewTabs_tab_hover'; }" onmouseout="if (this.className != 'PortalAdvMapViewTabs_tab_active') { this.className='PortalAdvMapViewTabs_tab'; }" onclick="changeMapView('satellite');">Satellite</div>
	<div id="tab_hybrid" class="PortalAdvMapViewTabs_tab_active" onmouseover="if (this.className != 'PortalAdvMapViewTabs_tab_active') { this.className='PortalAdvMapViewTabs_tab_hover'; }" onmouseout="if (this.className != 'PortalAdvMapViewTabs_tab_active') { this.className='PortalAdvMapViewTabs_tab'; }" onclick="changeMapView('hybrid');">Hybrid</div>
	<div id="tab_hybrid" class="PortalAdvMapViewTabs_tab" onclick="changeMapView('street');">Street View</div>
	
	<div id="tab_brochure" class="PortalAdvMapViewTabs_tab" onmouseover="if (this.className != 'PortalAdvMapViewTabs_tab_active') { this.className='PortalAdvMapViewTabs_tab_hover'; }" onmouseout="if (this.className != 'PortalAdvMapViewTabs_tab_active') { this.className='PortalAdvMapViewTabs_tab'; }" onclick="changeMapView('brochure'); showBrochure();">Brochure</div>
	
	<div id="tab_floor_plan" class="PortalAdvMapViewTabs_tab" onmouseover="if (this.className != 'PortalAdvMapViewTabs_tab_active') { this.className='PortalAdvMapViewTabs_tab_hover'; }" onmouseout="if (this.className != 'PortalAdvMapViewTabs_tab_active') { this.className='PortalAdvMapViewTabs_tab'; }" onclick="changeMapView('floorplan'); showFloorPlan();">Floor Plan</div>
	
	<div id="tab_video" class="PortalAdvMapViewTabs_tab" onmouseover="if (this.className != 'PortalAdvMapViewTabs_tab_active') { this.className='PortalAdvMapViewTabs_tab_hover'; }" onmouseout="if (this.className != 'PortalAdvMapViewTabs_tab_active') { this.className='PortalAdvMapViewTabs_tab'; }" onclick="changeMapView('video'); showVideo();">Video</div>
	
	<div id="tab_virtual_tour" class="PortalAdvMapViewTabs_tab" onmouseover="if (this.className != 'PortalAdvMapViewTabs_tab_active') { this.className='PortalAdvMapViewTabs_tab_hover'; }" onmouseout="if (this.className != 'PortalAdvMapViewTabs_tab_active') { this.className='PortalAdvMapViewTabs_tab'; }" onclick="changeMapView('virtual_tour'); showVirtualTour('<?=$listing->{FIELDNAME_LISTING_VIRTUAL_TOUR_LINK}?>');">Virtual Tour</div>
	
	
	<div class="clear" style="height:0px;"><!-- --></div>
</div>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td valign="top">
			<div id="extra_info_container" class="<? echo $listing->{FIELDNAME_LISTING_VIRTUAL_TOUR_LINK}; ?>" ></div>
			<div id="mapContainer">
			<div id="GoogleMapSearch_"><!-- --></div>
	 			<?
	 			if (PROPERTY_DETAILS_NEIGHBORHOOD_FEATURES == 1) {
	 				echo "\n<div id=\"GoogleMapSearch\"><!-- --></div>";
	 				echo "\n<div id=\"mapLoading\" class=\"mapLoading\" style=\"display:none;\">\n<div id=\"loadingGif\"><!-- --></div>\n</div>";
	 			} else {
	 				echo "<div id=\"GoogleMapSearch\" class=\"GoogleMapSearch_full_width\" ><!-- --></div>";
	 				echo "\n<div id=\"mapLoading\" class=\"mapLoading_full_width\" style=\"display:none;\">\n<div id=\"loadingGif\"><!-- --></div>\n</div>";
	 			}
	 			?>
	 			
	 		</div>
	 		<div id="GoogleBarResultList"><!-- --></div>
	 		<? if (PROPERTY_DETAILS_NEIGHBORHOOD_FEATURES == 1) { ?>
   		 	<div class="details_map_filter" style="width:255px;overflow:hidden;">
   		 		<div class="details_neighborhood_features">Neighborhood Features</div>
   		 		<div class="details_view_nearby">View Nearby:</div>
   		 		<div class="details_filter_icons">

					<table>
						<tr>
							<td><input type="checkbox" name="local_schools" id="ls" onclick="showFeatures(this,'school');" /></td><td><label for="ls"><img src="http://www.nelsonteam.com/components/com_portaladv/images/box_local_schools.png"/></label></td><td><label for="ls">Local Schools</label></td>
						</tr>
						<tr>
							<td><input type="checkbox" name="grocery_stores" id="gs" onclick="showFeatures(this,'grocery');" /></td><td><label for="gs"><img src="http://www.nelsonteam.com/components/com_portaladv/images/box_grocery_stores.png"/></label></td><td><label for="gs">Grocery Stores</label></td>
						</tr>						
						<tr>

							<td><input type="checkbox" name="parks" id="ps" onclick="showFeatures(this,'park');" /></td><td><label for="ps"><img src="http://www.nelsonteam.com/components/com_portaladv/images/box_parks.png"/></label></td><td><label for="ps">Parks</label></td>
						</tr>						
						<tr>
							<td><input type="checkbox" name="restaurants" id="rs" onclick="showFeatures(this,'restaurant');"/></td><td><label for="rs"><img src="http://www.nelsonteam.com/components/com_portaladv/images/box_restaurants.png"/></label></td><td><label for="rs">Restaurants</label></td>
						</tr>						
						<tr>
							<td><input type="checkbox" name="gas_stations" id="gas" onclick="showFeatures(this,'gas');" /></td><td><label for="gas"><img src="http://www.nelsonteam.com/components/com_portaladv/images/box_gas_stations.png"/></label></td><td><label for="gas">Gas Stations</label></td>
						</tr>						
						<tr>

							<td><input type="checkbox" name="bars" id="bs" onclick="showFeatures(this,'bar');" /></td><td><label for="bs"><img src="http://www.nelsonteam.com/components/com_portaladv/images/box_bars.png"/></label></td><td><label for="bs">Bars</label></td>
						</tr>
						<tr>
							<td><input type="checkbox" name="hospitals" id="hs" onclick="showFeatures(this,'hospital');" /></td><td><label for="hs"><img src="http://www.nelsonteam.com/components/com_portaladv/images/box_hospitals.png"/></label></td><td><label for="hs">Hospitals</label></td>
						</tr>
						<tr>
							<td colspan="3" style="padding-top: 10px;"><input type="button" name="clearAll" onclick="removeFeatures()" class="clear_checkbox"  value="Clear Selected"></td>
						</tr>
					</table>
   		 	</div>
   		 	<div class="clear"></div>
			<div id="searchform" style="display:none;"></div>
			<div id="results" style="display:none;">
        		<div id="searchwell"></div>
      		</div>
      		<? } ?>
   		</td>
   	</tr>
</table>

<script type="text/javascript" language="javascript">
 
  var PortalAdvMap = initializeMap('<?=$listing->latitude?>','<?=$listing->longitude?>',16,true);
  //PortalAdvMap.showSingleListing('<?=$listing->latitude?>','<?=$listing->longitude?>');
  //PortalAdvMap.onMapMove();
</script>
