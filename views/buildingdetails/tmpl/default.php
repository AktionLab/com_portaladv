
<?php defined('_JEXEC') or die('Restricted access'); ?>
<style type="text/css">
.auto-style1 {
	text-align: right;
}
.auto-style2 {
	font-size: small;
}
</style>

<div class="details_main_container">
	<div class="details_address_mls">
		<div class="details_address">
			<h1 style="margin-top: 0; margin-bottom: 0"><? echo ucwords(strtolower($this->details->title)); ?></h1>
		</div>
	</div>	
	<div class="details_info" width="400"><span style="float:left"><input type="button" class="portaladv_button" onmouseover="this.className='portaladv_button_hover';" onmouseout="this.className='portaladv_button';" onclick="history.go(-1);" value="<? echo BUTTON_BACK_TO_SEARCH_RESULTS; ?>"></input></span>
	<span style="float:right"><input type="button" class="portaladv_button" onmouseover="this.className='portaladv_button_hover';" onmouseout="this.className='portaladv_button';" onclick="window.external.AddFavorite(location.href, document.title);" value="<? echo BUTTON_ADD_TO_BOOKMARK; ?>"></input></span></div>
	<div class="clear"><!-- --></div>
	
	<div class="building_info_container">
		<div class="building_info">
			<div class="building_description">
				<p style="margin-top: 0; margin-bottom: 0">
				<? if ($this->details->catchphrase != '') { ?>
				<span class="building_catchphrase_text"><? echo $this->details->catchphrase; ?></span><br /><br />
				<? } ?>
				<span class="building_description_text"><? echo $this->details->description; ?></span>
			</div>
			<?php  //echo $this->loadTemplate('details'); ?>
			<? if ($this->details->properties_available > 0) { ?>
			<div class="building_available">
				<p style="margin-top: 0; margin-bottom: 0"><? echo $this->details->properties_available; ?>
			<?php echo $this->details->properties_available == 1 ? 'Property' : 'Properties'; ?> Available for Sale</p>
				<p style="margin-top: 0; margin-bottom: 0">&nbsp;</div>

			<form name="view_available" method="get" action="/index.php?option=com_portaladv&task=search" style="margin:0px;padding:0px;">
				<p style="margin-top: 0; margin-bottom: 0">
				<input class="button_large_green" type="button" value="View Available Properties for Sale" onclick="this.form.submit();" onmouseover="this.className='button_large_green_hover';" onmouseout="this.className='button_large_green';" />
				<input type="hidden" name="option" value="com_portaladv" />
				<input type="hidden" name="task" value="search" />
				<input type="hidden" name="Itemid" value="<?=$_GET['Itemid']?>" />
				<input type="hidden" name="area[]" value="0" />
				<input type="hidden" name="city" value="" />
				<input type="hidden" name="subdivision" value="<? echo $this->details->searchstring; ?>" />
				<input type="hidden" name="price_min" value="0" />
				<input type="hidden" name="price_max" value="0" />
				<input type="hidden" name="prop_type[]" value="0" />
				<input type="hidden" name="num_bedrooms[]" value="0" />
				<input type="hidden" name="num_bathrooms[]" value="0" />
				<input type="hidden" name="squarefeet_min" value="0" />
				<input type="hidden" name="squarefeet_max" value="0" />
				<input type="hidden" name="keyword" value="" />
				<input type="hidden" name="lat_min" value="0" />
				<input type="hidden" name="lat_max" value="0" />
				<input type="hidden" name="lng_min" value="0" /> 
				<input type="hidden" name="lng_min" value="0" /> 
				<input type="hidden" name="task" value="search" />
				<input type="hidden" name="limit" value="10" />
				<input type="hidden" name="task" value="search" />
				<input type="hidden" name="search_type" value="filter" />
			
				</p>
			
			</form>
			<? } else { ?>
			<span class="building_catchphrase_text">Currently there are no properties for sale.</span>
			<? } ?>
			<p style="margin-top: 0; margin-bottom: 0">&nbsp
			
				</p>
			
				<form name="view_new_listings" method="get" action="/index.php" style="margin:0px;padding:0px;">
				<input type="hidden" name="option" value="com_portaladv" />
				<input type="hidden" name="task" value="getrecentsales" />
				<input type="hidden" name="referrer" value="buildingdetails" />
				<input type="hidden" name="Itemid" value="133" />
				<input type="hidden" name="subject" value="<?=ucwords(strtolower($this->details->title))?> - Please email new listings when available." />
				<p style="margin-top: 0; margin-bottom: 0">
				<input class="button_large_green" type="button" value="Notify Me When New Properties are Listed for Sale" onclick="this.form.submit();" onmouseover="this.className='button_large_green_hover';" onmouseout="this.className='button_large_green';" />
				</p>
			</form>
			
			<p style="margin-top: 0; margin-bottom: 0">
			
			</form>&nbsp;</p>
			<form name="view_recent_sales" method="get" action="/index.php" style="margin:0px;padding:0px;">
				<input type="hidden" name="option" value="com_portaladv" />
				<input type="hidden" name="task" value="getrecentsales" />
				<input type="hidden" name="referrer" value="buildingdetails" />
				<input type="hidden" name="Itemid" value="133" />
				<input type="hidden" name="subject" value="<?=ucwords(strtolower($this->details->title))?> - Please email Recent Sales and Additional Information." />
				<p style="margin-top: 0; margin-bottom: 0">
				<input class="button_large_green" type="button" value="Request Recent Sales and Additional Information" onclick="this.form.submit();" onmouseover="this.className='button_large_green_hover';" onmouseout="this.className='button_large_green';" /></p>
			</form>
			<br />			
			
		</div>
	</div>

	<div class="building_showcase">
	<?
		$db = mysql_connect("mountainestates.com", "beaver", "C4yHksfv");
		mysql_select_db("mountainestates",$db);
		
		$sql = "SELECT 
      	enhancedShowcaseID, 
      	enhancedShowcaseDescription, 
      	mlsDescription, 
      	enhancedShowcaseMemberID,
      	mlsNumber,
		Address
      	FROM enhancedShowcase 
      	WHERE enhancedShowcaseID = '".$row->showcaseid."'
      	";
      	$result = mysql_query($sql);
      	$myrow = mysql_fetch_row($result);
                       

      	$description = "<table width=\"500\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
      			<tr>
      				<td width=\"500\">
      					<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      						<tr>
      							<td width=\"500\"><table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\"><tr><td align=\"left\" class=\"tinyest\">Information provided herein is deemed reliable but is not guaranteed and is subject to change at any time.<br><br>All information should be independently verified. The contents of this website shall in no way be construed as an offer to sell.</td></tr></table></td>
      						</tr>
      					</table>
      				</td>
      			</tr>
      		</table>
      		<br><br>";

      
        $userid = "";
        $cookie = "";
        $client = "";
        $referer = "";
        $desiredid = "interactiveproperties";
        
        $client = $_SERVER['REMOTE_ADDR'];
        if (!$_COOKIE[interactiveproperties]) {
        $time = time();
        $sessionid = $client."_".$time;
        $expires = $time + 60*60*24*365;
        setcookie("interactiveproperties", $sessionid, $expires, "/");
        $userid = $sessionid;
        } else {
        $userid = $_COOKIE[interactiveproperties];
        }
        $referer = "search";
        $sqlTrack = "INSERT INTO showcaseStats
        (id,referer,client,cookie,showcaseid)
        VALUES
        ('','$referer','$client','$userid','".$row->showcaseid."')";
        $resultTrack = mysql_query($sqlTrack);
		
?>

<? 
$time = time();
?>

<div id="showcase_<?=$time?>">
	<p style="margin-top: 0; margin-bottom: 0"></div>
		<div class="auto-style1">
<?
$result = mysql_query("SELECT * FROM `enhancedShowcase` WHERE `enhancedShowcaseID`=" . $this->details->showcaseid);
$d = mysql_fetch_assoc($result);
$street = $d['Address'];
$zip   = '81620';
//$city = zip2City($zip);
$state  = 'Colorado';
if ($_GET['Mls_Num']) {
	$_GET['Mls_Num'] = $d['mlsNumber'];
}
$mlsNumber = $d['mlsNumber'];

$room = "showcaseid=".$this->details->showcaseid."&uniqueLoad=".time();

$thisShowcaseID = $this->details->showcaseid;

$_GET['showcaseID'] = $this->details->showcaseid;
$t=time();
?>

<? //include("components/com_portaladv/includes/showcase/swfobject.php"); embedswf("components/com_portaladv/includes/showcase/showcase.swf?".$room, 540, 450); ?>
	
<iframe frameborder="0" marginheight="0" marginwidth="0" scrolling="no" src="http://www.interactiveproperties.com/McHughPlayer/index.php?enhancedShowcaseID=<?php echo $thisShowcaseID; ?>&t=<?php echo $t;?>" width="540" height="450">
Your browser does not support inline frames.
</iframe>

			<br><span class="auto-style2"><strong>To view a SLIDESHOW of <? echo ucwords(strtolower($this->details->title)); ?> click the icon 
			</strong></span><strong>
			<img alt="Slideshow" height="36" longdesc="Slideshow" src="http://www.beavercreekonline.com/slide_icon.png" width="40" class="auto-style2"></strong><span class="auto-style2"><strong>&nbsp; 
			above.</strong></span> </div>

</div>


	<div class="clear">
		<p style="margin-top: 0; margin-bottom: 0"></div>
	
	<?php
	if ($this->details->latitude != '') {
		echo $this->loadTemplate('map');
	}
	?>
	
	<form name="building_inquiry" style="padding:0px;margin:0px;" action="/components/com_portaladv/helpers/contact.php" method="post">
	<input type="hidden" name="option" value="com_portaladv" />
	<input type="hidden" name="view" value="buildingdetails" />
	<input type="hidden" name="task" value="view" />
	<input type="hidden" name="Itemid" value="<?=$_GET['Itemid']?>" />
	<input type="hidden" name="referrer" value="rentalinquiry" />
	<input type="hidden" name="rentalManagerEmail" value="<?=$this->details->rentalManagerEmail?>" />
	<input type="hidden" name="buildingid" value="<?=$_GET['id']?>" />
	<a name="building_rental"></a>
	<div id="building_rental_form" class="building_rental_form">
		<div id="building_rental_form_header" class="building_rental_form_header">
			<p style="margin-top: 0; margin-bottom: 0">Rental Request Form</div>
			<table cellpadding="6">
				<tr>
					<td style="padding:10px;">
						<p style="margin-top: 0; margin-bottom: 0">
						<span class="details">To request information on rental availability, please fill out the form below. We will contact you as soon as possible. Thank you!</span>
					</td>
				</tr>
				<tr>
					<p style="margin-top: 0; margin-bottom: 0">
					</p>
					<td>
					<div>
					<table cellpadding="4" width="100%">
						<tr>
							<td width="50%">
								<p style="margin-top: 0; margin-bottom: 0">
								<span style="font-weight: bold;"> First name: </span>
                    			<br>
                    			<input name="firstname" id="contact_firstname" style="width:98%;" class="inputbox" value="" type="text">
							</td>
							<td colspan="2">
							 	<p style="margin-top: 0; margin-bottom: 0">
							 	<span style="font-weight: bold;"> Last name: </span>
                    			<br>
								<input name="lastname" id="contact_lastname" style="width:98%;" class="inputbox" value="" type="text">
							</td>
						</tr>

						<tr>
							<td colspan="3">
								<p style="margin-top: 0; margin-bottom: 0">
								<span style="font-weight: bold;"> Address: </span>
                    			<br>
                    			<input name="address" id="contact_address" style="width:99%;" class="inputbox" value="" type="text">
                    		</td>
                    	</tr>

						<tr>
                    		<td>
                    			<p style="margin-top: 0; margin-bottom: 0">
                    			<span style="font-weight: bold;"> City: </span>
                    			<br>
                    			<input name="city" id="contact_city" style="width:98%;" class="inputbox" value="" type="text">
                    		</td>
                    		<td>
                    			<p style="margin-top: 0; margin-bottom: 0">
                    			<span style="font-weight: bold;"> State: </span>
                    			<br>
                    			<input name="state" id="contact_state" style="width:97%;" class="inputbox" value="" type="text">
                    		</td>
                    		<td>
                    			<p style="margin-top: 0; margin-bottom: 0">
                    			<span style="font-weight: bold;"> Zip: </span>
                    			<br>
                    			<input name="zip" id="contact_state" style="width:97%;" class="inputbox" value="" type="text">
                    		</td>
                    	</tr>

						<tr>
                    		<td>
                    			<p style="margin-top: 0; margin-bottom: 0">
                    			<span style="font-weight: bold;"> Phone: </span>
                    			<br>
                    			<input name="phone" id="contact_phone" style="width:98%;" class="inputbox" value="" type="text">
                    		</td>
                    		<td colspan="2">
                    			<p style="margin-top: 0; margin-bottom: 0">
                    			<span style="font-weight: bold;"> Email: </span>
                    			<br>
                    			<input name="email" id="contact_email" style="width:98%;" class="inputbox" value="" type="text">
                    		</td>
                    	</tr>

						<tr>
                    		<td>
                    			<p style="margin-top: 0; margin-bottom: 0">
                    			<span style="font-weight: bold;"> # of Adults: </span>
                    			<br>
                    			<select name="adults" id="contact_adults" style="width:100%;">
                    				<option value="1">1</option>
                    				<option value="2">2</option>
                    				<option value="3">3</option>
                    				<option value="4">4</option>
                    				<option value="5">5</option>
                    				<option value="6">6</option>
                    				<option value="7">7</option>
                    				<option value="8">8</option>
                    				<option value="9">9</option>
                    				<option value="10+">10+</option>
                    			</select>
                    		</td>
                    		<td colspan="2">
                    			<p style="margin-top: 0; margin-bottom: 0">
                    			<span style="font-weight: bold;"> # of Children: </span>
                    			<br>
                    			<select name="children" id="contact_children" style="width:100%;">
                    				<option value="1">1</option>
                    				<option value="2">2</option>
                    				<option value="3">3</option>
                    				<option value="4">4</option>
                    				<option value="5">5</option>
                    				<option value="6">6</option>
                    				<option value="7">7</option>
                    				<option value="8">8</option>
                    				<option value="9">9</option>
                    				<option value="10+">10+</option>
                    			</select>
                    		</td>
                    	</tr>
						<tr>
                    		<td>
                    			<p style="margin-top: 0; margin-bottom: 0">
                    			<span style="font-weight: bold;"> Check in Date: </span>
                    			<br>
                    			<input name="checkin" id="contact_checkin" style="width:98%;" class="inputbox" value="" type="text" onfocus="showCalendar('',this,this,'','holder1',0,30,1);">
                    		</td>
                    		<td colspan="2">
                    			<p style="margin-top: 0; margin-bottom: 0">
                    			<span style="font-weight: bold;"> Check out Date: </span>
                    			<br>
                    			<input name="checkout" id="contact_checkout" style="width:98%;" class="inputbox" value="" type="text" onfocus="showCalendar('',this,this,'','holder2',0,30,1);">
                    		</td>
                    	</tr>

						<tr>
                    		<td colspan="3">
                    			<p style="margin-top: 0; margin-bottom: 0">
                    			<span style="font-weight: bold;"> Additional Information or Special Requests that you would like to provide our rental agents: </span>
                    			<br>
                    			<textarea cols="54" rows="10" name="info" id="contact_info" style="width:100%;" class="inputbox"></textarea>
                    			<br>
                    			<br>
                    			<input name="send" value="Submit Rental Request" class="send_message" type="submit">
                    		</td>
                    	</tr>
                    </table>
                 </div>

                  <input name="building" value="<?php echo ucwords(strtolower($this->details->title)); ?>" type="hidden">
                  
					</td>
				</tr>
			</table>
	</div>
	</form>
	
	<div class="building_amenities">
		<div class="building_amenities_header">
			<p style="margin-top: 0; margin-bottom: 0">Building Amenities</div>
		<div class="building_amenities_left">
			<div style="padding:10px;">
			<?
			$listingAr = array();
			if ($this->details->skiin == 1) $listingAr[] = "\n<tr><td class=\"amenities_img\"><img src=\"components/com_portaladv/images/icons/i-skiin.jpg\"></td><td><p>Ski-In</td></tr>";
			if ($this->details->skiout == 1) $listingAr[] = "\n<tr><td class=\"amenities_img\"><img src=\"components/com_portaladv/images/icons/i-skiout.jpg\"></td><td><p>Ski-Out</td></tr>";
			if ($this->details->frontdesk == 1) $listingAr[] = "\n<tr><td class=\"amenities_img\"><img src=\"components/com_portaladv/images/icons/i-frontdesk.jpg\"></td><td><p>Front Desk</td></tr>";
			if ($this->details->exercise == 1) $listingAr[] = "\n<tr><td class=\"amenities_img\"><img src=\"components/com_portaladv/images/icons/i-gym.jpg\"></td><td><p>Exercise Facilities</td></tr>";
			if ($this->details->skilockers == 1) $listingAr[] = "\n<tr><td class=\"amenities_img\"><img src=\"components/com_portaladv/images/icons/i-locker.jpg\"></td><td><p>Ski Lockers</td></tr>";
			if ($this->details->pool == 1) $listingAr[] = "\n<tr><td class=\"amenities_img\"><img src=\"components/com_portaladv/images/icons/i-pool.jpg\"></td><td><p>Pool</td></tr>";
			if ($this->details->hottub == 1) $listingAr[] = "\n<tr><td class=\"amenities_img\"><img src=\"components/com_portaladv/images/icons/i-hottub.jpg\"></td><td><p>Hot Tub</td></tr>";
			if ($this->details->busroute == 1) $listingAr[] = "\n<tr><td class=\"amenities_img\"><img src=\"components/com_portaladv/images/icons/i-bus.jpg\"></td><td><p>On Bus Route</td></tr>";
			
			if (count($listingAr) > 0) {
				echo "<table>\n";
				foreach($listingAr as $am) {
					echo $am;
				}
				echo "</table>";
			}
			?>
			</div>
		</div>	
		<div class="building_amenities_right">
			<div style="padding:10px;">
			<?
			$listingAr = array();
			if ($this->details->garage == 1) $listingAr[] = "\n<tr><td class=\"amenities_img\"><img src=\"components/com_portaladv/images/icons/i-garage.jpg\"></td><td><p>Garage</td></tr>";
			if ($this->details->Spa == 1) $listingAr[] = "\n<tr><td class=\"amenities_img\"><img src=\"components/com_portaladv/images/icons/i-spa.jpg\"></td><td><p>Spa</td></tr>";
			if ($this->details->Hiking_Accessible == 1) $listingAr[] = "\n<tr><td class=\"amenities_img\"><img src=\"components/com_portaladv/images/icons/i-hike.jpg\"></td><td><p>Hiking Accessible</td></tr>";
			if ($this->details->Restaurant == 1) $listingAr[] = "\n<tr><td class=\"amenities_img\"><img src=\"components/com_portaladv/images/icons/i-food.jpg\"></td><td><p>Restaurant(s)</td></tr>";
			if ($this->details->Vaulted_Ceilings == 1) $listingAr[] = "\n<tr><td class=\"amenities_img\"><img src=\"components/com_portaladv/images/icons/i-vaulted.jpg\"></td><td><p>Vaulted Ceilings</td></tr>";
			if ($this->details->Concierge == 1) $listingAr[] = "\n<tr><td class=\"amenities_img\"><img src=\"components/com_portaladv/images/icons/i-concierge.jpg\"></td><td><p>Concierge</td></tr>";
			if ($this->details->In_Village == 1) $listingAr[] = "\n<tr><td class=\"amenities_img\"><img src=\"components/com_portaladv/images/icons/i-village.jpg\"></td><td><p>In the village</td></tr>";
			if ($this->details->Walk_to_Village == 1) $listingAr[] = "\n<tr><td class=\"amenities_img\"><img src=\"components/com_portaladv/images/icons/i-walk.jpg\"></td><td><p>Walk to the Village</td></tr>";
			
			if (count($listingAr) > 0) {
				echo "<table>\n";
				foreach($listingAr as $am) {
					echo $am;
				}
				echo "</table>";
			}
			?>
			</div>
		</div>
		<div class="clear"><!-- --></div>
		<div style="width:85%;margin:auto;">
		<?php
		$module = &JModuleHelper::getModule('custom','Your Team');
    	$html = JModuleHelper::renderModule($module);
    	echo $html;
		?>
		</div>
	</div>
	

	
	<div class="clear"><!-- --></div>
	
</div>

<?php if($_GET['message'] == 'sent') { ?>
<script type="text/javascript">
function alertMessage() {
	Sexy.alert('Thank you for your email to us here at Beaver Creek Online.<br /><br />We have received your email and we will get back to you within 24 business hours.');
}

window.setTimeout(alertMessage,5000);
</script>
<head>
		 <meta http-equiv="CACHE-CONTROL" content="NO-CACHE"/>
   		<meta http-equiv="PRAGMA" content="NO-CACHE"/>
</head>

<?php } ?>