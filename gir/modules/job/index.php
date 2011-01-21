<?php

if(!isset($_SESSION)){
	session_start();
}

switch($method){/* Add Member */
  /* Add Member */
  case 'submit-job':
	$j = new Job();
    
    if ( isset($_POST['job_title']) ) {
        $post_data = $_POST;
        $clean_data = array();
        foreach ($post_data as $key => $val) {
            $clean = trim($val);
            $clean_data[$key] = $clean;
        }
            
        $j->CreateItem($clean_data);                  
              
        $PAGE_BODY = "submit_job_confirm.php";      /* which file to pull into the template */
    
    
        require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");
      
    } else {
        
        $PAGE_BODY = "submit_job.php";      /* which file to pull into the template */
         
        require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");
    }
    
  break;
  
  case 'view-jobs':
    $j = new Job();
    $j->showApprovedJobs();      
    break;
  
  case 'job-detail':
    $j = new Job();
    $job = $_GET["job"];
    
    $j->showjobDetail($job);      
    break;
	
}

?>