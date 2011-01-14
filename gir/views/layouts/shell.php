<?
/* SPIT OUT THE PAGE BODY, OR AN ERROR PAGE */
include_once($_SERVER["DOCUMENT_ROOT"]."/gir/views/shared/flash_panel.php");
$viewFile =  $modulesDirectory."/".$controller."/views/". $PAGE_BODY;
(isset($PAGE_BODY) && !empty($PAGE_BODY) && file_exists($viewFile)) ? include($viewFile) : include($_SERVER["DOCUMENT_ROOT"]."/gir/views/errors/bad_include.php");
?>
