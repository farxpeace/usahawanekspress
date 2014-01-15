<?php

// Report all errors except E_NOTICE
error_reporting(E_ALL ^ E_NOTICE);
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

define("BASEURL", "usahawanekspress.com");
define('SYSURL','http://localhost/intelmlm/');
define ("FOLDER_INCLUDE", 'intelmlm_include');
define ("FOLDER_LIBRARY", 'intelmlm_library');
define ("FOLDER_ADMIN", 'intelmlm_admin');
define ("FOLDER_MODULES", 'intelmlm_modules');
define ("FOLDER_TEMPLATES", 'intelmlm_template');
define ("FOLDER_IMAGES", 'intelmlm_images');
define ("FOLDER_ERROR", 'intelmlm_error');

#define("THEME_NAME", 'neat-admin');
define("THEME_NAME", 'Metro-UI-Mastered');
define("THEME_LOC", FOLDER_TEMPLATES."/".THEME_NAME);
define('DEFAULT_CONTROLLER','Main');
define('DEFAULT_ACTION', 'guest_index');
define('DEVELOPMENT_ENVIRONMENT', false);
define('DEVELOPER_TOOL', true);
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
//include(FOLDER_INCLUDE."/schemecreator/SchemeCreator.class.php");
//include(FOLDER_INCLUDE."/schemecreator/SchemeReader.class.php");


include(FOLDER_INCLUDE."/session.php");

?>
