<?php
$op = $_REQUEST['op'];
if($op == 'getuserinfo'){
    $data = $database->getUserInfoById($_REQUEST['user_id']);
    echo json_encode($data);
    exit();
}elseif($op == 'update_bank'){
    if((is_numeric($_REQUEST['bank_acc'])) && (strlen($_REQUEST['bank_acc']) > 10)){
        $outu['bank_acc'] = $database->updateUserFieldById($session->uid, 'bank_acc', $_REQUEST['bank_acc']);
    }
    if((strlen($_REQUEST['bank_holder']) > 5) && strlen($_REQUEST['bank_holder']) < 30){
        $outu['bank_holder'] = $database->updateUserFieldById($session->uid, 'bank_holder', $_REQUEST['bank_holder']);
    }
    if((strlen($_REQUEST['tel']) >= 10) && (strlen($_REQUEST['tel']) < 12) && (is_numeric($_REQUEST['tel']))){
        $outu['tel'] = $database->updateUserFieldById($session->uid, 'phone', $_REQUEST['tel']);
    }
    
    if(count($outu) == 3){
        $outu['status'] = 'ok'; 
    }else{
        $outu['status'] = 'error'; 
    }
    echo json_encode($outu);
    exit();
}elseif($op == 'getbookinfo'){
    $bookid = $_REQUEST['bookid'];
    include('getbookinfo.php');
    exit();
}
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
    }elseif($op == 'view_pesanan'){
        include('view_pesanan.php');
    }elseif($op == 'pesanan'){
        include('pesanan.php');
    }elseif($op == 'statistik'){
        include('statistik.php');
    }elseif($op == 'kumpulan'){
        include('kumpulan.php');
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