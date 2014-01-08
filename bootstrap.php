<?php

// Report all errors except E_NOTICE
error_reporting(E_ALL ^ E_NOTICE);
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

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
define('DEFAULT_CONTROLLER','Main');
define('DEFAULT_ACTION', 'guest_index');
$path = dirname(__FILE__);
set_include_path(get_include_path() . PATH_SEPARATOR . $path);


//
if (strpos(dirname(__FILE__),'xampp')) {
    $debug = true;
}

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
    if(substr($className, -11) == '_Controller'){
        $module = substr($className, 0,-11);
        if (file_exists(FOLDER_MODULES.'/'.$module.'/'.$className . '.php')) {
            require_once(FOLDER_MODULES.'/'.$module.'/'.$className . '.php');        
        }
    }else if(substr($className, -6) == '_Model'){
        $module = substr($className, 0,-6);
        if (file_exists(FOLDER_MODULES.'/'.$module.'/'.$className . '.php')) {
            require_once(FOLDER_MODULES.'/'.$module.'/'.$className . '.php');        
        }
    }else{
        //fetch file
        if (file_exists('intelmlm_library/'.$className . '.php')) {
            require_once('intelmlm_library/'.$className . '.php');        
        }
        
        else {
    		// Error: Controller Class not found
    		die("Error: Class ".$className." not found.");
    	}
    }
	
    
}



//$model = new Model(array('User'));
function Controller(){
    global $url;

	if (!isset($url)) {
		$controllerName = DEFAULT_CONTROLLER;
		$action = DEFAULT_ACTION;
	} 
	else {
		$urlArray = array();
		$urlArray = explode("/",$url);
		$controllerName = $urlArray[0];
		$action = (isset($urlArray[1]) && $urlArray[1] != '') ? $urlArray[1] : DEFAULT_ACTION;	
	}
	
	$query1 = (isset($urlArray[2]) && $urlArray[2] != '') ? $urlArray[2] : null;
	$query2 = (isset($urlArray[3]) && $urlArray[3] != '') ? $urlArray[3] : null;
	

	//modify controller name to fit naming convention
    //$moduleName = ucfirst($controllerName);
	$class = ucfirst($controllerName).'_Controller';

	//instantiate the appropriate class
	if (class_exists($class) && (int)method_exists($class, $action)) {
		
		$controller = new $class;
		$controller->$action($query1, $query2);
		//call_user_func_array(array($controller,$action),$query1);

	}
	else {
		die("1. File <b>'$controllerName.php'</b> containing class <b>'$class'</b> might be missing. <br>2. Method <b>'$action'</b> is missing in <b>'$controllerName.php'</b>");
	}
}


//require_once(FOLDER_INCLUDE.'/MDB2-2.5.0b5/MDB2.php');
//require_once(FOLDER_INCLUDE.'/Library.Database.php');



include(FOLDER_INCLUDE."/session.php");

Controller();

?>
