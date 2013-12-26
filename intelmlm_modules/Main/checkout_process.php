<?php
$pakej = $_REQUEST['pakej'];
$order = $_REQUEST['order'];


$i = 0;
$amount = 0;
foreach($order['ebook'] as $upline_id => $ebook_id){
    foreach($ebook_id as $count => $bookid){
        if($bookid != '0'){
            $ordered_book_id[] = $bookid;
            $amount = $amount+10;
        }
    }
}

$book_id = implode(',',$ordered_book_id);
$error = array();
$type = 'pendaftaran';
$status = 'waiting_for_payment';
$check_db = $database->getSingleTransactionByType($session->uid, $upline_id, $type, $status);
if(!$check_db){
    $trxid = $database->createTransaction($session->uid, $upline_id, $amount, $book_id, $type, $status);
    echo json_encode(array(
        'upline_id' => $upline_id,
        'status'    => $status,
        'user_id'   => $session->uid,
        'trx_id'    => $trxid
    ));
}else{
    echo json_encode(array(
        'upline_id' => $upline_id,
        'status'    => 'already_waiting_for_payment',
        'user_id'   => $session->uid
    ));
}



exit();

?>