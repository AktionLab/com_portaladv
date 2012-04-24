<?php defined('_JEXEC') or die('Restricted access'); ?>

<div class="PortalAdvMap_container">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td valign="top">
			<div id="mapContainer">
	 			<div id="GoogleMapSearch"><!-- --></div>
	 			<div id="mapLoading" style="display:none;">
	 				<div id="loadingGif"><!-- --></div>
	 			</div>
	 		</div>
   		 	<div class="details_map_filter">
   		 		<div class="details_neighborhood_features">Neighborhood<br/>Features</div>
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
      		
   		</td>
   	</tr>
</table>
<div id="pano" style="width:938px;height:300px;"></div>
</div>
<div class="clear"></div>

<script type="text/javascript" language="javascript">
  var PortalAdvMap = initializeMap('<?=DEFAULT_LAT?>','<?=DEFAULT_LONG?>',<?=DEFAULT_ZOOM?>,false);
  PortalAdvMap.onMapMove();
  initialize2();
</script>
