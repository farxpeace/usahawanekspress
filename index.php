<?php
include('bootstrap.php');

$modules = $_REQUEST["modules"];
$content = $_REQUEST['content'];
$pages = $_REQUEST['pages'];

if($modules == ''){
    $modules = 'Main';
    include(FOLDER_MODULES."/".$modules."/index.php");
}else{
    include(FOLDER_MODULES."/".$modules."/index.php");
}







?>