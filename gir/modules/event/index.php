<?php

if(!isset($_SESSION)){
	session_start();
}

switch($method){/* Add Member */
  /* Add Member */
  case 'submit-event':
    require_once($_SERVER['DOCUMENT_ROOT']."/gir/lib/recaptcha-php-1.10/recaptchalib.php"); //include the re-captcha libraries
    $e = new Event();
    
    if ( isset($_POST['event_title']) ) {

        if(isset($_POST["email"])){
            /* CHECK RECAPTCHA */
            $recaptcha_public_key = "6LcPowkAAAAAAO81P8YHWUZLyalPKk3_--anwzF2";
            $recaptcha_private_key = "6LcPowkAAAAAAPml_ZNnY1pa05JecT0EDRWK6ba3";
            $captcha_resp = recaptcha_check_answer ($recaptcha_private_key, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
            if (!$captcha_resp->is_valid) {
                $errors=true;
                    array_push($error_messages, "The challenge text wasn't entered correctly, please try again.");
            } elseif ($captcha_resp->is_valid) {
                $errors=false;
                array_push($success_messages, "Thank you for contacting Slash/Web Studios. We'll be in touch!");
            }
        }
        
        
        $post_data = $_POST;
        $clean_data = array();
        foreach ($post_data as $key => $val) {
            $clean = trim($val);
            $clean_data[$key] = $clean;
        }
            
        //$e->CreateItem($clean_data);                  
        $email_data = array();
        
        $full_name = explode(" ", $clean_data["name"]);
        
        $email_data["email"] = $clean_data["email"];
        $email_data["fname"] = $full_name[0];
        $email_data["lname"] = $full_name[1];
        $email_data["event_data"] = $clean_data;
       
        Mailer::submit_event_confirmation_email($email_data);
              
        $PAGE_BODY = "submit_event_confirm.php";      /* which file to pull into the template */    
    
    } else {
        
        $PAGE_BODY = "submit_event.php";      /* which file to pull into the template */
         
    }    
        require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");
  break;
  case 'add-event':
    $e = new Event();
    
    if ( isset($_POST['event_title']) ) {
       
        
        $post_data = $_POST;
        $clean_data = array();
        foreach ($post_data as $key => $val) {
            $clean = trim($val);
            $clean_data[$key] = $clean;
        }
            
        $e->CreateItem($clean_data);                  
        //$email_data = array();
        
        //$full_name = explode(" ", $clean_data["name"]);
        
        //$email_data["email"] = $clean_data["email"];
        //$email_data["fname"] = $full_name[0];
        //$email_data["lname"] = $full_name[1];
        //$email_data["event_data"] = $clean_data;
       
        //Mailer::submit_event_confirmation_email($email_data);
              
        $PAGE_BODY = "submit_event_confirm.php";      /* which file to pull into the template */    
    
    } else {
        
        $PAGE_BODY = "add_event.php";      /* which file to pull into the template */
         
    }    
        require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");
  break;
  
  case 'view-events':
    $e = new Event();
        
    $PAGE_BODY = "view_events.php";      /* which file to pull into the template */
     
    require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");  
    break;
  
  case 'event-details':
    $e = new Event();
    $event = $_GET["event"];
    
    $PAGE_BODY = "event_details.php";      /* which file to pull into the template */
     
    require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");      
    break;
    
  case 'get-gCal-events':
    $e = new Event();
    
    $gCalClient = $e->gCalStart();
    
    $e->gCalGetEvents($gCalClient);    
    
  break;
    
  case 'manager-update-event': 
  
    $event_id = $_GET["event_id"];
    
    $e = new Event();
    
    
  if ( isset($_POST['event_title']) ) {       
        
        $post_data = $_POST;
        $clean_data = array();
        foreach ($post_data as $key => $val) {
            $clean = trim($val);
            $clean_data[$key] = $clean;
        }
    
        $theEvent = $e->GetItemObj($clean_data["event_id"]);
        
        //$e->CreateItem($clean_data);  
        $gCalClient = $e->gCalStart();
        //$clean_data['tzOffset'] = "-06";
        //$gCalId = $e->gCalCreateEvent($gCalClient, $clean_data);    
        
        //$e->google_calendar_id = $gCalId;
        $theEvent->UpdateItem($clean_data);
        
        $e->gCalUpdateEvent($gCalClient, $theEvent->google_calendar_id, $clean_data); 
        
        //print $e->google_calendar_id;    
        //$e->CreateItem($clean_data);                  
        //$email_data = array();
        
        //$full_name = explode(" ", $clean_data["name"]);
        
        //$email_data["email"] = $clean_data["email"];
        //$email_data["fname"] = $full_name[0];
        //$email_data["lname"] = $full_name[1];
        //$email_data["event_data"] = $clean_data;
       
        //Mailer::submit_event_confirmation_email($email_data);
              
        $PAGE_BODY = "submit_event_confirm.php";      /* which file to pull into the template */    
    
    } else {
        $theEvent = $e->GetItemObj($event_id);
        
        $PAGE_BODY = "manager/update.php";      /* which file to pull into the template */
         
    }    
        require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");
      
    
  break;
    
  case 'manager-create-event': 
  
    $e = new Event();
    
  if ( isset($_POST['event_title']) ) {       
        
        $post_data = $_POST;
        $clean_data = array();
        foreach ($post_data as $key => $val) {
            $clean = trim($val);
            $clean_data[$key] = $clean;
        }
    
        $e->PTS($clean_data);
        
        $e->CreateItem($clean_data);  
        $gCalClient = $e->gCalStart();
        $clean_data['tzOffset'] = "-06";
        $gCalId = $e->gCalCreateEvent($gCalClient, $clean_data);    
        $gCalId = str_replace("http://www.google.com/calendar/feeds/default/private/full/", "", $gCalId);
        $e->google_calendar_id = $gCalId;
        $e->UpdateItem();
        
        print $e->google_calendar_id;    
        //$e->CreateItem($clean_data);                  
        //$email_data = array();
        
        //$full_name = explode(" ", $clean_data["name"]);
        
        //$email_data["email"] = $clean_data["email"];
        //$email_data["fname"] = $full_name[0];
        //$email_data["lname"] = $full_name[1];
        //$email_data["event_data"] = $clean_data;
       
        //Mailer::submit_event_confirmation_email($email_data);
              
        $PAGE_BODY = "submit_event_confirm.php";      /* which file to pull into the template */    
    
    } else {
        
        $PAGE_BODY = "manager/create.php";      /* which file to pull into the template */
         
    }    
        require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");
      
    
  break;
	
}

?>