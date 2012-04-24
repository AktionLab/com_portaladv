<?php defined('_JEXEC') or die('Restricted access'); ?>


	<div class="details_contact_header">Contact Us</div>



<div class="clear"></div>

<script type="text/javascript">
function validateFormOnSubmit(theForm) {
var reason = "";

  reason += validateEmail(theForm.email);
  reason += validatePhone(theForm.phone);
  reason += validateEmpty(theForm.name);

  if (reason != "") {
    alert("Some fields need correction:\n" + reason);
    return 0;
  }

  return 1;
}

function validateEmpty(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        fld.style.background = '#FFFA73'; 
        error = "You didn't enter your name.\n"
    } else {
        fld.style.background = '#F7F5F5';
    }
    return error;  
}

function trim(s)
{
  return s.replace(/^\s+|\s+$/, '');
}

function validateEmail(fld) {
    var error="";
    var tfld = trim(fld.value);                        // value of field with whitespace trimmed off
    var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ;
    var illegalChars= /[\(\)\<\>\,\;\:\\\"\[\]]/ ;
   
    if (fld.value == "") {
        fld.style.background = '#FFFA73';
        error = "You didn't enter an email address.\n";
    } else if (!emailFilter.test(tfld)) {              //test email for illegal characters
        fld.style.background = '#FFFA73';
        error = "Please enter a valid email address.\n";
    } else if (fld.value.match(illegalChars)) {
        fld.style.background = '#FFFA73';
        error = "The email address contains illegal characters.\n";
    } else {
        fld.style.background = '#F7F5F5';
    }
    return error;
}

function validatePhone(fld) {
    var error = "";
    var stripped = fld.value.replace(/[\(\)\.\-\ ]/g, '');    

   if (fld.value == "") {
        error = "You didn't enter a phone number.\n";
        fld.style.background = '#FFFA73';
    } else if (isNaN(parseInt(stripped))) {
        error = "The phone number contains illegal characters.\n";
        fld.style.background = '#FFFA73';
    } else if (!(stripped.length >= 10)) {
        error = "The phone number is the wrong length. Make sure you included an area code.\n";
        fld.style.background = '#FFFA73';
    }
    return error;
}

function submitContact(theForm) {
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
			//alert(xmlHttp.responseText);
			document.getElementById('details_form_div').style.display="none";
			document.getElementById('details_form_thanks').style.display="block";	
			//alert(xmlHttp.responseText);	
		}
	}
	
	vars = '';
	var theForm = document.details_contact_form;
	var counter = 0;
	for(i=0;i<theForm.elements.length;i++) {
		var el = theForm.elements[i];
		var name = el.name;
		vars += '&' + name + '=' + el.value;
	}
	
	var script = "/components/com_portaladv/helpers/contact.php?";
	script += vars;
	//alert(script);
	var	valid = validateFormOnSubmit(theForm);
	if (valid == 1) {
	xmlHttp.open("get",script,true);
	xmlHttp.send(null);
	}
}

function validateForm() {

}

</script>
<div id="details_form_div">
<form action="/components/com_portaladv/helpers/contact.php" method="post" name="details_contact_form" id="details_contact_form">
<input type="hidden" name="referrer" value="propertydetails" />
<table class="details_contact_table">
	<tr>
		<td>
			<? echo CONTACT_US_TEXT; ?>
		</td>
	</tr>
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
		<td>Message:<br /><textarea name="message" id="details_contact_message" class="details_text_fields"></textarea></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" onclick="submitContact(this.form); return false;" name="submit" class="send_message" value="Send Message"></td>
	</tr>	
</table>
<input type="hidden" name="property_id" value="<?php echo $_GET['listing'];?>" >
<input type="hidden" name="mls_num" value="<?php echo $this->details->{FIELDNAME_RESIDENTIAL_LISTING_NUM}; ?>" >
</form>
</div>
<div class="details_form_thanks" id="details_form_thanks">
<? echo CONTACT_US_THANK_YOU_TEXT; ?>
</div>