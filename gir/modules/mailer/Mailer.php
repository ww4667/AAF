<?php

set_include_path($_SERVER["DOCUMENT_ROOT"] . '/../zend/library' . PATH_SEPARATOR . get_include_path());
require_once $_SERVER["DOCUMENT_ROOT"] . '/../zend/library/Zend/Mail.php';

/**
 * Handles all Outbound Mail 
 * @package Core
 */

class Mailer{

	static function include_user_message_body($template,$email_contents_file,$object){
		ob_start(); //start the buffer
			$object=$object;
			$email_contents_file = $_SERVER['DOCUMENT_ROOT'].'/gir/modules/mailer/views/'.$email_contents_file.'.php';
			include($_SERVER['DOCUMENT_ROOT'].'/gir/modules/mailer/views/'.$template.'.php');
			$message = ob_get_contents();
		ob_end_clean();
		return $message;
	}
	
	static function application_confirmation_email($i_object){
		$mail = new Zend_Mail();
		$mail->setFrom('do_not_reply@aafdsm.com', 'AAF Des Moines');

		$mail->setSubject("Thank you! We've received your application.");
		$mail->setBodyText("We've received your membership application. After we review the application we will send an email with your application status and further instructions.");
		$mail->addTo($i_object['email'], $i_object['fname'] . " " . $i_object['lname']);
		$mail->addBcc("greg@slashwebstudios.com", "AAF Administrator");
		
		//include_user_message_body(TEMPLATE_TO_USE, BODY_FILE_TO_USE, OBJECT_FOR_POPULATING_EMAIL_CONTENTS)
		$message = Mailer::include_user_message_body("base_template","application_confirmation",$i_object); //the template to use from /views/mailer (minus the ".php")
		
		//setting both bodyText AND bodyHtml sends a multipart message for people with text vs. html
		$mail->setBodyHtml($message);
		$mail->send();
	}
	
	static function welcome_email($i_object){
		$mail = new Zend_Mail();
		$mail->setFrom('do_not_reply@strategicscrap.com', 'Strategic Scrap');

		$mail->setSubject("Welcome To Strategic Scrap!");
		$mail->setBodyText("Welcome to Strategic Scrap! You've just signed up for the most powerful and comprehensive tool the scrap metal industry has ever seen. Pricing, market data, transportation hub and more are now at your fingertips! If you have any other questions, feel free to contact us at StrategicInfo@StrategicScrap.com.");
		$mail->addTo($i_object['email'], $i_object['fname'] . " " . $i_object['lname']);
		
		//include_user_message_body(TEMPLATE_TO_USE, BODY_FILE_TO_USE, OBJECT_FOR_POPULATING_EMAIL_CONTENTS)
		$message = Mailer::include_user_message_body("base_template","welcome",$i_object); //the template to use from /views/mailer (minus the ".php")
		
		//setting both bodyText AND bodyHtml sends a multipart message for people with text vs. html
		$mail->setBodyHtml($message);
		$mail->send();
	}

	static function expire_reminder_30($i_object){
		$mail = new Zend_Mail();
		$mail->setFrom('do_not_reply@strategicscrap.com', 'Strategic Scrap');

		$mail->setSubject("Your Strategic Scrap Trial Is Almost Over - Renew Today!");
		$mail->setBodyText("This is just a friendly reminder to let you know that you have 30 Days Left in your Strategic Scrap free trial. Don't miss out on all sorts of great stuff! Visit http://strategicscrap.com#PAYMENT and continue your membership!");
		$mail->addTo($i_object['email'], $i_object['fname'] . " " . $i_object['lname']);
		
		//include_user_message_body(TEMPLATE_TO_USE, BODY_FILE_TO_USE, OBJECT_FOR_POPULATING_EMAIL_CONTENTS)
		$message = Mailer::include_user_message_body("base_template","expire_reminder_30",$i_object); //the template to use from /views/mailer (minus the ".php")
		
		//setting both bodyText AND bodyHtml sends a multipart message for people with text vs. html
		$mail->setBodyHtml($message);
		$mail->send();
	}

	static function expire_reminder_0($i_object){
		$mail = new Zend_Mail();
		$mail->setFrom('do_not_reply@strategicscrap.com', 'Strategic Scrap');

		$mail->setSubject("Your Strategic Scrap Trial Is Over - Renew Today!");
		$mail->setBodyText("There's still time to renew! We value your membership, and we are extending an incredible offer to you. Visit http://strategicscrap.com to find out more. Don't miss out!");
		$mail->addTo($i_object['email'], $i_object['fname'] . " " . $i_object['lname']);
		
		//include_user_message_body(TEMPLATE_TO_USE, BODY_FILE_TO_USE, OBJECT_FOR_POPULATING_EMAIL_CONTENTS)
		$message = Mailer::include_user_message_body("base_template","expire_reminder_0",$i_object); //the template to use from /views/mailer (minus the ".php")
		
		//setting both bodyText AND bodyHtml sends a multipart message for people with text vs. html
		$mail->setBodyHtml($message);
		$mail->send();
	}

	static function accepted_bid_alert($i_object){
		$mail = new Zend_Mail();
		$mail->setFrom('do_not_reply@strategicscrap.com', 'Strategic Scrap');

		$mail->setSubject("Your Transportation Bid has been accepted!");
		$mail->setBodyText("Use your broker dashboard to see your accepted bid so you can get it processed. Login at http://strategicscrap.com to see the details.");
		$mail->addTo($i_object['email'], $i_object['fname'] . " " . $i_object['lname']);
		
		//include_user_message_body(TEMPLATE_TO_USE, BODY_FILE_TO_USE, OBJECT_FOR_POPULATING_EMAIL_CONTENTS)
		$message = Mailer::include_user_message_body("base_template","accepted_bid",$i_object); //the template to use from /views/mailer (minus the ".php")
		
		//setting both bodyText AND bodyHtml sends a multipart message for people with text vs. html
		$mail->setBodyHtml($message);
		$mail->send();
	}

	static function added_bid_alert($i_object){
		$mail = new Zend_Mail();
		$mail->setFrom('do_not_reply@strategicscrap.com', 'Strategic Scrap');

		$mail->setSubject("A bid has been submitted to your transportation request!");
		$mail->setBodyText("Visit your regional homepage to see your requests and view your unread bids. Login at http://strategicscrap.com to see the details.");
		$mail->addTo($i_object['email'], $i_object['fname'] . " " . $i_object['lname']);
		
		//include_user_message_body(TEMPLATE_TO_USE, BODY_FILE_TO_USE, OBJECT_FOR_POPULATING_EMAIL_CONTENTS)
		$message = Mailer::include_user_message_body("base_template","added_bid",$i_object); //the template to use from /views/mailer (minus the ".php")
		
		//setting both bodyText AND bodyHtml sends a multipart message for people with text vs. html
		$mail->setBodyHtml($message);
		$mail->send();
	}
}
?>