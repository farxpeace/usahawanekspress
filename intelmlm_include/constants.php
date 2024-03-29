<?php

/**
 * Constants.php
 *
 * This file is intended to group all constants to
 * make it easier for the site administrator to tweak
 * the login script.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 2, 2009 by Ivan Novak
 */




/**
 * Database Constants - these constants are required
 * in order for there to be a successful connection
 * to the MySQL database. Make sure the information is
 * correct.
 */
$whitelist = array('127.0.0.1', 'localhost', '::1');
if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "123456");
    define("DB_NAME", "intelmlm");
}else{
    define("DB_SERVER", "sql4.freesqldatabase.com");
    define("DB_USER", "sql424404");
    define("DB_PASS", "kT1*zQ5*");
    define("DB_NAME", "sql424404");
}







#define("FOLDER_INCLUDE", "intelmlm_include");

/**
 * Database Table Constants - these constants
 * hold the names of all the database tables used
 * in the script.
 */
 define("TBL_SETTINGS", "intelmlm_settings");


/**
 * Special Names and Level Constants - the admin
 * page will only be accessible to the user with
 * the admin name and also to those users at the
 * admin user level. Feel free to change the names
 * and level constants as you see fit, you may
 * also add additional level specifications.
 * Levels must be digits between 0-9.
 */
#define("ADMIN_NAME", "admin");
#define("GUEST_NAME", "Guest");
define("ADMIN_LEVEL", 9);
define("AUTHOR_LEVEL", 5);
define("USER_LEVEL",  1);
define("GUEST_LEVEL", 0);

/**
 * This boolean constant controls whether or
 * not the script keeps track of active users
 * and active guests who are visiting the site.
 */
#define("TRACK_VISITORS", true);

/**
 * Timeout Constants - these constants refer to
 * the maximum amount of time (in minutes) after
 * their last page fresh that a user and guest
 * are still considered active visitors.
 */
define("USER_TIMEOUT", 10);
define("GUEST_TIMEOUT", 5);

/**
 * Cookie Constants - these are the parameters
 * to the setcookie function call, change them
 * if necessary to fit your website. If you need
 * help, visit www.php.net for more info.
 * <http://www.php.net/manual/en/function.setcookie.php>
 */
define("COOKIE_EXPIRE", 60*60*24*100);  //100 days by default
define("COOKIE_PATH", "/");  //Avaible in whole domain

/**
 * Email Constants - these specify what goes in
 * the from field in the emails that the script
 * sends to users, and whether to send a
 * welcome email to newly registered users.
 */
define("EMAIL_FROM_NAME", "Intel MLM");
define("EMAIL_FROM_ADDR", "intelmlm@gmail.com");
define("EMAIL_WELCOME", true);

/**
 * This constant forces all users to have
 * lowercase usernames, capital letters are
 * converted automatically.
 */
define("ALL_LOWERCASE", false);

/**
 * This defines the absolute path
 */
define("ABSPATH", dirname(__FILE__).'/');

/**
 * This boolean constant controls wheter or
 * not the user to user mail function is active
 */
define("MAIL", true)
?>
