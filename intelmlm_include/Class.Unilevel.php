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
    
    function getVerifiedUplineByUplineId($uplineid){
        global $database;
        
        $state = 'on';
        do{
            $isVerifiedUser = $this->isVerifiedUser($uplineid);
            
            if($isVerifiedUser){
                $state = 'off';
            }
        }while($state == 'on');
        
        return $uplineid;
    }
    
    function getAllUplineIdByUplineId2($user_id,$level_count){
        global $database;
        $output = array();
        $j=0;
        
        for($i = 1; $i <= $level_count; $i++){
            
            $userinfo = $database->getUserInfoById($user_id);
            if($userinfo['userlevel'] == '3'){
                $id = $userinfo['id'];
                $user_id = $userinfo['uplineid'];
                $output[] = $userinfo;
            }else{
                $id = null;
                $user_id = $userinfo['uplineid'];
                $level_count++;
            }
            
        }
        
        return $output;
    }
    
    function findVerified($user_id){
        global $database;
        $state = 'on';
        $userinfo = $database->getUserInfoById($user_id);
        while($state == 'on'){
            if($userinfo['userlevel'] == '3'){
                $state = 'off';
            }
        }
        return $userinfo['uplineid'];
    }
    
    
    
    function getAllUplineIdByUplineId($upline_id, $level_count){
        global $database;
        $level_count = $level_count-1;
        $uplines = array();
        $userInfo = $database->getUserInfoById($upline_id);
        $userInfo['is_verified'] = $this->isVerifiedUser($upline_id);
        $uplines[] = $userInfo;
        for($i = 1; $i <= $level_count; $i++){
            
            $upline_id = $this->getSingleUplineByUserId($upline_id);
            $userInfo = $database->getUserInfoById($upline_id);
            $userInfo['is_verified'] = $this->isVerifiedUser($upline_id);
            if(!$userInfo['is_verified']){
                
            }
            $uplines[] = $userInfo;
            
        }
        return $uplines;
    }
    
    function getSingleUplineByUserId($user_id){
        global $database;
        $uplineid = $database->getSingleColumnById($user_id, 'uplineid');
        return $uplineid;
    }
    
    function levelinfo($level, $data){
        
        $user_id = $this->levelinfo[$level]['user_id'];
        if(!is_array($user_id)){
            $user_id = array();
        }
        if(!in_array($data['id'], $user_id)){
            $this->levelinfo[$level]['user_id'][] = $data['id'];
        }
        
        $count = count($this->levelinfo[$level]['user_id']);
        $this->levelinfo[$level]['count'] = $count;
        
    }
    
    function getUserLevel($user_id, $level_x=1, $count=1){
        global $database;
        for($i = 1; $i <= 1; $i++){
            $query = mysql_query("SELECT * FROM ".$database->tbl_users_name." WHERE uplineid='".$user_id."'");
            while($row = mysql_fetch_assoc($query)){
                //$row['level_'.($level_x+1)] = $this->getUserLevel($row['id'], $level_c-1, $level_x+1);
                $data = array(
                    'id'    => $row['id'],
                    'uplineid'  => $row['uplineid'],
                    'downline'  => $this->getUserLevel($row['id'], $level_x, $count+1)
                );
                $count_level['id'][] = $row['id'];
                $list['level_'.($count)][] = $data;
                
                $this->levelinfo($count, array('id' => $row['id']));
            }
        }
        
        //$all_id = implode(',', $list['id'])
        
        
        //$level_step['level_'.($level_x+1)] = $level_data['level_'.($level_x+1)];
        
        return $list;
    }
    
    function array_search_inner ($array, $level) {
      $i = 1;
      while($i == $level){
        foreach($array as $a => $b){
          $c = $b;
            
        }
        
        $i++;
      }
      
      return $c;
    }
    
    
    function isVerified($user_id){
        global $database;
        $userinfo = $database->getUserInfoById($user_id);
        $isVerified = $database->getSingleMetaByRefAndValue('level_constants', $userinfo['userlevel']);
        
        if($isVerified == 'verified_user'){
            $output = TRUE;
        }else{
            $output = FALSE;
        }
        return $output;
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