<?php
$op = $_REQUEST['op'];

if($op == ''){
    include('guest_main.php');
}elseif($op == 'register'){
    include('guest_register.php');
}


?>