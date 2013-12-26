<?php
Class Unilevel {
    var $defaultUplineId = '10';
    var $uplineInfo = array();
    
    function __construct($userid = false){
        global $database;
        if($userid){
            $this->uplineInfo = $database->getUserInfoById($userid);
        }
    }
    
    function isVerifiedUser($uid){
        global $database;
        $upline = $database->getUserInfoById($uid);
        $isVerified = $database->getSingleMetaByRefAndValue('level_constants', $upline['userlevel']);
        if($isVerified  == 'verified_user'){
            $output = true;
        }else{
            $output = false;
        }
        
        return $output;
    }
    
    function setCookieAdmin(){
        $this->setCookieByUpline($this->defaultUplineId);
    }
    
    function getUplineByCookie(){
        global $database;
        $uplineid = $this->getCookieUpline();
        $uplineInfo = $database->getUserInfoById($uplineid);
        return $uplineInfo;
    }
    
    function setCookieByUpline($uplineid){
        setcookie(
          "upline",
          $uplineid,
          time() + (10 * 365 * 24 * 60 * 60)
        );
    }
    
    function getCookieUpline(){
        $uplineid = $_COOKIE['upline'];
        if(!$uplineid){
            $output = false;
        }else{
            $output = $uplineid;
        }
        return $output;
    }
    
    
}
?>