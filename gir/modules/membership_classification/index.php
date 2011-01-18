<?php
if(!isset($_SESSION)){
	session_start();
}

switch($method){
    
  case 'create':
    // page 'template variables'
    $PAGE_BODY = "create.php";      /* which file to pull into the template */
    $PAGE_TITLE = "Creating Membership Classification";  /* what title to show on page */
    $m = new Membership_Classification();
    
    if ( isset($_POST['description']) ) {
      $post_data = $_POST;
      $clean_data = array();
      foreach ($post_data as $key => $val) {
        $clean = trim($val);
        $clean_data[$key] = $clean;
      }
      $m->CreateItem($clean_data);
      $msg[] = "Membership Classification created successfully.";
      flash($msg);
    }   
    
    //the layout file  -  THIS PART NEEDS TO BE LAST
    require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");
  break;
  
    
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
    
  break;
	
}

?>