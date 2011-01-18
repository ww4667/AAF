<?php
if(!isset($_SESSION)){
	session_start();
}

switch($method){
	
	/* Add Member */
	case 'create':
		// page 'template variables'
		$PAGE_BODY = "create.php";  		/* which file to pull into the template */
		$PAGE_TITLE = "Creating Member";	/* what title to show on page */
		$m = new Member();
		
		if ( isset($_POST['first_name']) ) {
			$post_data = $_POST;
			$clean_data = array();
			foreach ($post_data as $key => $val) {
				$clean = trim($val);
				$clean_data[$key] = $clean;
			}
			$m->CreateItem($clean_data);
			$msg[] = "Member created successfully.";
			flash($msg);
		}		
		
		//the layout file  -  THIS PART NEEDS TO BE LAST
		require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");
	break;
	
}

?>