//define contants
var DEFAULT_LAT 	= '39.754';
var DEFAULT_LONG	= '-104.99';
var DEFAULT_ZOOM 	= '15';

var ListingCoordinates = new Array;
var Listings = new Array;
var gSelectedResults = [];
var gCurrentResults = new Array;
var currentFeature = '';
		

gCurrentResults['school'] = new Array;
gCurrentResults['grocery'] = new Array;
gCurrentResults['park'] = new Array;
gCurrentResults['restaurant'] = new Array;
gCurrentResults['gas'] = new Array;
gCurrentResults['bar'] = new Array;
gCurrentResults['hospital'] = new Array;

var gLocalSearch;

// Create our "tiny" marker icon
   var gSmallIcon = new GIcon();
   gSmallIcon.image = "http://labs.google.com/ridefinder/images/mm_20_yellow.png";
   gSmallIcon.shadow = "http://labs.google.com/ridefinder/images/mm_20_shadow.png";
   gSmallIcon.iconSize = new GSize(14, 20);
   gSmallIcon.shadowSize = new GSize(22, 20);
   gSmallIcon.iconAnchor = new GPoint(6, 20);
   gSmallIcon.infoWindowAnchor = new GPoint(5, 1);

// Create "school" marker icon
   var icon_school = new GIcon(gSmallIcon);
   icon_school.image = "/components/com_portaladv/images/icon_school.gif";
   icon_school.shadow = "/components/com_portaladv/images/tiny_icon_square_shadow.png";
   icon_school.shadowSize = new GSize(22, 20);
   icon_school.iconAnchor = new GPoint(9, 20);
   icon_school.iconSize = new GSize(17, 17);

// Create "grocery" marker icon
   var icon_grocery = new GIcon(gSmallIcon);
   icon_grocery.image = "/components/com_portaladv/images/icon_grocery.gif";
   icon_grocery.shadow = "/components/com_portaladv/images/tiny_icon_square_shadow.png";
   icon_grocery.iconAnchor = new GPoint(5, 17);
   icon_grocery.iconSize = new GSize(17, 17);

// Create "park" marker icon
   var icon_parks = new GIcon(gSmallIcon);
   icon_parks.image = "/components/com_portaladv/images/icon_park.gif";
   icon_parks.shadow = "/components/com_portaladv/images/tiny_icon_square_shadow.png";
   icon_parks.iconAnchor = new GPoint(5, 23);
   icon_parks.iconSize = new GSize(17, 17);

// Create "restaurant" marker icon
   var icon_restaurant = new GIcon(gSmallIcon);
   icon_restaurant.image = "/components/com_portaladv/images/icon_restaurant.gif";
   icon_restaurant.shadow = "/components/com_portaladv/images/tiny_icon_square_shadow.png";
   icon_restaurant.iconAnchor = new GPoint(12, 17);
   icon_restaurant.iconSize = new GSize(17, 17);

// Create "gas" marker icon
   var icon_gas = new GIcon(gSmallIcon);
   icon_gas.image = "/components/com_portaladv/images/icon_gas.gif";
   icon_gas.shadow = "/components/com_portaladv/images/tiny_icon_square_shadow.png";
   icon_gas.iconAnchor = new GPoint(10, 22);
   icon_gas.iconSize = new GSize(17, 17);

// Create "bar" marker icon
   var icon_bar = new GIcon(gSmallIcon);
   icon_bar.image = "/components/com_portaladv/images/icon_bar.gif";
   icon_bar.shadow = "/components/com_portaladv/images/tiny_icon_square_shadow.png";
   icon_bar.iconAnchor = new GPoint(7, 19);
   icon_bar.iconSize = new GSize(17, 17);

// Create "hospital" marker icon
   var icon_hospital = new GIcon(gSmallIcon);
   icon_hospital.image = "/components/com_portaladv/images/icon_hospital.gif";
   icon_hospital.shadow = "/components/com_portaladv/images/tiny_icon_square_shadow.png";
   icon_hospital.iconSize = new GSize(17, 17);

//Function to get proper icon for feature
function getIcon(feature) {
	switch(feature) {
		case 'school':
			return icon_school;
			break;
		case 'grocery':
			return icon_grocery;
			break;
		case 'park':
			return icon_parks;
			break;
		case 'restaurant':
			return icon_restaurant;
			break;
		case 'gas':
			return icon_gas;
			break;
		case 'bar':
			return icon_bar;
			break;
		case 'hospital':
			return icon_hospital;
			break;
		default:
			return gSmallIcon;
			break;
	}
}

function initializeMap(lat, long, zoom, singleListingMap) {
	return new PortalAdvGoogleMap(lat,long,zoom,singleListingMap);
}

function PortalAdvGoogleMap(lat, long, zoom, singleListingMap) {
		this.feature = '';
		this.listings = new Array;
		this.features = new Array;
		this.markers = new Array;
		this.featuresToReQuery = new Array;
		this.overlayInstance = null;
		this.panorama = null;

	   G_NORMAL_MAP.getMinimumResolution = function () { return 14 };
       G_SATELLITE_MAP.getMinimumResolution = function () { return 14 };
       G_HYBRID_MAP.getMinimumResolution = function () { return 14 };

		// initialize the search form (hidden)
		//this.gSearchForm = new GSearchForm(false, document.getElementById("searchform"));
     	//this.gSearchForm.setOnSubmitCallback(null, CaptureForm);
     	//this.gSearchForm.input.focus();

       //initialize the geocoder
       this.geocoder = new GClientGeocoder();

       this.map = new GMap2(document.getElementById("GoogleMapSearch"),
  			{
  				googleBarOptions:
  					{
  						showOnLoad: true,
  						resultList: document.getElementById('GoogleBarResultList'),
  						suppressInitialResultSelection: true,
  						suppressZoomToBounds: true
  					}
  			}
  		);
  			
		// Initialize the local searcher
     	gLocalSearch = new GlocalSearch();
     	gLocalSearch.setCenterPoint(this.map);
     	gLocalSearch.setSearchCompleteCallback(null, OnLocalSearch);
  		
		this.map.addControl(new GLargeMapControl());

		//this.map.enableGoogleBar();
       this.map.setCenter(new GLatLng(lat, long), zoom);
       this.map.setMapType(G_HYBRID_MAP);

       //var iconsize = new GSize(12,15);
	    //this.icon = new GIcon(G_DEFAULT_ICON,'http://www.copperpm.com/components/com_portaladv/images/tiny_icon.gif');
	    this.icon = new GIcon(G_DEFAULT_ICON,'http://www.beavercreekonline.com/components/com_portaladv/images/tiny_icon2.png');
        //this.icon.shadow = 'http://www.copperpm.com/components/com_portaladv/images/tiny_icon_shadow.png';
        //this.icon.iconSize = new GSize('13','20');
        this.icon.iconSize = new GSize('34','45');
       this.icon.shadowSize = new GSize('36','18');

       //setup street view
       this.client = new GStreetviewClient();
       this.guyIcon = new GIcon(G_DEFAULT_ICON);
		this.guyIcon.image = "http://maps.google.com/intl/en_us/mapfiles/cb/man_arrow-0.png";
 		this.guyIcon.transparent = "http://maps.google.com/intl/en_us/mapfiles/cb/man-pick.png";
 		this.guyIcon.imageMap = [
       26,13, 30,14, 32,28, 27,28, 28,36, 18,35, 18,27, 16,26,
       16,20, 16,14, 19,13, 22,8
    	];
 		this.guyIcon.iconSize = new GSize(49, 52);
 		this.guyIcon.iconAnchor = new GPoint(25, 35);  // near base of guy's feet
 		this.guyIcon.infoWindowAnchor = new GPoint(25, 5);  // top of guy's head
		this.lastMarkerLocation = this.map.getCenter();

       if (singleListingMap == false) {
       	GEvent.bind(this.map, "moveend", this, this.onMapMove);
       }
       if (singleListingMap == true) {
       	GEvent.bind(this.map, "moveend", this, this.updateFeatures);
       }

}

PortalAdvGoogleMap.prototype.onMapMove = function() {
	
	var bounds = this.map.getBounds();
	var southWest = bounds.getSouthWest();
	var northEast = bounds.getNorthEast();
	var lat_min = southWest.lat();
	var lat_max = northEast.lat();
	var lng_min = southWest.lng();
	var lng_max = northEast.lng();
	
	//set hidden form fields
	if (document.forms['mapSearchForm']) {
		document.forms['mapSearchForm'].lat_min.value = lat_min;
		document.forms['mapSearchForm'].lat_max.value = lat_max;
		document.forms['mapSearchForm'].lng_min.value = lng_min;
		document.forms['mapSearchForm'].lng_max.value = lng_max;
	}
	
	this.getListings();
	this.updateFeatures();
	
	//if (myPano) {
	//	myPano.setLocationAndPOV(this.map.getCenter(), {yaw:currentYaw, pitch:-10});
	//}
	//removeFeatures();
}


PortalAdvGoogleMap.prototype.showSingleListing = function (lat,long) {
	var coords = new GLatLng(lat,long);
	this.marker = new GMarker(coords,this.icon);
	this.map.addOverlay(this.marker);
}

// Called when Local Search results are returned, we clear the old
// results and load the new ones.
OnLocalSearch = function() {
		
	if (!gLocalSearch.results) return;
	
	if (PortalAdvMap.featuresToReQuery[PortalAdvMap.featuresToReQuery.length-1]) {
		currentFeature = PortalAdvMap.featuresToReQuery[PortalAdvMap.featuresToReQuery.length-1];
		//alert(currentFeature + ": " + gLocalSearch.results.length);
	}
	

   for (var i = 0; i < gLocalSearch.results.length; i++) {
   		var result = new LocalResult(gLocalSearch.results[i],currentFeature);
   		var feat = currentFeature;
   		eval("gCurrentResults['" + currentFeature + "'].push(result)");
   }
   PortalAdvMap.featuresToReQuery.pop();
   if (PortalAdvMap.featuresToReQuery[PortalAdvMap.featuresToReQuery.length-1]) {
		PortalAdvMap.gSearchForm.execute(PortalAdvMap.featuresToReQuery[PortalAdvMap.featuresToReQuery.length-1]);
	}
}

function getListings() {
	PortalAdvGoogleMap.prototype.getListings();
}

PortalAdvGoogleMap.prototype.changeCity = function(city) {
 var map = this.map;
 this.geocoder.getLatLng(
 	city,
   function(point) {
     if (!point) {
       alert(city + " not found");
     } else {
       map.setCenter(point, 13);
     }
   }
 );
 var coords = map.getCenter();
 updateStreetViewFromGLatLng(coords);
}

function removeLoadingGif() {
	//if (document.getElementById('mapLoading').style.display == 'block') {
		document.getElementById('mapLoading').style.display = 'none';
	//}
}

PortalAdvGoogleMap.prototype.getListings = function() {
	document.getElementById("mapLoading").style.display = 'block';
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
			window.setTimeout(removeLoadingGif,1000);
			eval(xmlHttp.responseText);
			//alert(xmlHttp.responseText);
			
			PortalAdvMap.buildMap(listings);
			document.getElementById("mapLoading").style.display = 'none';
		}
	}
	
	vars = '';
	var theForm = document.mapSearchForm;
	var counter = 0;
	for(i=0;i<theForm.elements.length;i++) {
		var el = theForm.elements[i];
		var name = el.name;
		
		if (i>0 && name != theForm.elements[i-1].name) {
			counter = 0;
		}
		
		//rewrite keys if multi-select checkboxes
		if(el.type == 'checkbox' && el.checked == true) {
			name = name.replace('[]','');
			name += '[' + counter + ']';
			vars += '&' + name + '=' + el.value;
			counter++;
			
		}
		if (el.type != 'checkbox') {
			vars += '&' + name + '=' + el.value;
		}
		
	}
	
	var script = "index.php?option=com_portaladv&view=mapsearch&task=ajax&format=raw";
	script += vars;
	//alert(script);
	
	xmlHttp.open("get",script,true);
	xmlHttp.send(null);

}

PortalAdvGoogleMap.prototype.buildMap = function(listings) {
	document.getElementById('searchMessage').innerHTML = '| Your search matched <strong>' + listings.length + '</strong> properties.';
	
	//hide all markers
	for(j=0;j<this.markers.length;j++) {
		eval("this.marker_" + this.markers[j]['listing_num'] + ".hide();");
	}
	
	for(i=0;i<listings.length;i++) {
		var markerExists = false;
		for(j=0;j<this.markers.length;j++) {
			if (this.markers[j]['latitude'] == listings[i]['latitude'] && this.markers[j]['longitude'] == listings[i]['longitude']) {
				markerExists = true;
				eval("this.marker_" + this.markers[j]['listing_num'] + ".show();");
			}
		}
		//add new marker if not exists
		if (!markerExists) {
			this.markers.push(listings[i]);
			var markerHTML = "<table><tr><td colspan='2' style='padding-top:5px;'><span class='mapInfoWindow_text'>Listing Provider: " + listings[i]['office_name'] + "</span></td></tr><tr><td width='90' align='center'><div style='width:90px;height:60px;background:url(/components/com_portaladv/images/noimage_90.jpg);'><img src='/images/mls/" + listings[i]['listing_num'] + "A.jpg' width='90' /></div><span class='mapInfoWindow_bedbath'>MLS #" + listings[i]['listing_num'] + "</span><br /></td><td style='padding-left:8px;'><span class='mapInfoWindow_price'>" + listings[i]['price'] + "</span><br /><span class='mapInfoWindow_text'>" + listings[i]['address'] + "<br />" + listings[i]['city'] + ", CO</span><br /><span class='mapInfoWindow_bedbath'>" +  listings[i]['bedrooms_total'] + "bd / " +  listings[i]['baths_total'] + "ba / " + listings[i]['total_square_feet'] + "sf</span><br /><a href='index.php?option=com_portaladv&view=details&task=details&listing=" + listings[i]['listing_num'] + "' class='mapInfoWindow_link'>&raquo; details</a><div style='float:right;margin-top:-5px;'><img src='/components/com_portaladv/idx_r.png' /></div></td></tr></table>";
			var coords = new GLatLng(listings[i]['latitude'],listings[i]['longitude']);
			eval("this.marker_" + listings[i]['listing_num'] + " = new GMarker(coords,this.icon)");
			eval("this.map.addOverlay(this.marker_" + listings[i]['listing_num'] + ")");
			eval("this.marker_" + listings[i]['listing_num'] + ".bindInfoWindowHtml(markerHTML)");
			eval("GEvent.addListener(this.marker_" + listings[i]['listing_num'] + ", 'click', function() { updateStreetView('" + listings[i]['latitude'] + "','" + listings[i]['longitude'] + "'); })");
		}
	}
	
	
}

function showFeatures(el,feature) {
	//alert(el + ": " + feature);
	if (el.checked == true) {
		PortalAdvMap.feature = feature;
		if(PortalAdvMap.features[feature] == undefined) {
			PortalAdvMap.features[feature] = new Object;
			PortalAdvMap.features[feature].name = feature;
		}
		PortalAdvMap.features[feature].active = true;
		//for ( keyVar in PortalAdvMap.features ) {
			if (PortalAdvMap.features[feature].active == true) {
				currentFeature = feature;
				PortalAdvMap.gSearchForm.execute(PortalAdvMap.features[feature].name);
			}
		//}
	} else if (el.checked == false) {
		// Clear the map of icons
		PortalAdvMap.features[feature].active = false;
  		for (var i = 0; i < gCurrentResults[feature].length; i++) {
  		     PortalAdvMap.map.removeOverlay(gCurrentResults[feature][i].marker());
  		}		
	}
}

PortalAdvGoogleMap.prototype.updateFeatures = function() {

	this.featuresToReQuery = new Array;
	for ( keyVar in this.features ) {
		if (this.features[keyVar].active == true) {
			this.featuresToReQuery.push(keyVar);
		}
	}
	//alert(PortalAdvMap.featuresToReQuery.length + " features active");
	if (this.featuresToReQuery[0]) {
		this.gSearchForm.execute(this.featuresToReQuery[this.featuresToReQuery.length-1]);
	}

}

PortalAdvGoogleMap.prototype.hideMarkers = function(feature) {
	
}

// Cancel the form submission, executing an AJAX Search API search.
CaptureForm = function(searchForm) {
	gLocalSearch.execute(searchForm.input.value);
   return false;
}

// A class representing a single Local Search result returned by the
// Google AJAX Search API.
function LocalResult(result,feature) {
     this.result_ = result;
     PortalAdvMap.map.addOverlay(this.marker(getIcon(feature)));
}

// Returns the GMap marker for this result, creating it with the given
// icon if it has not already been created.
LocalResult.prototype.marker = function(opt_icon) {
     if (this.marker_) {
     	return this.marker_;
     }
     var marker = new GMarker(new GLatLng(parseFloat(this.result_.lat),
                                        parseFloat(this.result_.lng)),
                              opt_icon);
     this.marker_ = marker;
     return marker;
}

// "Saves" this result if it has not already been saved
LocalResult.prototype.select = function() {
	if (!this.selected()) {
       this.selected_ = true;

       // Remove the old marker and add the new marker
       //PortalAdvMap.map.removeOverlay(this.marker());
       this.marker_ = null;
       PortalAdvMap.map.addOverlay(this.marker(G_DEFAULT_ICON));

       // Add our result to the saved set
       document.getElementById("selected").appendChild(this.selectedHtml());
	}
}

// Returns true if this result is currently "saved"
LocalResult.prototype.selected = function() {
     return this.selected_;
}


function changeMapView(type) {
	switch(type) {
		case 'normal':
			PortalAdvMap.map.setMapType(G_NORMAL_MAP);
			if (document.getElementById('extra_info_container')) { document.getElementById('extra_info_container').style.display = 'none'; }
			document.getElementById('mapContainer').style.display = 'block';
			document.getElementById('tab_normal').className = 'PortalAdvMapViewTabs_tab_active';
			document.getElementById('tab_satellite').className = 'PortalAdvMapViewTabs_tab';
			document.getElementById('tab_hybrid').className = 'PortalAdvMapViewTabs_tab';
			if (document.getElementById('tab_brochure'))  		{ document.getElementById('tab_brochure').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_brochure'))  		{ document.getElementById('tab_floor_plan').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_brochure'))  		{ document.getElementById('tab_video').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_virtual_tour')) 	{ document.getElementById('tab_virtual_tour').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_area_video')) 		{ document.getElementById('tab_area_video').className = 'PortalAdvMapViewTabs_tab'; }
			break;
		case 'satellite':
			PortalAdvMap.map.setMapType(G_SATELLITE_MAP);
			if (document.getElementById('extra_info_container')) { document.getElementById('extra_info_container').style.display = 'none'; }
			document.getElementById('mapContainer').style.display = 'block';
			document.getElementById('tab_normal').className = 'PortalAdvMapViewTabs_tab';
			document.getElementById('tab_satellite').className = 'PortalAdvMapViewTabs_tab_active';
			document.getElementById('tab_hybrid').className = 'PortalAdvMapViewTabs_tab';
			if (document.getElementById('tab_brochure')) 		{ document.getElementById('tab_brochure').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_floor_plan')) 		{ document.getElementById('tab_floor_plan').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_video')) 			{ document.getElementById('tab_video').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_virtual_tour')) 	{ document.getElementById('tab_virtual_tour').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_area_video')) 		{ document.getElementById('tab_area_video').className = 'PortalAdvMapViewTabs_tab'; }
			break;
		case 'hybrid':
			PortalAdvMap.map.setMapType(G_HYBRID_MAP);
			if (document.getElementById('extra_info_container')) { document.getElementById('extra_info_container').style.display = 'none'; }
			document.getElementById('mapContainer').style.display = 'block';
			document.getElementById('tab_normal').className = 'PortalAdvMapViewTabs_tab';
			document.getElementById('tab_satellite').className = 'PortalAdvMapViewTabs_tab';
			document.getElementById('tab_hybrid').className = 'PortalAdvMapViewTabs_tab_active';
			if (document.getElementById('tab_brochure')) 		{ document.getElementById('tab_brochure').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_floor_plan'))		{ document.getElementById('tab_floor_plan').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_video'))			{ document.getElementById('tab_video').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_virtual_tour')) 	{ document.getElementById('tab_virtual_tour').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_area_video')) 		{ document.getElementById('tab_area_video').className = 'PortalAdvMapViewTabs_tab'; }
			break;
		case 'virtual_tour':
			if (document.getElementById('mapContainer')) 			{ document.getElementById('mapContainer').style.display = 'none'; }
			if (document.getElementById('tab_normal')) 				{ document.getElementById('tab_normal').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_satellite')) 			{ document.getElementById('tab_satellite').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_hybrid')) 				{ document.getElementById('tab_hybrid').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_brochure')) 			{ document.getElementById('tab_brochure').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_floor_plan')) 			{ document.getElementById('tab_floor_plan').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_video')) 				{ document.getElementById('tab_video').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_virtual_tour')) 		{ document.getElementById('tab_virtual_tour').className = 'PortalAdvMapViewTabs_tab_active'; }
			if (document.getElementById('tab_area_video')) 			{ document.getElementById('tab_area_video').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('extra_info_container')) 	{ document.getElementById('extra_info_container').style.display = 'block'; }
			break;
		case 'brochure':
			if (document.getElementById('mapContainer')) 			{ document.getElementById('mapContainer').style.display = 'none'; }
			if (document.getElementById('tab_normal')) 				{ document.getElementById('tab_normal').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_satellite')) 			{ document.getElementById('tab_satellite').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_hybrid')) 				{ document.getElementById('tab_hybrid').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_brochure')) 			{ document.getElementById('tab_brochure').className = 'PortalAdvMapViewTabs_tab_active'; }
			if (document.getElementById('tab_floor_plan')) 			{ document.getElementById('tab_floor_plan').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_video')) 				{ document.getElementById('tab_video').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_virtual_tour')) 		{ document.getElementById('tab_virtual_tour').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_area_video')) 			{ document.getElementById('tab_area_video').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('extra_info_container')) 	{ document.getElementById('extra_info_container').style.display = 'block'; }
			break;
		case 'floorplan':
			if (document.getElementById('mapContainer')) 			{ document.getElementById('mapContainer').style.display = 'none'; }
			if (document.getElementById('tab_normal')) 				{ document.getElementById('tab_normal').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_satellite')) 			{ document.getElementById('tab_satellite').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_hybrid')) 				{ document.getElementById('tab_hybrid').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_brochure')) 			{ document.getElementById('tab_brochure').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_floor_plan')) 			{ document.getElementById('tab_floor_plan').className = 'PortalAdvMapViewTabs_tab_active'; }
			if (document.getElementById('tab_video')) 				{ document.getElementById('tab_video').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_virtual_tour')) 		{ document.getElementById('tab_virtual_tour').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_area_video')) 			{ document.getElementById('tab_area_video').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('extra_info_container')) 	{ document.getElementById('extra_info_container').style.display = 'block'; }
			break;
		case 'video':
			if (document.getElementById('mapContainer')) 			{ document.getElementById('mapContainer').style.display = 'none'; }
			if (document.getElementById('tab_normal')) 				{ document.getElementById('tab_normal').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_satellite')) 			{ document.getElementById('tab_satellite').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_hybrid')) 				{ document.getElementById('tab_hybrid').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_brochure')) 			{ document.getElementById('tab_brochure').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_floor_plan')) 			{ document.getElementById('tab_floor_plan').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_video')) 				{ document.getElementById('tab_video').className = 'PortalAdvMapViewTabs_tab_active'; }
			if (document.getElementById('tab_virtual_tour')) 		{ document.getElementById('tab_virtual_tour').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_area_video')) 			{ document.getElementById('tab_area_video').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('extra_info_container')) 	{ document.getElementById('extra_info_container').style.display = 'block'; }
			break;
		case 'area_video':
			if (document.getElementById('mapContainer')) 			{ document.getElementById('mapContainer').style.display = 'none'; }
			if (document.getElementById('tab_normal')) 				{ document.getElementById('tab_normal').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_satellite')) 			{ document.getElementById('tab_satellite').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_hybrid')) 				{ document.getElementById('tab_hybrid').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_brochure')) 			{ document.getElementById('tab_brochure').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_floor_plan')) 			{ document.getElementById('tab_floor_plan').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_video')) 				{ document.getElementById('tab_video').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_virtual_tour')) 		{ document.getElementById('tab_virtual_tour').className = 'PortalAdvMapViewTabs_tab'; }
			if (document.getElementById('tab_area_video')) 			{ document.getElementById('tab_area_video').className = 'PortalAdvMapViewTabs_tab_active'; }
			if (document.getElementById('extra_info_container')) 	{ document.getElementById('extra_info_container').style.display = 'block'; }
			break;
		
	}
}

function removeFeatures() {
	if (document.getElementById('ls')) {
		if (document.getElementById('ls').checked == true) {
			document.getElementById('ls').checked = false;
			PortalAdvMap.features['school'].active = false;
			for (var i = 0; i < gCurrentResults['school'].length; i++) {
  				PortalAdvMap.map.removeOverlay(gCurrentResults['school'][i].marker());
  			}
  		}
  	}	
	if (document.getElementById('gs')) {
		if (document.getElementById('gs').checked == true) {
			document.getElementById('gs').checked = false;
			PortalAdvMap.features['grocery'].active = false;
			for (var i = 0; i < gCurrentResults['grocery'].length; i++) {
  				PortalAdvMap.map.removeOverlay(gCurrentResults['grocery'][i].marker());
  			}
  		}
	}
	if (document.getElementById('ps')) {
		if (document.getElementById('ps').checked == true) {
			document.getElementById('ps').checked = false;
			PortalAdvMap.features['park'].active = false;
			for (var i = 0; i < gCurrentResults['park'].length; i++) {
  				PortalAdvMap.map.removeOverlay(gCurrentResults['park'][i].marker());
  			}
  		}
	}
	if (document.getElementById('rs')) {
		if (document.getElementById('rs').checked == true) {
			document.getElementById('rs').checked = false;
			PortalAdvMap.features['restaurant'].active = false;
			for (var i = 0; i < gCurrentResults['restaurant'].length; i++) {
  				PortalAdvMap.map.removeOverlay(gCurrentResults['restaurant'][i].marker());
  			}
  		}
	}
	if (document.getElementById('gas')) {
		if (document.getElementById('gas').checked == true) {
			document.getElementById('gas').checked == false;
			PortalAdvMap.features['gas'].active = false;
			for (var i = 0; i < gCurrentResults['gas'].length; i++) {
  				PortalAdvMap.map.removeOverlay(gCurrentResults['gas'][i].marker());
  			}
  		}
	}
	if (document.getElementById('bs')) {
		if (document.getElementById('bs').checked == true) {
			document.getElementById('bs').checked = false;
			PortalAdvMap.features['bar'].active = false;
			for (var i = 0; i < gCurrentResults['bar'].length; i++) {
  				PortalAdvMap.map.removeOverlay(gCurrentResults['bar'][i].marker());
  			}
  		}
	}
	if (document.getElementById('hs')) {
		if (document.getElementById('hs').checked == true) {
			document.getElementById('hs').checked = false;
			PortalAdvMap.features['hospital'].active = false;
			for (var i = 0; i < gCurrentResults['hospital'].length; i++) {
  				PortalAdvMap.map.removeOverlay(gCurrentResults['hospital'][i].marker());
  			}
  		}
	}
	
}

// Map & Pano delcarations
	    var map;
	    var myPano;
	    var panoClient;
	    var currentLatLng = new GLatLng(DEFAULT_LAT,DEFAULT_LONG);
	    var currentYaw = 0;

   // Field of view marker and icon declarations
	    var fovMarker;
	    var fovIcon = new GIcon(G_DEFAULT_ICON);
	    var iconSize = 150;
	
   function initialize2(chosen) {
		panoClient = new GStreetviewClient();
		
		myPano = new GStreetviewPanorama(document.getElementById("pano"));
		myPano.setLocationAndPOV(currentLatLng, {yaw:currentYaw, pitch:-10});
			
		fovIcon.image = "http://www.copperpm.com/components/com_portaladv/helpers/fov_image.php?yaw=180";
		fovIcon.iconSize = new GSize(iconSize, iconSize);
		fovIcon.iconAnchor = new GPoint(iconSize/2, iconSize/2); //anchor in the middle
		fovIcon.shadow = null;
		fovMarker = new GMarker(currentLatLng, {icon: fovIcon, clickable: false})		
		GEvent.addListener(myPano, "initialized", handleInitialized);
		GEvent.addListener(myPano, "yawchanged", handleYawChange);
		
		return;
	}
	function handleInitialized(location) {
		currentLatLng = location.latlng;	
		placeFovMarker();			
		return;	
	}
	function handleYawChange(yaw){
		currentYaw = Math.round(yaw);
		placeFovMarker();
		return;
	}
	function placeFovMarker(){
		PortalAdvMap.map.removeOverlay(fovMarker);
		/* The following line really only needs to be in handleYawChange(), but doing so creates a flicker of the marker
		* when using Firefox.  It may have something to do with the lag between when the initialized event is triggered
		* and when the Street View image is actually finished loading. Although less than optimal, I've found that
		* reloading the image for each placement avoids the problem.
		*/
		fovIcon.image = "http://www.copperpm.com/components/com_portaladv/helpers/fov_image.php?yaw="+currentYaw+"&rand="+Math.random();	
		fovMarker = new GMarker(currentLatLng, {icon: fovIcon, clickable: false});
		PortalAdvMap.map.addOverlay(fovMarker);
		return;
	}
	function updateStreetView(lat,long) {
		var coords = new GLatLng(lat,long);
		panoClient.getNearestPanoramaLatLng(coords,showPanoData);
		if (myPano) {
			myPano.setLocationAndPOV(coords, {yaw:currentYaw, pitch:-10});
		}
	}
	function updateStreetViewFromGLatLng(glatlng) {
		
		if (myPano) {
			myPano.setLocationAndPOV(glatlng, {yaw:currentYaw, pitch:-10});
		}
	}
	function showPanoData(panoData) {
		var displayString = "Panorama ID: " + panoData.location.panoId + "   LatLng: " + panoData.location.latlng;
alert(displayString);
	}