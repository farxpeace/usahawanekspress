<?php
/**
 * Database.php
 * 
 * The Database class is meant to simplify the task of accessing
 * information from the website's database.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: June 15, 2011 by Ivan Novak
 */


class MySQLDB
{
   var $connection;         //The MySQL database connection
   var $num_active_users;   //Number of active users viewing site
   var $num_active_guests;  //Number of active guests viewing site
   var $num_members;        //Number of signed-up users
   var $tbl_settings;
   var $tbl_users_name;
   var $tbl_active_users_name;
   var $tbl_active_guest_name;
   var $tbl_banned_users_name;
   var $tbl_mail_name;
   var $const_track_visitors;
   var $const_user_timeout;
   var $const_thm_img;
   var $admin_name;
   var $guest_name;
   var $level_constants = array();
   var $login_using;
   /* Note: call getNumMembers() to access $num_members! */

   /* Class constructor */
   function MySQLDB(){
      /* Make connection to database */
      $this->connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
      mysql_select_db(DB_NAME, $this->connection) or die(mysql_error());
      
      /**
       * Only query database to find out number of members
       * when getNumMembers() is called for the first time,
       * until then, default value set.
       */
      $this->num_members = -1;
      
      //Set table
      $this->tbl_users_name = $this->process_db_users();
      $this->tbl_active_users_name = $this->process_db_active_users();
      $this->tbl_active_guest_name = $this->process_db_active_guest();
      $this->tbl_banned_users_name = $this->process_db_banned_users();
      $this->tbl_mail_name = $this->process_db_mail();
      $this->tbl_files_name = $this->getSingleValueByMetaAndRef('tbl_name', 'files');
      $this->tbl_store = $this->getSingleValueByMetaAndRef('tbl_name', 'store');
      $this->const_track_visitors = $this->process_track_visitors();
      $this->const_user_timeout = $this->process_user_timeout();
      $this->const_thm_img = $this->getSingleValueByMetaAndRef('constants', 'theme_img');
      $this->tbl_ads_name = $this->process_db_ads();
      $this->admin_name = $this->getSingleValueByMetaAndRef('level_name', 'admin_name');
      $this->guest_name = $this->getSingleValueByMetaAndRef('level_name', 'guest_name');
      $this->process_level_constants();
      $this->login_using = $this->getSingleValueByMetaAndRef('system', 'login_using');
      
      
      if($this->const_track_visitors){
         /* Calculate number of users at site */
         $this->calcNumActiveUsers();
      
         /* Calculate number of guests at site */
         $this->calcNumActiveGuests();
      }
   }
   function process_level_constants(){
        $tbldata = $this->getAllMetaValueByRef('level_constants');
        foreach($tbldata as $a => $b){
            $this->level_constants[$a] = $b;
        }
        //print_r($tbldata);
   }
   
   function process_db_active_users(){
        $tblname = $this->getSingleValueByMetaAndRef('tbl_name', 'active_users');
        return $tblname;
   }
   
   function getAllMetaValueByRef($ref){
        $q = "SELECT value,meta FROM ".TBL_SETTINGS." WHERE ref='".$ref."'";
        $result = mysql_query($q);
        while($row = mysql_fetch_assoc($result)){
            $list[$row['meta']] = $row['value'];
        }
        return $list;
        
    }
    
    function getAllIdMetaValueByRef($ref){
        $q = "SELECT id,value,meta FROM ".TBL_SETTINGS." WHERE ref='".$ref."'";
        $result = mysql_query($q);
        while($row = mysql_fetch_assoc($result)){
            $list[] = $row;
        }
        return $list;
        
    }
    
    function getAllValueByRef($ref){
        $q = "SELECT id,value,meta FROM ".TBL_SETTINGS." WHERE ref='".$ref."'";
        $result = mysql_query($q);
        while($row = mysql_fetch_assoc($result)){
            $list[$row['id']] = array($row['meta'] => $row['value']);
        }
        return $list;
        
    }
    
    function getAllValueByRefAndMeta($ref, $meta){
        $q = "SELECT id,value FROM ".TBL_SETTINGS." WHERE ref='".$ref."' AND meta='".$meta."'";
        $result = mysql_query($q);
        while($row = mysql_fetch_assoc($result)){
            $list[$row['id']] = $row['value'];
        }
        return $list;
        
    }
   
   
    function getSingleValueByMetaAndRef($ref, $meta){
        $q = "SELECT value FROM ".TBL_SETTINGS." WHERE ref='".$ref."' AND meta='".$meta."'";
        $result = mysql_query($q);
        $row = mysql_fetch_assoc($result);
        return $row['value'];
        
    }
    
   function getSingleIdByMetaAndRef($ref, $meta){
        $q = "SELECT id FROM ".TBL_SETTINGS." WHERE ref='".$ref."' AND meta='".$meta."'";
        $result = mysql_query($q);
        $row = mysql_fetch_assoc($result);
        return $row['id'];
        
   }
   
   function getSingleMetaByRefAndValue($ref, $value){
        $q = "SELECT meta FROM ".TBL_SETTINGS." WHERE ref='".$ref."' AND value='".$value."'";
        $result = mysql_query($q);
        $row = mysql_fetch_assoc($result);
        return $row['meta'];
        
   }
   
   function process_db_users(){
        $tblname = $this->getSingleValueByMetaAndRef('tbl_name', 'users');
        return $tblname;
   }
   
   function process_db_active_guest(){
        $tblname = $this->getSingleValueByMetaAndRef('tbl_name', 'active_guest');
        return $tblname;
   }
   
   function process_db_banned_users(){
        $tblname = $this->getSingleValueByMetaAndRef('tbl_name', 'banned_users');
        return $tblname;
   }
   function process_db_mail(){
        $tblname = $this->getSingleValueByMetaAndRef('tbl_name', 'mail');
        return $tblname;
   }
   
   function process_track_visitors(){
        $tblname = $this->getSingleValueByMetaAndRef('constants', 'track_visitors');
        return $tblname;
   }
   
   function process_user_timeout(){
        $tblname = $this->getSingleValueByMetaAndRef('constants', 'user_timeout');
        return $tblname;
   }
   function process_db_ads(){
        $tblname = $this->getSingleValueByMetaAndRef('tbl_name', 'ads');
        return $tblname;
   }
   
   

   /**
    * confirmUserPass - Checks whether or not the given
    * username is in the database, if so it checks if the
    * given password is the same password in the database
    * for that user. If the user doesn't exist or if the
    * passwords don't match up, it returns an error code
    * (1 or 2). On success it returns 0.
    */
   function confirmUserPass($username, $password){
      /* Add slashes if necessary (for query) */
      if(!get_magic_quotes_gpc()) {
	      $username = addslashes($username);
      }
        
      /* Verify that user is in database */
      $q = sprintf("SELECT password FROM ".$this->tbl_users_name." where ".$this->login_using." = '%s'",
            mysql_real_escape_string($username));
      $result = mysql_query($q, $this->connection);
      if(!$result || (mysql_numrows($result) < 1)){
         return 1; //Indicates username failure
      }

      /* Retrieve password from result, strip slashes */
      $dbarray = mysql_fetch_array($result);
      $dbarray['password'] = stripslashes($dbarray['password']);
      $password = stripslashes($password);

      /* Validate that password is correct */
      if($password == $dbarray['password']){
         return 0; //Success! Username and password confirmed
      }
      else{
         return 2; //Indicates password failure
      }
   }
   
   /**
    * confirmUserID - Checks whether or not the given
    * username is in the database, if so it checks if the
    * given userid is the same userid in the database
    * for that user. If the user doesn't exist or if the
    * userids don't match up, it returns an error code
    * (1 or 2). On success it returns 0.
    */
   function confirmUserID($username, $userid){
      /* Add slashes if necessary (for query) */
      if(!get_magic_quotes_gpc()) {
	      $username = addslashes($username);
      }
      
      

      /* Verify that user is in database */
      $q = sprintf("SELECT userid FROM ".$this->tbl_users_name." WHERE ".$this->login_using."= '%s'",
            mysql_real_escape_string($username));
      $result = mysql_query($q, $this->connection);
      if(!$result || (mysql_numrows($result) < 1)){
         return 1; //Indicates username failure
      }

      /* Retrieve userid from result, strip slashes */
      $dbarray = mysql_fetch_array($result);
      $dbarray['userid'] = stripslashes($dbarray['userid']);
      $userid = stripslashes($userid);

      /* Validate that userid is correct */
      if($userid == $dbarray['userid']){
         return 0; //Success! Username and userid confirmed
      }
      else{
         return 2; //Indicates userid invalid
      }
   }
   
   /**
    * usernameTaken - Returns true if the username has
    * been taken by another user, false otherwise.
    */
   function usernameTaken($username){
      if(!get_magic_quotes_gpc()){
         $username = addslashes($username);
      }
      $q = sprintf("SELECT username FROM ".$this->tbl_users_name." WHERE username = '%s'",
            mysql_real_escape_string($username));
      $result = mysql_query($q, $this->connection);
      return (mysql_numrows($result) > 0);
   }
   
   
   
   
   /**
    * emailTaken - Returns true if the email has
    * been taken by another user, false otherwise.
    */
    function emailTaken($email){
       if(!get_magic_quotes_gpc()){
          $email = addslashes($email);
       }
       $q = sprintf("SELECT email FROM ".$this->tbl_users_name." WHERE email = '%s'",
            mysql_real_escape_string($email));
       $result = mysql_query($q, $this->connection);
       return (mysql_num_rows($result) > 0);
    }
    
   /**
    * usernameBanned - Returns true if the username has
    * been banned by the administrator.
    */
   function usernameBanned($username){
      if(!get_magic_quotes_gpc()){
         $username = addslashes($username);
      }
      $q = sprintf("SELECT username FROM ".$this->tbl_banned_users_name." WHERE username = '%s'",
            mysql_real_escape_string($username));
      $result = mysql_query($q, $this->connection);
      return (mysql_numrows($result) > 0);
   }
   function addNewUserByEmail($email, $password){
    $time = time();
      /* If admin sign up, give admin user level */
      
      $md5 = md5($password);
       $q = sprintf("INSERT INTO ".$this->tbl_users_name." (
            username,
            password,
            bpassword,
            userid, 
            userlevel, 
            email, 
            timestamp, 
            valid
       )VALUES(
            '".mysql_real_escape_string($email)."',
            '".mysql_real_escape_string($md5)."',
            '".mysql_real_escape_string($password)."',
            '".mysql_real_escape_string($time)."',
            '".mysql_real_escape_string('1')."',
            '".mysql_real_escape_string($email)."',
            '".mysql_real_escape_string($time)."',
            '".mysql_real_escape_string('1')."'
       )");
            
      return mysql_query($q, $this->connection);
   }
   /**
    * addNewUser - Inserts the given (username, password, email)
    * info into the database. Appropriate user level is set.
    * Returns true on success, false otherwise.
    */
   function addNewUser($username, $password, $email, $userid, $name){
    
      $time = time();
      /* If admin sign up, give admin user level */
      if(strcasecmp($username, $this->admin_name) == 0){
         $ulevel = $this->level_constants['admin_level'];
      }else{
         $ulevel = $this->level_constants['user_level'];
      }
       $q = sprintf("INSERT INTO ".$this->tbl_users_name." VALUES ('%s', '%s', '%s', '%s', '%s', $time, '0', '%s', '0', '0')",
            mysql_real_escape_string($username),
            mysql_real_escape_string($password),
            mysql_real_escape_string($userid),
            mysql_real_escape_string($ulevel),
            mysql_real_escape_string($email),
            mysql_real_escape_string($name));
      return mysql_query($q, $this->connection);
   }
   
   /**
    * updateUserField - Updates a field, specified by the field
    * parameter, in the user's row of the database.
    */
   function updateUserField($username, $field, $value){
      $q = sprintf("UPDATE ".$this->tbl_users_name." SET %s = '%s' WHERE username = '%s'",
            mysql_real_escape_string($field),
            mysql_real_escape_string($value),
            mysql_real_escape_string($username));
      return mysql_query($q, $this->connection);
   }
   
   /**
    * getUserInfo - Returns the result array from a mysql
    * query asking for all information stored regarding
    * the given username. If query fails, NULL is returned.
    */
    
   function getUserInfo($username){
      $q = sprintf("SELECT * FROM ".$this->tbl_users_name." WHERE ".$this->login_using." = '%s'",
            mysql_real_escape_string($username));
      $result = mysql_query($q, $this->connection);
      /* Error occurred, return given name by default */
      if(!$result || (mysql_numrows($result) < 1)){
         return NULL;
      }
      /* Return result array */
      $dbarray = mysql_fetch_assoc($result);
      return $dbarray;
   }
   function getUserInfoById($uid){
      $q = sprintf("SELECT * FROM ".$this->tbl_users_name." WHERE id = '$uid'",
            mysql_real_escape_string($uid));
      $result = mysql_query($q, $this->connection);
      /* Error occurred, return given name by default */
      if(!$result || (mysql_numrows($result) < 1)){
         return NULL;
      }
      /* Return result array */
      $dbarray = mysql_fetch_assoc($result);
      return $dbarray;
   }
   
   function getSingleUserDetailById($uid, $column){
    
      $q = sprintf("SELECT ".$column." FROM ".$this->tbl_users_name." WHERE id = '$uid'",
            mysql_real_escape_string($uid));
      $result = mysql_query($q, $this->connection);
      /* Error occurred, return given name by default */
      if(!$result || (mysql_numrows($result) < 1)){
         return NULL;
      }
      
      /* Return result array */
      $dbarray = mysql_fetch_assoc($result);
      //print_r($dbarray);
      return $dbarray[$column];
   }
   
   
   function getUserInfo_by_id($id){
      $q = sprintf("SELECT * FROM ".$this->tbl_users_name." WHERE id = '$id'",
            mysql_real_escape_string($username));
      $result = mysql_query($q, $this->connection);
      /* Error occurred, return given name by default */
      if(!$result || (mysql_numrows($result) < 1)){
         return NULL;
      }
      /* Return result array */
      $dbarray = mysql_fetch_assoc($result);
      return $dbarray;
   }
   
   
   
   
   function getUserInfoFromHash($hash){
   		$q = sprintf("SELECT * FROM ".$this->tbl_users_name." WHERE hash = '%s'",
   				mysql_real_escape_string($hash));
   		$result = mysql_query($q, $this->connection);
   		if(!$result || (mysql_num_rows($result) < 1)){
   			return NULL;
   		}
   		$dbarray = mysql_fetch_array($result);
   		return $dbarray;
   }
   
   function get_allvalue_by_ref($ref){
        $q = "SELECT * FROM ".TBL_METATAG." WHERE ref='".$ref."'";
        $result = mysql_query($q);
        while($row = mysql_fetch_assoc($result)){
            $output[] = $row;
        }
        return $output;
   }
   
   
   
   function get_all_role_by_roleid($roleid){
        $result = mysql_query("SELECT * FROM ".TBL_ROLE_META." WHERE roleid='".$roleid."'");
        while($row = mysql_fetch_assoc($result)){
            if(!empty($row)){
                $output[] = $row;
            }
            
        }
        return $output;
   }
   
   
   
   
   
   /**
    * getNumMembers - Returns the number of signed-up users
    * of the website, banned members not included. The first
    * time the function is called on page load, the database
    * is queried, on subsequent calls, the stored result
    * is returned. This is to improve efficiency, effectively
    * not querying the database when no call is made.
    */
   function getNumMembers(){
      if($this->num_members < 0){
         $q = "SELECT * FROM ".$this->tbl_users_name;
         $result = mysql_query($q, $this->connection);
         $this->num_members = mysql_numrows($result);
      }
      return $this->num_members;
   }
   
   /**
    * calcNumActiveUsers - Finds out how many active users
    * are viewing site and sets class variable accordingly.
    */
   function calcNumActiveUsers(){
      /* Calculate number of users at site */
      $q = "SELECT * FROM ".$this->tbl_active_users_name;
      $result = mysql_query($q, $this->connection);
      $this->num_active_users = mysql_numrows($result);
   }
   
   /**
    * calcNumActiveGuests - Finds out how many active guests
    * are viewing site and sets class variable accordingly.
    */
   function calcNumActiveGuests(){
      /* Calculate number of guests at site */
      $q = "SELECT * FROM ".$this->tbl_active_guest_name;
      $result = mysql_query($q, $this->connection);
      $this->num_active_guests = mysql_numrows($result);
   }
   
   /**
    * addActiveUser - Updates username's last active timestamp
    * in the database, and also adds him to the table of
    * active users, or updates timestamp if already there.
    */
   function addActiveUser($username, $time){
      $q = sprintf("UPDATE ".$this->tbl_users_name." SET timestamp = '%s' WHERE username = '%s'",
            mysql_real_escape_string($time),
            mysql_real_escape_string($username));
      mysql_query($q, $this->connection);
      
      if(!$this->const_track_visitors) return;
      $q = sprintf("REPLACE INTO ".$this->tbl_active_users_name." VALUES ('%s', '%s')",
            mysql_real_escape_string($username),
            mysql_real_escape_string($time));
      mysql_query($q, $this->connection);
      $this->calcNumActiveUsers();
   }
   
   /* addActiveGuest - Adds guest to active guests table */
   function addActiveGuest($ip, $time){
      if(!$this->const_track_visitors) return;
      $q = sprintf("REPLACE INTO ".$this->tbl_active_guest_name." VALUES ('%s', '%s')",
            mysql_real_escape_string($ip),
            mysql_real_escape_string($time));
      mysql_query($q, $this->connection);
      $this->calcNumActiveGuests();
   }
   
   /* These functions are self explanatory, no need for comments */
   
   /* removeActiveUser */
   function removeActiveUser($username){
      if(!$this->const_track_visitors) return;
      $q = sprintf("DELETE FROM ".$this->tbl_active_users_name." WHERE username = '%s'",
            mysql_real_escape_string($username));
      mysql_query($q, $this->connection);
      $this->calcNumActiveUsers();
   }
   
   /* removeActiveGuest */
   function removeActiveGuest($ip){
      if(!$this->const_track_visitors) return;
      $q = sprintf("DELETE FROM ".$this->tbl_active_guest_name." WHERE ip = '$ip'",
            mysql_real_escape_string($ip));
      mysql_query($q, $this->connection);
      $this->calcNumActiveGuests();
   }
   
   /* removeInactiveUsers */
   function removeInactiveUsers(){
      if(!$this->const_track_visitors) return;
      $timeout = time()-$this->const_user_timeout*60;
      $q = sprintf("DELETE FROM ".$this->tbl_active_users_name." WHERE timestamp < %s", 
            mysql_real_escape_string($timeout));
      mysql_query($q, $this->connection);
      $this->calcNumActiveUsers();
   }

   /* removeInactiveGuests */
   function removeInactiveGuests(){
      if(!$this->const_track_visitors) return;
      $timeout = time()-GUEST_TIMEOUT*60;
      $q = sprintf("DELETE FROM ".$this->tbl_active_guest_name." WHERE timestamp < %s",
            mysql_real_escape_string($timeout));
      mysql_query($q, $this->connection);
      $this->calcNumActiveGuests();
   }
   
   /**
    * query - Performs the given query on the database and
    * returns the result, which may be false, true or a
    * resource identifier.
    */
   function query($query){
      return mysql_query($query, $this->connection);
   }
};

/* Create database connection */
$database = new MySQLDB;

?>
