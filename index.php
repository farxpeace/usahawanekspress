<?php if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); ?>
<?php

include('bootstrap.php');
//$info = $Class_Sms->sendText( '60127415914', 'MyApp', 'Hello!' );
$modules = $_REQUEST["modules"];
$op = $_REQUEST['op'];

        //echo '<pre>';
        //print_r(unserialize($session->userinfo['fb_array']));
        //print_r($session->fbinfo);
        //echo '</pre>';
$memberid = $_GET['member'];
$decrypt_uid = $Mx->encrypt_decrypt('decrypt',$memberid);

if(is_numeric($decrypt_uid)){
    $memberid = $decrypt_uid;
}
if(is_numeric($memberid)){
    if($Class_unilevel->isVerifiedUser($memberid)){
        $upline = $database->getUserInfoById($memberid);
        $uplineid = $upline['id'];
        $Class_unilevel->setCookieByUpline($memberid);
    }else{
        $uplineid = $Class_unilevel->defaultUplineId;
        $Class_unilevel->setCookieAdmin();
    }
}else{
    
    if(!$Class_unilevel->getCookieUpline()){
        $Class_unilevel->setCookieAdmin();
    }
}

if(!$Class_unilevel->getCookieUpline()){
    if(!$uplineid){
        $uplineid = $Class_unilevel->defaultUplineId;
    }
    
}else{
    if(!$uplineid){
        $uplineid = $Class_unilevel->getCookieUpline();
    }else{
        
    }
    
}

if($session->userinfo['uplineid']){
    $isUplineVerified = $Class_unilevel->isVerifiedUser($session->userinfo['uplineid']);
    if($isUplineVerified){
        $uplineid = $session->userinfo['uplineid'];
    }
}else{
    $database->updateUserFieldById($session->uid, 'uplineid', $uplineid);
}





$Class_unilevel = new Unilevel($uplineid);
if($session->userinfo['upline_arr']){
    $limit = 10;
    $ex = explode(',', $session->userinfo['upline_arr']);
    for($i = 0; $i < $limit; $i++){
        if($ex[$i]){
            $up_id = $ex[$i];    
        }else{
            $up_id = $uplineid_x;
        }
        
        $up_info = $database->getUserInfoById($up_id);
        if($up_info['userlevel'] != '3'){
            $limit++;
        }else{
            $uplineList[] = $up_info;    
        }
        
        $uplineid_x = $up_info['uplineid'];
        
    }
}else{
    $uplineList = $Class_unilevel->getAllUplineIdByUplineId2($uplineid, 10);
}
//$uplineList = $Class_unilevel->getAllUplineIdByUplineId2($uplineid, 10);
$ebookList = $Class_ebooks->getAllEbooks();
//echo '<pre>';
//print_r($uplineList);
$Class_debugger->debug_r('upline', $uplineList);
if($modules == ''){
    $modules = 'Main';
    include(FOLDER_MODULES."/".$modules."/index.php");
}else{
    include(FOLDER_MODULES."/".$modules."/index.php");
}





include('footer.bootstrap.php');

?>



