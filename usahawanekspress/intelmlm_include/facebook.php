<?php
include('facebook-php-sdk-master/src/facebook.php');
Class FB {
    
    var $userid;
    
    function __construct(){
        global $facebook;
        
        
        $app_id = '1374596186128123';
        $app_secret = '92f52f310307b5255707f7fb86fc00e4';
        $app_namespace = 'intelmx';
        $app_url = 'https://apps.facebook.com/' . $app_namespace . '/';
        $scope = 'email,publish_actions,publish_stream,user_online_presence,friends_online_presence';

        // Init the Facebook SDK
            $facebook = new Facebook(array(
                 'appId'  => $app_id,
                 'secret' => $app_secret,
        ));

        // Get the current user
        $user = $facebook->getUser();
        $this->userid = $user;
        // If the user has not installed the app, redirect them to the Login Dialog
        if (!$user) {
            $loginUrl = $facebook->getLoginUrl(array(
                'scope' => $scope,
                'redirect_uri' => $app_url,
            ));
            
            print('<script> top.location.href=\'' . $loginUrl . '\'</script>');
        }
        $registeruser = $this->check_username_registered();
    }
    
    function get_userid(){
        global $facebook;
        $user = $facebook->getUser();
        return $user;
    }
    
    function check_username_registered(){
        global $facebook, $session;
        $fb_username = $this->userid;
        $result = mysql_query("SELECT * FROM ".TBL_USERS." WHERE username='$fb_username'");
        if(mysql_numrows($result) == 0){
            $this->register_user($fb_username);
        }else{
            
        }
    }
    
    function register_user($fb_username){
        $md5 = md5('123456');
        $result = mysql_query("INSERT INTO ".TBL_USERS." SET 
            username='$fb_username',
            password='".$md5."',
            bpassword='123456',
            userlevel='9',
            valid='1'
            
        ");
    }
    
    function login_user($fb_username){
        
        //Header("Location: process.php?user=".$fb_username."&pass=123456&sublogin=1");
    }
}


?>