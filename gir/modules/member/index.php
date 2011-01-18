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
		
//		$m->CreateItem($postData);
//		
//		$m->first_name = "Greg";
//		$m->last_name = "Crown";
//		
//		$m->UpdateItem();
		
		//the layout file  -  THIS PART NEEDS TO BE LAST
		require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");
	break;
	
}

?>