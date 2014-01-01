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
$check_db = $Class_Transaction->getSingleTransactionByType($session->uid, $upline_id, $type, $status);
$database->updateUserFieldById($session->uid, 'pakej', $pakej);
if(!$check_db){
    $trxid = $Class_Transaction->createTransaction($session->uid, $upline_id, $amount, $book_id, $type, $status);
    $check_db = $Class_Transaction->getSingleTransactionByType($session->uid, $upline_id, $type, $status);
    
}





    echo json_encode(array(
        'upline_id' => $upline_id,
        'status'    => $status,
        'user_id'   => $session->uid,
        'trx_id'    => $trxid,
        'trx_date'  => $Mx->timestamp_to_date($check_db['trx_date'], 'd M Y'),
        'trx_invoice'  => $check_db['trx_date'],
        'trx_ref'   => $check_db['trx_ref']
    ));



exit();

?>