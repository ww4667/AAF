<?php

if(!isset($_SESSION)){
	session_start();
}

switch ($method) {
	/* View Businesses */
	case 'view-businesses':
		$PAGE_BODY = "view_businesses.php";      /* which file to pull into the template */
		
		require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");
    break;
}

?>