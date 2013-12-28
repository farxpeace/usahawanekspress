<?php

include('bootstrap.php');

$modules = $_REQUEST["modules"];
$op = $_REQUEST['op'];


$memberid = $_GET['member'];
if(is_numeric($memberid)){
    
    if($Class_unilevel->isVerifiedUser($memberid)){
        $upline = $database->getUserInfoById($memberid);
        $Class_unilevel->setCookieByUpline($memberid);
    }else{
        $Class_unilevel->setCookieAdmin();
    }
}else{
    
    if(!$Class_unilevel->getCookieUpline()){
        $Class_unilevel->setCookieAdmin();
    }
}

if(!$Class_unilevel->getCookieUpline()){
    $uplineid = $Class_unilevel->defaultUplineId;
}else{
    $uplineid = $Class_unilevel->getCookieUpline();
}

$Class_unilevel = new Unilevel($uplineid);
$uplineList = $Class_unilevel->getAllUplineIdByUplineId($uplineid, 10);
$ebookList = $Class_ebooks->getAllEbooks();
//echo '<pre>';
//print_r($uplineList);
if($modules == ''){
    $modules = 'Main';
    include(FOLDER_MODULES."/".$modules."/index.php");
}else{
    include(FOLDER_MODULES."/".$modules."/index.php");
}





include('footer.bootstrap.php');

?>



