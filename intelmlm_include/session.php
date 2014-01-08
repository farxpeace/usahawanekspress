<?php
/**
 * Session.php
 * 
 * The Session class is meant to simplify the task of keeping
 * track of logged in users and also guests.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: June 15, 2011 by Ivan Novak
 */

include("gump.class.php");
include("Class.Mx.php");
include("database.php");
include("debugger/Class.Debugger.php");
include('Class.Settings.php');
include("mailer.php");
include("form.php");
require 'facebook-php-sdk-master/src/facebook.php';
$facebook = new Facebook(array(
  'appId'  => '567145173378045',
  'secret' => 'a5761971bcb7de3755ef5dd54aa99eb9',
  'cookie' => true
));
$user = $facebook->getUser();

include('Nexmo-PHP-lib/NexmoMessage.php');
$Class_Sms = new NexmoMessage('81b2db94', 'd5be1a55');


class Session
{
    var $uid;
   var $username;     //Username given on sign-up
   var $email;
   var $userid;       //Random value generated on current login
   var $userlevel;    //The level to which the user pertains
   var $time;         //Time user was last active (page loaded)
   var $logged_in;    //True if user is logged in, false otherwise
   var $userinfo = array();  //The array holding all user info
   var $url;          //The page url current being viewed
   var $referrer;     //Last recorded site page viewed
   /**
    * Note: referrer should really only be considered the actual
    * page referrer in process.php, any other time it may be
    * inaccurate.
    */

   /* Class constructor */
   function Session(){
      $this->time = time();
      $this->startSession();
   }
    function parse_signed_request($signed_request) {
      list($encoded_sig, $payload) = explode('.', $signed_request, 2); 
    
      $secret = "appsecret"; // Use your app secret here
    
      // decode the data
      $sig = $this->base64_url_decode($encoded_sig);
      $data = json_decode($this->base64_url_decode($payload), true);
    
      // confirm the signature
      $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
      if ($sig !== $expected_sig) {
        error_log('Bad Signed JSON signature!');
        return null;
      }
    
      return $data;
    }
    
    function base64_url_decode($input) {
      return base64_decode(strtr($input, '-_', '+/'));
    }
   /**
    * startSession - Performs all the actions necessary to 
    * initialize this session object. Tries to determine if the
    * the user has logged in already, and sets the variables 
    * accordingly. Also takes advantage of this page load to
    * update the active visitors tables.
    */
   function startSession(){
      global $database, $facebook, $Mx;  //The database connection
      session_start();   //Tell PHP to start the session
        

      
      /* Determine if user is logged in */
      $this->logged_in = $this->checkLogin();
        
        if(($Mx->getSubdomain($_SERVER['HTTP_HOST']) == 'facebook') && (!$this->logged_in)){
        $fb_user = $facebook->getUser();
        if($fb_user){
            $fb_user_profile = $facebook->api('/me');
            $fb_email = $fb_user_profile['email'];
            $fb_token = $facebook->getAccessToken();
            $x_user = $database->getUserInfo($fb_email);
            if($x_user){
                //logging in user
                if($x_user['username'] == $fb_email){
                    $o = $this->fb_login($fb_user, $fb_email, $fb_token);
                    if($o['status'] == 'reload_window'){
                        Header("Location: index.php");
                    }
                }
            }else{
                //register user
                $o = $this->fb_register($fb_user, $fb_email, $fb_token);
                if($o['status'] == 'register_success'){
                    Header("Location: index.php");
                }
            }
        }  
      }
        
      /**
       * Set guest value to users not logged in, and update
       * active guests table accordingly.
       */
       
      if(!$this->logged_in){
         $this->username = $_SESSION['username'] = $database->guest_name;
         $this->userlevel = $database->level_constants['guest_level'];
         $database->addActiveGuest($_SERVER['REMOTE_ADDR'], $this->time);
      }
      /* Update users last active timestamp */
      else{
         $database->addActiveUser($this->username, $this->time);
      }
      
      /* Remove inactive visitors from database */
      $database->removeInactiveUsers();
      $database->removeInactiveGuests();
      
      /* Set referrer page */
      if(isset($_SESSION['url'])){
         $this->referrer = $_SESSION['url'];
      }else{
         $this->referrer = "/";
      }

      /* Set current url */
      $this->url = $_SESSION['url'] = $_SERVER['PHP_SELF'];
   }

   /**
    * checkLogin - Checks if the user has already previously
    * logged in, and a session with the user has already been
    * established. Also checks to see if user has been remembered.
    * If so, the database is queried to make sure of the user's 
    * authenticity. Returns true if the user has logged in.
    */
   
   function getUIDbyUsernameAndUserid($username, $userid){
    global $database;  //The database connection
    $query = mysql_query("SELECT id FROM ".$database->tbl_users_name." WHERE username='$username' AND userid='$userid'");
    $row = mysql_fetch_assoc($query);
    return $row['id'];
   }
   function checkLogin(){
      global $database, $facebook, $Mx;  //The database connection
      
      /* Check if user has been remembered */
      if(isset($_COOKIE['cookname']) && isset($_COOKIE['cookid']) && ($_COOKIE['cookemail'])){
         $this->username = $_SESSION['username'] = $_COOKIE['cookname'];
         $this->userid   = $_SESSION['userid']   = $_COOKIE['cookid'];
         $this->email   = $_SESSION['email']   = $_COOKIE['cookemail'];
      }
      
      /* Username and userid have been set and not guest */
      if(isset($_SESSION['username']) && isset($_SESSION['userid']) && $_SESSION['username'] != $database->guest_name){
         /* Confirm that username and userid are valid */
         if($database->login_using == 'email'){
            $confirm = $database->confirmUserID($_SESSION['email'], $_SESSION['userid']);
         }elseif($database->login_using == 'username'){
            $confirm = $database->confirmUserID($_SESSION['username'], $_SESSION['userid']);
         }
         
         if($confirm != 0){
            /* Variables are incorrect, user not logged in */
            unset($_SESSION['username']);
            unset($_SESSION['userid']);
            unset($_SESSION['email']);
            return false;
        }
         /* User is logged in, set class variables */
         //$this->userinfobyid  = $database->getUserInfoById($this->getUIDbyUsername($_SESSION['username']));
         //$this->userinfobyid = 'a';
         $this->userinfobyid  = $database->getUserInfoById($this->getUIDbyUsernameAndUserid($this->username, $this->userid));
         $this->userrole = $this->userinfobyid['userrole'];
         $this->username  = $this->userinfobyid['username'];
         $this->userid    = $this->userinfobyid['userid'];
         $this->uid    = $this->userinfobyid['id'];
         $this->userlevel = $this->userinfobyid['userlevel'];
         $this->email = $this->userinfobyid['email'];
         $this->userinfo = $this->userinfobyid;
         if($_SESSION['login_using'] == 'facebook'){
            $this->fbinfo = unserialize($database->getSingleColumnById($this->uid, 'fb_array'));
         }
         
         if(isset($_SESSION['login_using'])){
            $this->login_using = $_SESSION['login_using'];
         }
         
         /* auto login hash expires in three days */
         if($this->userinfobyid['hash_generated'] < (time() - (60*60*24*3))){
         	/* Update the hash */
	         $database->updateUserField($this->userinfobyid['username'], 'hash', $this->generateRandID());
	         $database->updateUserField($this->userinfobyid['username'], 'hash_generated', time());
         }
         
         //print_r($this->userinfobyid);
         //exit();
         return true;
      }
      /* User not logged in */
      else{
        
         return false;
      }
   }
   
   function fb_isIdRegistered($fb_id){
        global $database, $form;  //The database and form object
    //$query = mysql_query("SELECT * FROM ". $database->tbl_users_name ." WHERE fb_email='".$fb_email."'");
        
       $q = sprintf("SELECT fb_id FROM ".$database->tbl_users_name." WHERE fb_id = '$fb_id'",
            mysql_real_escape_string($fb_id));
       $result = mysql_query($q, $database->connection);
      
       return (mysql_num_rows($result) > 0);
    
   }
   
   function fb_checkToken($fb_token){
    global $database, $form;  //The database and form object
    //$query = mysql_query("SELECT * FROM ". $database->tbl_users_name ." WHERE fb_email='".$fb_email."'");
        
       
       
       $q = sprintf("SELECT fb_token FROM ".$database->tbl_users_name." WHERE fb_token = '$fb_token'");
       $result = mysql_query($q, $database->connection);
       
       return (mysql_num_rows($result) > 0);
   }
   
   function fb_check_login($fb_id, $fb_email){
    global $database, $form;  //The database and form object
    //$query = mysql_query("SELECT * FROM ". $database->tbl_users_name ." WHERE fb_email='".$fb_email."'");
        if(!get_magic_quotes_gpc()){
          $fb_id = addslashes($fb_id);
       }
       $q = sprintf("SELECT fb_id FROM ".$database->tbl_users_name." WHERE fb_id = '$fb_id' AND username = '$fb_email'",
            mysql_real_escape_string($fb_token));
       $result = mysql_query($q, $database->connection);
       
       return (mysql_num_rows($result) > 0);
   }
   
   function fb_login($fb_id,$fb_email, $fb_token){
    global $database, $form;  //The database and form object
        
        if($this->logged_in){
            $output['status'] = 'logged_in';
        }else{
            $isAlreadyRegistered = $this->fb_isIdRegistered($fb_id);
            $isEmailExists = $database->emailTaken($fb_email);
            
        
            if(($isAlreadyRegistered) && ($isEmailExists)){
                if($this->fb_check_login($fb_id, $fb_email)){
                    $output['status'] = 'logging in user';
                    $retval = $this->login($fb_email, '123456', '1', 'facebook');
                    if($retval == '1'){
                        $output['status'] = 'reload_window';
                    }
                }
            }else if((!$isAlreadyRegistered) && (!$isEmailExists)){
                $output['status'] = 'Registering user';
                $isRegistered = $this->fb_register($fb_id, $fb_email, $fb_token);
                $output['status'] = $isRegistered;
                $output['status'] = 'logging in user';
                $retval = $this->login($fb_email, '123456', '1', 'facebook');
                if($retval == '1'){
                    $output['status'] = 'reload_window';
                }
            }else{
                
            }
            $output['isAlreadyRegistered'] = $isAlreadyRegistered;
            $output['isTokenExists'] = $isTokenExists;
        }
        
        
        
        return $output;
    
   }
   
   function fb_register($fb_id, $fb_email, $fb_token){
    global $database, $form, $facebook, $Mx;  //The database and form object
    
    
       $database->addNewUserByEmail($fb_email, '123456');
       $database->updateUserField($fb_email, 'fb_id', $fb_id);
       $database->updateUserField($fb_email, 'fb_token', $fb_token);
       $database->updateUserField($fb_email, 'fb_email', $fb_email);
       $e = $database->getUserInfo($fb_email);
       $encrypt = $Mx->encrypt_decrypt('encrypt', $e['id']);
       if($database->usernameTaken($fb_email)){
       $params = array(
            'message'       =>  "Saya baru sahaja menyertai program Usahawan Ekspress",
            'name'          =>  "Pendaftaran berjaya",
            'caption'       =>  "Usahawan Ekspress",
            'description'   =>  "Program Usahawan Ekspress",
            'link'          =>  "https://apps.facebook.com/ushawanekspress/".$encrypt,
            'picture'       =>  "http://i.imgur.com/VUBz8.png",
        );
        $post = $facebook->api("/$user/feed","POST",$params);
        $output['facebook'] = $post;
        $output['status'] = 'register_success';
       }else{
        $output['status'] = 'register_error';
       }
       
        
       
       return $output;

    //$database->addNewUserByEmail();
    
   }

   /**
    * login - The user has submitted his username and password
    * through the login form, this function checks the authenticity
    * of that information in the database and creates the session.
    * Effectively logging in the user if all goes well.
    */
   function login($subuser, $subpass, $subremember, $login_using = NULL){
      global $database, $form;  //The database and form object
      
        if($database->login_using == 'email'){
            /* Username error checking */
            $field = "user";  //Use field name for username
            $q = "SELECT valid FROM ".$database->tbl_users_name." WHERE email='$subuser'";
        }elseif($database->login_using == 'username'){
            /* Username error checking */
            $field = "user";  //Use field name for username
            $q = "SELECT valid FROM ".$database->tbl_users_name." WHERE username='$subuser'";
        }
        
      
	  $valid = $database->query($q);
	  $valid = mysql_fetch_array($valid);
      
      
	  	      
      if(!$subuser || strlen($subuser = trim($subuser)) == 0){
         $form->setError($field, "* Username not entered");
      }
      else{
         /* Check if username is not alphanumeric */
         if($database->login_using == 'username'){
            if(!ctype_alnum($subuser)){
                $form->setError($field, "* Username not alphanumeric");
             }
         }
         
      }	  
      
      
        
      /* Password error checking */
      $field = "pass";  //Use field name for password
      if(!$subpass){
         $form->setError($field, "* Password not entered");
      }
      
      /* Return if form errors exist */
      if($form->num_errors > 0){
         return false;
      }
        
      /* Checks that username is in database and password is correct */
      $subuser = stripslashes($subuser);
      $result = $database->confirmUserPass($subuser, md5($subpass));
      
      /* Check error codes */
      if($result == 1){
         $field = "user";
         $form->setError($field, "* Username not found");
      }
      else if($result == 2){
         $field = "pass";
         $form->setError($field, "* Invalid password");
      }
      
      /* Return if form errors exist */
      if($form->num_errors > 0){
         return false;
      }

      
      if(EMAIL_WELCOME){
      	if($valid['valid'] == 0){
      		$form->setError($field, "* User's account has not yet been confirmed.");
      	}
      }
             
      /* Return if form errors exist */
      if($form->num_errors > 0){
         return false;
      }
      
      

      /* Username and password correct, register session variables */
      
      $this->userinfo  = $database->getUserInfo($subuser);
      
      $this->username  = $_SESSION['username'] = $this->userinfo['username'];
      
      $this->email  = $_SESSION['email'] = $this->userinfo['email'];
      
      $this->userid    = $_SESSION['userid']   = $this->generateRandID();
      
      $this->userlevel = $this->userinfo['userlevel'];
      
      /* Insert userid into database and update active users table */
      $database->updateUserField($this->username, "userid", $this->userid);
      $database->addActiveUser($this->username, $this->time);
      $database->removeActiveGuest($_SERVER['REMOTE_ADDR']);
      
      if($login_using == 'facebook'){
        $this->login_using  = $_SESSION['login_using'] = $login_using;
        $url = 'http://graph.facebook.com/'.$this->userinfo['fb_id'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_URL,$url);
        $result = curl_exec($ch);
        curl_close($ch);
        $fb_array = array();
        $result = json_decode($result);
        foreach($result as $a => $b){
            $this->fbinfo[$a] = $b;
            $fb_array[$a] = $b; 
        }
        $database->updateUserFieldById($this->userinfo['id'], 'fb_array', serialize($fb_array));
      }
      
      /**
       * This is the cool part: the user has requested that we remember that
       * he's logged in, so we set two cookies. One to hold his username,
       * and one to hold his random value userid. It expires by the time
       * specified in constants.php. Now, next time he comes to our site, we will
       * log him in automatically, but only if he didn't log out before he left.
       */
      if($subremember){
         setcookie("cookname", $this->username, time()+COOKIE_EXPIRE, COOKIE_PATH);
         setcookie("cookemail", $this->email, time()+COOKIE_EXPIRE, COOKIE_PATH);
         setcookie("cookid",   $this->userid,   time()+COOKIE_EXPIRE, COOKIE_PATH);
      }
       
      
      /* Login completed successfully */
      return true;
   }

   /**
    * logout - Gets called when the user wants to be logged out of the
    * website. It deletes any cookies that were stored on the users
    * computer as a result of him wanting to be remembered, and also
    * unsets session variables and demotes his user level to guest.
    */
   function logout(){
      global $database;  //The database connection
      /**
       * Delete cookies - the time must be in the past,
       * so just negate what you added when creating the
       * cookie.
       */
      if(isset($_COOKIE['cookname']) && isset($_COOKIE['cookid'])){
         setcookie("cookname", "", time()-COOKIE_EXPIRE, COOKIE_PATH);
         setcookie("cookid",   "", time()-COOKIE_EXPIRE, COOKIE_PATH);
         setcookie("cookemail", "", time()-COOKIE_EXPIRE, COOKIE_PATH);
      }

      /* Unset PHP session variables */
      unset($_SESSION['login_using']);
      unset($_SESSION['username']);
      unset($_SESSION['email']);
      unset($_SESSION['userid']);

      /* Reflect fact that user has logged out */
      $this->logged_in = false;
      
      /**
       * Remove from active users table and add to
       * active guests tables.
       */
      $database->removeActiveUser($this->username);
      $database->addActiveGuest($_SERVER['REMOTE_ADDR'], $this->time);
      
      /* Set user level to guest */
      $this->username  = $database->guest_name;
      $this->userlevel = $database->level_constants['guest_level'];
   }
   
   function registerByEmail($email, $subpass){
    global $database, $form;
    /* Username error checking */
      $field = "user";  //Use field name for username
      if(!$email || strlen($email = trim($email)) == 0){
         $form->setError($field, "* Email not entered");
      }
      else{
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE){
            $form->setError($field, "* Email invalid");
         }
         /* Spruce up username, check length */
         $email = stripslashes($email);
         if(strlen($email) < 5){
            $form->setError($field, "* Email below 5 characters");
         }
         else if(strlen($email) > 30){
            $form->setError($field, "* Email above 30 characters");
         }
         /* Check if username is reserved */
         else if(strcasecmp($email, $database->guest_name) == 0){
            $form->setError($field, "* Email reserved word");
         }
         /* Check if username is already in use */
         else if($database->emailTaken($email)){
            $form->setError($field, "* Username already in use");
         }
         
      }
      
      /* Errors exist, have user correct them */
      if($form->num_errors > 0){
         return 1;  //Errors with form
      }
      /* No errors, add the new account to the */
      else{
         if($database->addNewUserByEmail($email, $subpass)){
            if(EMAIL_WELCOME){               
               //$mailer->sendWelcome($subuser,$subemail,$subpass,$randid);
            }
            
            return 0;  //New user added succesfully
         }else{
            return 2;  //Registration attempt failed
         }
      }
   }

   /**
    * register - Gets called when the user has just submitted the
    * registration form. Determines if there were any errors with
    * the entry fields, if so, it records the errors and returns
    * 1. If no errors were found, it registers the new user and
    * returns 0. Returns 2 if registration failed.
    */
   function register($subuser, $subpass, $subemail, $subname){
   
      global $database, $form, $mailer;  //The database, form and mailer object
      
      /* Username error checking */
      $field = "user";  //Use field name for username
      if(!$subuser || strlen($subuser = trim($subuser)) == 0){
         $form->setError($field, "* Username not entered");
      }
      else{

         /* Spruce up username, check length */
         $subuser = stripslashes($subuser);
         if(strlen($subuser) < 5){
            $form->setError($field, "* Username below 5 characters");
         }
         else if(strlen($subuser) > 30){
            $form->setError($field, "* Username above 30 characters");
         }
         /* Check if username is not alphanumeric */
         else if(!ctype_alnum($subuser)){
            $form->setError($field, "* Username not alphanumeric");
         }
         /* Check if username is reserved */
         else if(strcasecmp($subuser, $database->guest_name) == 0){
            $form->setError($field, "* Username reserved word");
         }
         /* Check if username is already in use */
         else if($database->usernameTaken($subuser)){
            $form->setError($field, "* Username already in use");
         }
         /* Check if username is banned */
         else if($database->usernameBanned($subuser)){
            $form->setError($field, "* Username banned");
         }
      }

      /* Password error checking */
      $field = "pass";  //Use field name for password
      if(!$subpass){
         $form->setError($field, "* Password not entered");
      }
      else{
         /* Spruce up password and check length*/
         $subpass = stripslashes($subpass);
         if(strlen($subpass) < 4){
            $form->setError($field, "* Password too short");
         }
         /* Check if password is not alphanumeric */
         else if(!ctype_alnum(($subpass = trim($subpass)))){
            $form->setError($field, "* Password not alphanumeric");
         }
         /**
          * Note: I trimmed the password only after I checked the length
          * because if you fill the password field up with spaces
          * it looks like a lot more characters than 4, so it looks
          * kind of stupid to report "password too short".
          */
      }
      
      /* Email error checking */
      $field = "email";  //Use field name for email
      if(!$subemail || strlen($subemail = trim($subemail)) == 0){
         $form->setError($field, "* Email not entered");
      }
      else{
         /* Check if valid email address */
         if(filter_var($subemail, FILTER_VALIDATE_EMAIL) == FALSE){
            $form->setError($field, "* Email invalid");
         }
         /* Check if email is already in use */
         if($database->emailTaken($subemail)){
            $form->setError($field, "* Email already in use");
         }

         $subemail = stripslashes($subemail);
      }
      
      /* Name error checking */
	  $field = "name";
	  if(!$subname || strlen($subname = trim($subname)) == 0){
	     $form->setError($field, "* Name not entered");
	  } else {
	     $subname = stripslashes($subname);
	  }
      
      $randid = $this->generateRandID();
      
      /* Errors exist, have user correct them */
      if($form->num_errors > 0){
         return 1;  //Errors with form
      }
      /* No errors, add the new account to the */
      else{
         if($database->addNewUser($subuser, md5($subpass), $subemail, $randid, $subname)){
            if(EMAIL_WELCOME){               
               $mailer->sendWelcome($subuser,$subemail,$subpass,$randid);
            }
            return 0;  //New user added succesfully
         }else{
            return 2;  //Registration attempt failed
         }
      }
   }
   
   /**
    * editAccount - Attempts to edit the user's account information
    * including the password, which it first makes sure is correct
    * if entered, if so and the new password is in the right
    * format, the change is made. All other fields are changed
    * automatically.
    */
   function editAccount($subcurpass, $subnewpass, $subemail, $subname){
      global $database, $form;  //The database and form object
      /* New password entered */
      if($subnewpass){
         /* Current Password error checking */
         $field = "curpass";  //Use field name for current password
         if(!$subcurpass){
            $form->setError($field, "* Current Password not entered");
         }
         else{
            /* Check if password too short or is not alphanumeric */
            $subcurpass = stripslashes($subcurpass);
            if(strlen($subcurpass) < 4 ||
               !preg_match("^([0-9a-z])+$", ($subcurpass = trim($subcurpass)))){
               $form->setError($field, "* Current Password incorrect");
            }
            /* Password entered is incorrect */
            if($database->confirmUserPass($this->username,md5($subcurpass)) != 0){
               $form->setError($field, "* Current Password incorrect");
            }
         }
         
         /* New Password error checking */
         $field = "newpass";  //Use field name for new password
         /* Spruce up password and check length*/
         $subpass = stripslashes($subnewpass);
         if(strlen($subnewpass) < 4){
            $form->setError($field, "* New Password too short");
         }
         /* Check if password is not alphanumeric */
         else if(!preg_match("^([0-9a-z])+$", ($subnewpass = trim($subnewpass)))){
            $form->setError($field, "* New Password not alphanumeric");
         }
      }
      /* Change password attempted */
      else if($subcurpass){
         /* New Password error reporting */
         $field = "newpass";  //Use field name for new password
         $form->setError($field, "* New Password not entered");
      }
      
      /* Email error checking */
      $field = "email";  //Use field name for email
      if($subemail && strlen($subemail = trim($subemail)) > 0){
         /* Check if valid email address */
         if(filter_var($subemail, FILTER_VALIDATE_EMAIL) == FALSE){
            $form->setError($field, "* Email invalid");
         }
         $subemail = stripslashes($subemail);
      }
      
      /* Name error checking */
	  $field = "name";
	  if(!$subname || strlen($subname = trim($subname)) == 0){
	     $form->setError($field, "* Name not entered");
	  } else {
	     $subname = stripslashes($subname);
	  }
      
      /* Errors exist, have user correct them */
      if($form->num_errors > 0){
         return false;  //Errors with form
      }
      
      /* Update password since there were no errors */
      if($subcurpass && $subnewpass){
         $database->updateUserField($this->username,"password",md5($subnewpass));
      }
      
      /* Change Email */
      if($subemail){
         $database->updateUserField($this->username,"email",$subemail);
      }
      
      /* Change Name */
      if($subname){
         $database->updateUserField($this->username,"name",$subname);
      }
      
      /* Success! */
      return true;
   }
   
   /**
    * isAdmin - Returns true if currently logged in user is
    * an administrator, false otherwise.
    */
   function isAdmin(){
    global $database;
      return ($this->userlevel == $database->level_constants['admin_level'] ||
              $this->username  == $database->admin_name);
   }
   
   /**
    * isAuthor - Returns true if currently logged in user is
    * an author or an administrator, false otherwise.
    */
   function isAuthor(){
    global $database;
      return ($this->userlevel == AUTHOR_LEVEL ||
              $this->userlevel == $database->level_constants['admin_level']);
   }
   
   /**
    * generateRandID - Generates a string made up of randomized
    * letters (lower and upper case) and digits and returns
    * the md5 hash of it to be used as a userid.
    */
   function generateRandID(){
      return md5($this->generateRandStr(16));
   }
   
   /**
    * generateRandStr - Generates a string made up of randomized
    * letters (lower and upper case) and digits, the length
    * is a specified parameter.
    */
   function generateRandStr($length){
      $randstr = "";
      for($i=0; $i<$length; $i++){
         $randnum = mt_rand(0,61);
         if($randnum < 10){
            $randstr .= chr($randnum+48);
         }else if($randnum < 36){
            $randstr .= chr($randnum+55);
         }else{
            $randstr .= chr($randnum+61);
         }
      }
      return $randstr;
   }
   
   function cleanInput($post = array()) {
       foreach($post as $k => $v){
            $post[$k] = trim(htmlspecialchars($v));
         }
         return $post;
   }
};


/**
 * Initialize session object - This must be initialized before
 * the form object because the form uses session variables,
 * which cannot be accessed unless the session has started.
 */
$session = new Session;

include('Class.Transaction.php');
$Class_Transaction = new Transaction;

include('Class.Unilevel.php');
$Class_unilevel = new Unilevel;



include('Class.Ebooks.php');
$Class_ebooks = new Ebooks;

/* Initialize form object */
$form = new Form;

?>
