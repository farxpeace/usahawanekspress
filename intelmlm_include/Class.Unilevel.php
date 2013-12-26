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
    
    function getAllUpline($uplineId){
        global $database;
    }
    
    function getAllUplineIdByUserId($user_id, $level_count){
        global $database;
        
        $uplines = array();
        for($i = 1; $i <= $level_count; $i++){
            
            $user_id = $this->getSingleUplineByUserId($user_id);
            $uplines[] = $user_id;
        }
        return $uplines;
    }
    
    function getAllUplineIdByUplineId($upline_id, $level_count){
        global $database;
        $level_count = $level_count-1;
        $uplines = array();
        $uplines[] = $database->getUserInfoById($upline_id);
        for($i = 1; $i <= $level_count; $i++){
            
            $upline_id = $this->getSingleUplineByUserId($upline_id);
            $uplines[] = $database->getUserInfoById($upline_id);
        }
        return $uplines;
    }
    
    function getSingleUplineByUserId($user_id){
        global $database;
        $uplineid = $database->getSingleColumnById($user_id, 'uplineid');
        return $uplineid;
    }
    
    
    
    function isVerifiedUser($user_id){
        global $database;
        $upline = $database->getUserInfoById($user_id);
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