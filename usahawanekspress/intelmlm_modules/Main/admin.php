<?php
$op = $_REQUEST['op'];
if($op == ''){
    include('admin_main.php');
}elseif($op == 'register'){
    include('guest_register.php');
}
?>