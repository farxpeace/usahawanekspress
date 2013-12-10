<?php

$op = $_REQUEST['op'];
if($op == ''){
    include('member_main.php');
}elseif($op == 'register'){
    include('guest_register.php');
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