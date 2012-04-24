
<head>
<style type="text/css">
.auto-style1 {
	font-size: small;
}
</style>
</head>

<?php defined('_JEXEC') or die('Restricted access'); ?>

<div class="componentheading">
<? echo GENERAL_CONTACT_FORM_TITLE; ?>
</div>

<form action="/components/com_portaladv/helpers/contact.php" method="post" name="details_contact_form" id="details_contact_form">
<table>
	<tr>
		<td colspan="2">
			<?
			if ($_GET['referrer']) {
				switch($_GET['referrer']) {
					case 'buildingdetails':
						$introtext = 'Request Information on ' . $_GET['subject'];
						break;
					case 'messagesent':
						$introtext = CONTACT_US_THANK_YOU_TEXT;
						break;
				}
				
				echo "<h2>$introtext</h2>";
			}
			?>
		</td>
	</tr>
	<? if ($_GET['referrer'] != 'messagesent') { ?>
	<tr>
		<td colspan="2">
			<? echo GENERAL_CONTACT_US_TEXT; ?>
			<br /><br />
		</td>
	</tr>
	<tr>
		<td>
			<img src="components/com_portaladv/images/<?=GENERAL_CONTACT_FORM_IMAGE?>" alt="<?=SITE_TITLE?>" />
		</td>
		<td>
			<table class="general_contact_table">
				
				<tr>
					<td>Name:<br /><input type="text" name="name" id="details_contact_name" class="details_text_fields"></td>
				</tr>
				<tr>
					<td>Email:<br /><input type="text" name="email" id="details_contact_email" class="details_text_fields"></td>
				</tr>
				<tr>
					<td>Phone:<br /><input type="text" name="phone" id="details_contact_phone" class="details_text_fields"></td>
				</tr>
				<tr>
					<td>Subject:<br /><input type="text" name="subject" id="details_contact_subject" class="details_text_fields" value="<? echo $_GET['subject'] ? $_GET['subject'] : ''; ?>"></td>
				</tr>
				<tr>
					<td>Message:<br /><textarea name="message" id="details_contact_message" class="details_text_fields"></textarea></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" onclick="submitContact(this.form); return false;" name="submit" class="send_message" value="Send Message"></td>
				</tr>	
			</table>
		</td>
	</tr>
	<? } ?>
</table>
<input type="hidden" name="referrer" value="<?php echo $_GET['referrer'];?>" >
<input type="hidden" name="property_id" value="<?php echo $_GET['listing'];?>" >
<input type="hidden" name="building" value="<?php echo $_GET['subject'];?>" >
<input type="hidden" name="Itemid" value="<?php echo $_GET['Itemid'];?>" >
<input type="hidden" name="mls_num" value="<?php echo $this->details->{FIELDNAME_RESIDENTIAL_LISTING_NUM}; ?>" >
</form>

<hr>
<p class="auto-style1"><strong>Our Office is located at the Highlands Lodge in Beaver Creek, Colorado</strong></p>
<iframe marginheight="0" marginwidth="0" src="http://maps.google.com/maps/ms?hl=en&amp;gl=us&amp;ie=UTF8&amp;oe=UTF8&amp;msa=0&amp;msid=117602114396128343118.00045b51cbfe696985c33&amp;t=h&amp;s=AARTsJpz3uczo-3sGFo-uQiHToE6P43hiQ&amp;ll=39.604349,-106.512314&amp;spn=0.001447,0.003219&amp;z=18&amp;output=embed" frameborder="0" height="350" scrolling="no" width="600"></iframe><br /><small><a href="http://maps.google.com/maps/ms?hl=en&amp;gl=us&amp;ie=UTF8&amp;oe=UTF8&amp;msa=0&amp;msid=117602114396128343118.00045b51cbfe696985c33&amp;t=h&amp;ll=39.604349,-106.512314&amp;spn=0.001447,0.003219&amp;z=18&amp;source=embed" style="color:#0000FF;text-align:left">View Larger Map</a></small>
<p><strong>Beaver Creek - Highlands</strong><br /> 15 Highlands Lane<br /> P.O. Drawer 2820<br /> Beaver Creek, CO 81620<br /> Phone: (970)845-8053<br /> Fax: (970)845-7118</p>
<p>Email: <a href="mailto:dmchugh@slifer.net">dmchugh@slifer.net</a> </p>
<br />