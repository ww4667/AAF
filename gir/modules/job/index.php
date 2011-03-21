<?php

if(!isset($_SESSION)){
	session_start();
}

switch($method){/* Add Member */
  /* Add Member */
  case 'submit-job':
	require_once($_SERVER['DOCUMENT_ROOT']."/gir/lib/recaptcha-php-1.10/recaptchalib.php"); //include the re-captcha libraries
	$j = new Job();
    
    if ( isset($_POST['job_title']) ) {

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
            
        $j->CreateItem($clean_data);                  
        $email_data = array();
        
        $full_name = explode(" ", $clean_data["name"]);
        
        $email_data["email"] = $clean_data["email"];
        $email_data["fname"] = $full_name[0];
        $email_data["lname"] = $full_name[1];
        $email_data["job_data"] = $clean_data;
       
        Mailer::submit_job_confirmation_email($email_data);
              
        $PAGE_BODY = "submit_job_confirm.php";      /* which file to pull into the template */    
    
    } else {
        
        $PAGE_BODY = "submit_job.php";      /* which file to pull into the template */
         
    }    
        require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");
  break;
  
  case 'view-jobs':
    $j = new Job();
        
    $PAGE_BODY = "view_jobs.php";      /* which file to pull into the template */
     
    require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");  
    break;
  
  case 'job-details':
    $j = new Job();
    $job = $_GET["job"];
    
    $PAGE_BODY = "job_details.php";      /* which file to pull into the template */
     
    require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");      
    break;
	
  case 'admin-view-job-details':
    $j = new Job();
    $job = $_GET["job"];
    
    $PAGE_BODY = "admin_job_details.php";      /* which file to pull into the template */
     
    require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");      
    break;
    
  case 'admin_view_jobs':
    $j = new Job();
        
    $PAGE_BODY = "admin_view_jobs.php";      /* which file to pull into the template */
     
    require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");  
  break;
  
  /* Add Member */
  case 'approve-job':
    $j = new Job();
    
    $job_id = $_GET["job_id"];
    
    $theJob = $j->GetItemObj( $job_id );
    
    $theJob->approved = 1;
    $j->UpdateItem();   
    
    //$email_data["email"] = $app_data["email"];
    //$email_data["fname"] = $app_data["first_name"];
    //$email_data["lname"] = $app_data["last_name"];
    
    //Mailer::job_approved_email($email_data);
          
    //this is where we send credit card information
      
  break;
}

?>