<?php

// Report all errors except E_NOTICE
error_reporting(E_ALL ^ E_NOTICE);
define("BASEURL", "usahawanekspress.com");
define('SYSURL','http://localhost/intelmlm/');
define ("FOLDER_INCLUDE", 'intelmlm_include');
define ("FOLDER_ADMIN", 'intelmlm_admin');
define ("FOLDER_MODULES", 'intelmlm_modules');
define ("FOLDER_TEMPLATES", 'intelmlm_template');
define ("FOLDER_IMAGES", 'intelmlm_images');

#define("THEME_NAME", 'neat-admin');
define("THEME_NAME", 'Metro-UI-Mastered');
define("THEME_LOC", FOLDER_TEMPLATES."/".THEME_NAME);

$path = dirname(__FILE__);
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

function prevent_direct_access()
{
    if($_SERVER['REQUEST_URI'] == $_SERVER['PHP_SELF'])
    {
    	header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);
        exit;
    }
}


include(FOLDER_INCLUDE."/constants.php");
include(FOLDER_INCLUDE."/adodb5/adodb.inc.php");



 //Automatically includes files containing classes that are called
function __autoload($className) {
	
    //fetch file
    if (file_exists('intelmlm_library/'.$className . '.php')) {
        require_once('intelmlm_library/'.$className . '.php');        
    }
    else if (file_exists('intelmlm_library/'.$className . '.php')) {
        require_once('intelmlm_library/'.$className . '.php');        
    }
    else if (file_exists('intelmlm_library/'.$className . '.php')) {
        require_once('intelmlm_library/'.$className . '.php');        
    }
    else {
	
		// Error: Controller Class not found
		die("Error: Class not found.");
	}
}



$model = new Model(array('User'));


//require_once(FOLDER_INCLUDE.'/MDB2-2.5.0b5/MDB2.php');
//require_once(FOLDER_INCLUDE.'/Library.Database.php');



include(FOLDER_INCLUDE."/session.php");
?>