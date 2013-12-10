<?php
include('Class.Users.php');
$Users = new Users;
$op = $_REQUEST['op'];
if($op == ''){
    include('member_users.php');
}elseif($op == 'register'){
    include('guest_register.php');
}elseif($op == 'search'){
    include('member_search.php');
}elseif($op == 'role'){
    include('member_role.php');
}



/*
//Guest page
if($session->userlevel == 0){
    include('guest.php');
}elseif($session->userlevel == 9){
    include('admin.php');
}
*/


?>