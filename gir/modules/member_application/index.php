<?php

if(!isset($_SESSION)){
	session_start();
}

switch($method){/* Add Member */
  /* Add Member */
  case 'submit-app':
	$a = new Member_Application();
    
    if ( isset($_POST['first_name']) ) {
        $post_data = $_POST;
        $clean_data = array();
        foreach ($post_data as $key => $val) {
            $clean = trim($val);
            $clean_data[$key] = $clean;
        }

        $clean_data["application_data"] =  json_encode($clean_data);          
        $a->CreateItem($clean_data);                  
        $membership_classification = $clean_data["classification"];
        
        $email_data = array();
        
        $email_data["email"] = $clean_data["email"];
        $email_data["fname"] = $clean_data["first_name"];
        $email_data["lname"] = $clean_data["last_name"];
        $email_data["application_data"] = $clean_data;
       
        Mailer::application_confirmation_email($email_data);
              
        $PAGE_BODY = "member_application_confirm.php";      /* which file to pull into the template */
     
        require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");
        
       
      
    } else {
        
        $PAGE_BODY = "member_application_form.php";      /* which file to pull into the template */
         
        require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");
    }
    
  break;
  case 'view-applications':
    $m = new Member_Application();
        
    $PAGE_BODY = "view_applications.php";      /* which file to pull into the template */
     
    require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");  
  break;
  
  /* Add Member */
  case 'approve-app':
    $a = new Member_Application();
    $m = new Member();
    $u = new User();
    
    $app_id = $_GET["app_id"];
    
    $theApp = $a->getApplicationData($app_id);
    
    $app_data = json_decode($theApp->application_data, true);
    
    //print_r($app_data);
         
    $u->CreateItem($app_data);
    
    $m->CreateItem($app_data);     

    $m->JoinUser($u->newId);
    
    $theApp->approved = 1;
    $a->UpdateItem();   
    
    $email_data["email"] = $app_data["email"];
    $email_data["fname"] = $app_data["first_name"];
    $email_data["lname"] = $app_data["last_name"];
    
    Mailer::application_approved_email($email_data);
      
    
    //this is where we send credit card information
    
  
    
  break;
	
}

?>