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
	
}

?>