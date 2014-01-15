<?php

 /** Check if environment is development and display errors **/

function SetReporting() {
	if (DEVELOPMENT_ENVIRONMENT == true) {
		error_reporting(E_ALL ^ E_NOTICE);
		ini_set('display_errors','On');
	} 
	else {
		error_reporting(E_ALL ^ E_NOTICE);
		ini_set('display_errors','Off');
		ini_set('log_errors', 'On');
		ini_set( 'error_log', FOLDER_ERROR . DS . 'tmp' . DS . 'logs' . DS . 'error.log' );
	}
}


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

$router = array();
function Controller(){
    global $url, $router;

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
		$router['action'] = $action;
		$controller = new $class;
        $controller->action = $action;
		$controller->$action($query1, $query2);
		//call_user_func_array(array($controller,$action),$query1);
        
	}
	else {
		die("1. File <b>'$controllerName.php'</b> containing class <b>'$class'</b> might be missing. <br>2. Method <b>'$action'</b> is missing in <b>'$controllerName.php'</b>");
	}
}
 
class CallHookController {
    
    public $action;
    public $url;
    
    function __construct(){
        global $url;
    }
}



SetReporting();
//RemoveMagicQuotes();
//UnregisterGlobals();
//CallHook();
