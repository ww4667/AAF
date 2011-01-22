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

    
    static function application_approved_email($i_object){
        $mail = new Zend_Mail();
        $mail->setFrom('do_not_reply@aafdsm.com', 'AAF Des Moines');

        $mail->setSubject("Thank you! We've approved your application.");
        $mail->setBodyText("We've approved your membership application. Please visit the website to setup your password and login.");
        $mail->addTo($i_object['email'], $i_object['fname'] . " " . $i_object['lname']);
        $mail->addBcc("greg@slashwebstudios.com", "AAF Administrator");
        
        //include_user_message_body(TEMPLATE_TO_USE, BODY_FILE_TO_USE, OBJECT_FOR_POPULATING_EMAIL_CONTENTS)
        $message = Mailer::include_user_message_body("base_template","application_approved",$i_object); //the template to use from /views/mailer (minus the ".php")
        
        //setting both bodyText AND bodyHtml sends a multipart message for people with text vs. html
        $mail->setBodyHtml($message);
        $mail->send();
    }

    static function submit_job_confirmation_email($i_object){
        $mail = new Zend_Mail();
        $mail->setFrom('do_not_reply@aafdsm.com', 'AAF Des Moines');

        $mail->setSubject("Thank you! We've received your job submission.");
        $mail->setBodyText("We've received your job submission. After we review the information provided we will send an email with your job posting status and further instructions.");
        $mail->addTo($i_object['email'], $i_object['fname'] . " " . $i_object['lname']);
        $mail->addBcc("greg@slashwebstudios.com", "AAF Administrator");
        
        //include_user_message_body(TEMPLATE_TO_USE, BODY_FILE_TO_USE, OBJECT_FOR_POPULATING_EMAIL_CONTENTS)
        $message = Mailer::include_user_message_body("base_template","submit_job_confirmation",$i_object); //the template to use from /views/mailer (minus the ".php")
        
        //setting both bodyText AND bodyHtml sends a multipart message for people with text vs. html
        $mail->setBodyHtml($message);
        $mail->send();
    }
    static function submit_event_confirmation_email($i_object){
        $mail = new Zend_Mail();
        $mail->setFrom('do_not_reply@aafdsm.com', 'AAF Des Moines');

        $mail->setSubject("Thank you! We've received your event submission.");
        $mail->setBodyText("We've received your event submission. After we review the information provided we will send an email with your event posting status and further instructions.");
        $mail->addTo($i_object['email'], $i_object['fname'] . " " . $i_object['lname']);
        $mail->addBcc("greg@slashwebstudios.com", "AAF Administrator");
        
        //include_user_message_body(TEMPLATE_TO_USE, BODY_FILE_TO_USE, OBJECT_FOR_POPULATING_EMAIL_CONTENTS)
        $message = Mailer::include_user_message_body("base_template","submit_event_confirmation",$i_object); //the template to use from /views/mailer (minus the ".php")
        
        //setting both bodyText AND bodyHtml sends a multipart message for people with text vs. html
        $mail->setBodyHtml($message);
        $mail->send();
    }
	
}
?>