<?php
//include constants
include("../constants.php");

if ($_POST['referrer'] == 'buildingdetails') {
	//Build message
	$pre = "<html><body><strong>Building Inquiry:</strong> " . $_POST['building'] . "<br/><br/>";
	$name = "Name: ".$_POST['name']."<br/><br/>"; 
	$email = "Email: ".$_POST['email']."<br/><br/>"; 
	$phone = "Phone: ".$_POST['phone']."<br/><br/>"; 
	$message = "Message: ".$_POST['message']."</body></html>";
	$email_message 	= $pre;
	$email_message .= "Subject: " . $_POST['subject'] . "<br /><br />";
	$email_message .= $name;
	$email_message .= $email;
	$email_message .= $phone;
	$email_message .= $message;
	
	$subject = "Building Inquiry: " . $_POST['building'];
	
	$headers  = 'From: ' . CONTACT_US_BROKER_EMAIL_FROM . "\r\n";
	$headers .= 'Content-Type: text/html; charset=iso-8859-1' . "\r\n";
	
	mail(CONTACT_US_EMAIL, $subject, $email_message, $headers);

	header('Location:/index.php?option=com_portaladv&task=getrecentsales&referrer=messagesent&Itemid=' . $_POST['Itemid']);
}

if ($_POST['referrer'] == 'rentalinquiry') {
	//Build message
	$pre = "<html><body style=\"font-family:arial;color:#222222;\"><table width=\"600\" style=\"font-size:14px;background:#DEECF7;border:1px solid #052204;border-bottom:4px solid #052204;\" cellpadding=\"0\" cellspacing=\"0\"><tr><td colspan=\"2\"><img src=\"http://" . SITE_DOMAIN . "/components/com_portaladv/images/email_header.jpg\" /></td></tr><tr><td align=\"center\" colspan=\"2\"><h1>Rental Inquiry</h1><h3>" . $_POST['building'] . "</h3><hr style=\"width:90%;height:1px;\" /></td></tr>";
	$name = "<tr><td width=\"50%\" style=\"padding-left:50px;\"><strong>Name</strong><br />".$_POST['firstname']." " . $_POST['lastname'] . "</td>"; 
	$email = "<td><strong>Email</strong><br />".$_POST['email']."</td></tr><tr><td colspan=\"2\"><br /></td></tr>"; 
	$phone = "<tr><td style=\"padding-left:50px;\"><strong>Phone</strong><br />".$_POST['phone']."</td>";
	$address = "<td><strong>Address</strong><br />".$_POST['address']." " . $_POST['city'] . ", " . $_POST['state'] . " " . $_POST['zip'] . "</td></tr><tr><td colspan=\"2\"><br /></td></tr>";
	$adults = "<tr><td style=\"padding-left:50px;\"><strong># Adults</strong><br />" . $_POST['adults'] . "</td>";
	$children = "<td><strong># Children</strong><br />" . $_POST['children'] . "</td></tr><tr><td colspan=\"2\"><br /></td></tr>";
	$checkindate = "<tr><td style=\"padding-left:50px;\"><strong>Check In Date</strong><br />" . $_POST['checkin'] . "</td>";
	$checkoutdate = "<td><strong>Check Out Date</strong><br />" . $_POST['checkout'] . "</td></tr><tr><td colspan=\"2\"><br /></td></tr>";
	$message = "<tr><td colspan=\"2\" style=\"padding-left:50px;\"><strong>Additional Info</strong><br />".$_POST['info']."</td></tr><tr><td style=\"border-bottom:5px solid #052204;\" colspan=\"2\"><hr style=\"width:90%\" /><br /></td></tr></table></body></html>";
	$email_message 	= $pre;
	$email_message .= $name;
	$email_message .= $email;
	$email_message .= $phone;
	$email_message .= $address;
	$email_message .= $adults;
	$email_message .= $children;
	$email_message .= $checkindate;
	$email_message .= $checkoutdate;
	$email_message .= $message;
	
	$subject = "Rental Inquiry: " . $_POST['building'];
	
	$headers  = 'From: ' . CONTACT_US_BROKER_EMAIL_FROM . "\r\n";
	$headers .= 'Content-Type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'Cc: ' . $_POST['rentalManagerEmail'] . "\r\n";

	mail(CONTACT_US_EMAIL, $subject, $email_message, $headers);
	
	//Build client message
	$pre = "<html><body style=\"font-family:arial;color:#222222;\"><table width=\"600\" style=\"font-size:14px;background:#DEECF7;border:1px solid #052204;border-bottom:4px solid #052204;\" cellpadding=\"0\" cellspacing=\"0\"><tr><td colspan=\"2\"><img src=\"http://" . SITE_DOMAIN . "/components/com_portaladv/images/email_header.jpg\" /></td></tr><tr><td align=\"center\" colspan=\"2\"><h2>Thank you for your Rental Inquiry</h2><h3>" . $_POST['building'] . "</h3><hr style=\"width:90%;height:1px;\" /></td></tr>";
	$name = "<tr><td width=\"50%\" style=\"padding-left:50px;\"><strong>Name</strong><br />".$_POST['firstname']." " . $_POST['lastname'] . "</td>"; 
	$email = "<td><strong>Email</strong><br />".$_POST['email']."</td></tr><tr><td colspan=\"2\"><br /></td></tr>"; 
	$phone = "<tr><td style=\"padding-left:50px;\"><strong>Phone</strong><br />".$_POST['phone']."</td>";
	$address = "<td><strong>Address</strong><br />".$_POST['address']." " . $_POST['city'] . ", " . $_POST['state'] . " " . $_POST['zip'] . "</td></tr><tr><td colspan=\"2\"><br /></td></tr>";
	$adults = "<tr><td style=\"padding-left:50px;\"><strong># Adults</strong><br />" . $_POST['adults'] . "</td>";
	$children = "<td><strong># Children</strong><br />" . $_POST['children'] . "</td></tr><tr><td colspan=\"2\"><br /></td></tr>";
	$checkindate = "<tr><td style=\"padding-left:50px;\"><strong>Check In Date</strong><br />" . $_POST['checkin'] . "</td>";
	$checkoutdate = "<td><strong>Check Out Date</strong><br />" . $_POST['checkout'] . "</td></tr><tr><td colspan=\"2\"><br /></td></tr>";
	$message = "<tr><td colspan=\"2\" style=\"padding-left:50px;\"><strong>Additional Info</strong><br />".$_POST['info']."</td></tr><tr><td style=\"border-bottom:5px solid #052204;\" colspan=\"2\"><hr style=\"width:90%\" /><br /></td></tr></table></body></html>";
	$email_message 	= $pre;
	$email_message .= $name;
	$email_message .= $email;
	$email_message .= $phone;
	$email_message .= $address;
	$email_message .= $adults;
	$email_message .= $children;
	$email_message .= $checkindate;
	$email_message .= $checkoutdate;
	$email_message .= $message;
	
	$subject = "Rental Inquiry: " . $_POST['building'];
	
	$headers  = 'From: ' . CONTACT_US_BROKER_EMAIL_FROM . "\r\n";
	$headers .= 'Content-Type: text/html; charset=iso-8859-1' . "\r\n";
	
	mail($_POST['email'], $subject, $email_message, $headers);
	
	header("Location:/index.php?option=" . $_POST['option'] . "&view=" . $_POST['view'] . "&task=" . $_POST['task'] . "&Itemid=" . $_POST['Itemid'] . "&id=" . $_POST['buildingid'] . "&message=sent");
}

if ($_GET['referrer'] == 'propertydetails') {
	//Build message
	$pre = "<html><body style=\"font-family:arial;color:#222222;\"><table width=\"600\" style=\"font-size:14px;background:#DEECF7;border:1px solid #052204;border-bottom:4px solid #052204;\" cellpadding=\"0\" cellspacing=\"0\"><tr><td colspan=\"2\"><img src=\"http://" . SITE_DOMAIN . "/components/com_portaladv/images/email_header.jpg\" /></td></tr><tr><td align=\"center\"><br /><h1>Property Inquiry</h1><strong>" . $_GET['name'] . "</strong> is interested in the following property: <h3><a href=\"http://" . SITE_DOMAIN . "/index.php?option=com_portaladv&view=details&task=details&listing=".$_GET['property_id']."\">MLS #".$_GET['mls_num']."</a></h3><br /><a href=\"http://" . SITE_DOMAIN . "/index.php?option=com_portaladv&view=details&task=details&listing=".$_GET['property_id']."\"><img src=\"" . URL_TO_MLS_IMAGES . IMAGE_FILENAME_PRETEXT . $_GET['property_id'] . IMAGE_FILENAME_POSTTEXT . "1.jpg\" height=\"250\" border=\"0\" /></a></td><tr>";
	$pre .= "<tr><td align=\"center\"><br /><h1>Client Information</h1></td></tr>";
	$name = "<tr><td style=\"padding-left:100px;\"><strong>Name:</strong><br />".$_GET['name']."</td></tr><tr><td><br /></td></tr>"; 
	$email = "<tr><td style=\"padding-left:100px;\"><strong>Email:</strong><br />".$_GET['email']."</td></tr><tr><td><br /></td></tr>"; 
	$phone = "<tr><td style=\"padding-left:100px;\"><strong>Phone:</strong><br />".$_GET['phone']."</td></tr><tr><td><br /></td></tr>"; 
	$message = "<tr><td style=\"padding-left:100px;\"><strong>Message:</strong><br />".$_GET['message']."</td></tr><tr><td><br /><br /></td></tr></table></body></html>";
	$email_message 	= $pre;
	$email_message .= $name;
	$email_message .= $email;
	$email_message .= $phone;
	$email_message .= $message;
	
	$subject = EMAIL_SUBJECT_MLS . ": " . $_GET['mls_num'];
	
	$headers  = 'From: ' . CONTACT_US_BROKER_EMAIL_FROM . "\r\n";
	$headers .= 'Content-Type: text/html; charset=iso-8859-1' . "\r\n";
	
	mail(CONTACT_US_EMAIL, $subject, $email_message, $headers);
	
	//Build client message
	$pre = "<html><body style=\"font-family:arial;color:#222222;\"><table width=\"600\" style=\"font-size:14px;background:#DEECF7;border:1px solid #052204;border-bottom:4px solid #052204;\" cellpadding=\"0\" cellspacing=\"0\"><tr><td><img src=\"http://" . SITE_DOMAIN . "/components/com_portaladv/images/email_header.jpg\" /></td></tr><tr><td align=\"center\" style=\"padding:20px;\"><br /><h4>" . CONTACT_US_THANK_YOU_TEXT . "</h4><a href=\"http://" . SITE_DOMAIN . "/index.php?option=com_portaladv&view=details&task=details&listing=".$_GET['property_id']."\">MLS #".$_GET['mls_num']."</a></h3><br /><a href=\"http://" . SITE_DOMAIN . "/index.php?option=com_portaladv&view=details&task=details&listing=".$_GET['property_id']."\"><img src=\"" . URL_TO_MLS_IMAGES . IMAGE_FILENAME_PRETEXT . $_GET['property_id'] . IMAGE_FILENAME_POSTTEXT . "1.jpg\" height=\"250\" border=\"0\" /></a><br /><br /><br /></td><tr>";
	$email_message2 	= $pre;
	
	$subject = SITE_NAME . " Inquiry: " . $_GET['mls_num'];
	
	$headers  = 'From: ' . CONTACT_US_BROKER_EMAIL_FROM . "\r\n";
	$headers .= 'Content-Type: text/html; charset=iso-8859-1' . "\r\n";
	
	mail($_GET['email'], $subject, $email_message2, $headers);
	
}


if (!$_POST['referrer'] && !$_GET['referrer']) {
	//Build message
	$pre = "<html><body><strong>General Inquiry</strong><br/><br/>";
	$name = "Name: ".$_POST['name']."<br/><br/>"; 
	$email = "Email: ".$_POST['email']."<br/><br/>"; 
	$phone = "Phone: ".$_POST['phone']."<br/><br/>"; 
	$message = "Message: ".$_POST['message']."</body></html>";
	$email_message 	= $pre;
	$email_message .= $name;
	$email_message .= $email;
	$email_message .= $phone;
	$email_message .= $message;
	
	$subject = EMAIL_SUBJECT_GENERAL;
	
	$headers  = 'From: ' . CONTACT_US_BROKER_EMAIL_FROM . "\r\n";
	$headers .= 'Content-Type: text/html; charset=iso-8859-1' . "\r\n";
	
	mail(CONTACT_US_EMAIL, $subject, $email_message, $headers);

	header('Location:/index.php?option=com_portaladv&task=getrecentsales&referrer=messagesent&Itemid=' . $_POST['Itemid']);
}



?>