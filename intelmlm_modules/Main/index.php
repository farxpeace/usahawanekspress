<?php
$op = $_REQUEST['op'];

if(!$session->logged_in){
    if($op == ''){
        include('guest_main.php');
    }elseif($op == 'register'){
        include('guest_main.php');
    }elseif($op == 'choose_product'){
        include('choose_product.php');
    }
}else{
    if($op == ''){
        include('guest_main.php');
    }elseif($op == 'account'){
        include('my_account.php');
    }elseif($op == 'checkout_process'){
        include('checkout_process.php');
    }elseif($op == 'payment_process'){
        include('payment_process.php');
    }
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