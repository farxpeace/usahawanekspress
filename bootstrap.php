<?php
// Report all errors except E_NOTICE
error_reporting(E_ALL ^ E_NOTICE);
define ("FOLDER_INCLUDE", 'intelmlm_include');
define ("FOLDER_ADMIN", 'intelmlm_admin');
define ("FOLDER_MODULES", 'intelmlm_modules');
define ("FOLDER_TEMPLATES", 'intelmlm_template');

define("THEME_NAME", 'neat-admin');
define("THEME_LOC", FOLDER_TEMPLATES."/".THEME_NAME);

define("DEBUG_MODE", 1);

function prevent_direct_access()
{
    if($_SERVER['REQUEST_URI'] == $_SERVER['PHP_SELF'])
    {
    	header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);
        exit;
    }
}


$debugger = array();
include(FOLDER_INCLUDE."/session.php");
?>