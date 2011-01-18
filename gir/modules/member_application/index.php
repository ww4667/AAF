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
      
    } else {
         $PAGE_BODY = "member_application_form.php";      /* which file to pull into the template */
         
        require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");
    }
    
  break;
	
}

?>