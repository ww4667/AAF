<?php
if(!isset($_SESSION)){
	session_start();
}

      print"in application";
switch($method){/* Add Member */
  /* Add Member */
  case 'submit-app':
	$a = new Application();
    
    if ( isset($_POST['first_name']) ) {
      $post_data = $_POST;
      $clean_data = array();
      foreach ($post_data as $key => $val) {
        $clean = trim($val);
        $clean_data[$key] = $clean;
      }

      $clean_data["application_data"] =  json_encode($clean_data);
      
      $a->CreateItem($clean_data);
      
    }   
    
      print"in application submit-app : ". $_POST['first_name'];
  break;
	
}

?>