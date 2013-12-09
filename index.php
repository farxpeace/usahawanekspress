<?php
include('bootstrap.php');

$modules = $_REQUEST["modules"];
$op = $_REQUEST['op'];

if($modules == ''){
    $modules = 'Main';
    include(FOLDER_MODULES."/".$modules."/index.php");
}else{
    include(FOLDER_MODULES."/".$modules."/index.php");
}





include('footer.bootstrap.php')
?>



