<?php
ini_set('display_errors', 1); 
ini_set('log_errors', 1); 
//ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); 
error_reporting(E_ALL);

/**
 * Main controller file that drives this puppy.
 */

// include configuration settings
require_once("config.php");

// include core modules
require_once($coreDirectory."/models/crud/Crud.php");
require_once($coreDirectory."/modules/auth/Auth.php");
require_once($coreDirectory."/modules/user/User.php");

// include core library and include files
require_once($coreDirectory."/lib/database/Database.php");
require_once($coreDirectory."/lib/database/Mysql.php");
require_once($coreDirectory."/inc/db_connect.php");
require_once($coreDirectory."/lib/validation/Validation.php");
require_once($coreDirectory."/lib/xtras.php");
require_once($coreDirectory."/inc/util.php");

// initialize Gir
require_once($coreDirectory."/Gir.php");
$gir = new Gir();

// include application modules
require_once($modulesDirectory."/member/Member.php");
require_once($modulesDirectory."/member_application/Member_Application.php");
require_once($modulesDirectory."/membership_classification/Membership_Classification.php");
require_once($modulesDirectory."/mailer/Mailer.php");
require_once($modulesDirectory."/job/Job.php");
require_once($modulesDirectory."/event/Event.php");

// include additional library and include files
require_once($librariesDirectory."/usaepay/usaepay.php");
// require_once($includesDirectory."/some_cool_inlucde.php");

// get controller and method from page request
$controller = isset($controller) ? $controller : NULL;
$method = isset($method) ? $method : NULL;
if (is_null($controller)) {
	$controller = isset($_GET['controller']) ? $_GET['controller'] : NULL;
}
if (is_null($method)) {
	$method = isset($_GET['method']) ? $_GET['method'] : NULL;
}

// make the magic happen
if(!is_null($controller)) {
	// check if module exists
	if(file_exists($modulesDirectory."/".$controller)){
		// include specific module controller
		require_once($modulesDirectory."/".$controller."/index.php");
	} else {
		// include default module controller
		require_once($modulesDirectory."/".$defaultModule."/index.php");
	}
} else {
	// include default module controller
	require_once($modulesDirectory."/".$defaultModule."/index.php");
}
?>