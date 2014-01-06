<?php
$payment = $_REQUEST['bayar'];
$trx_ref = $_REQUEST['trx_ref'];
$upload_id = $_REQUEST['upload_id'];

foreach($payment as $upline_id => $bayar){
    
    $array = array(
        'trx_ref'   => $trx_ref,
        'rcx_uid'   => $upline_id,
        'trx_uid'   => $session->uid,
        'trx_type'  => 'pendaftaran',
        'status'    => 'waiting_for_payment'
    );
    
    $tarikh = explode(" ", $bayar['tarikh']);
    $tarikh = implode('-',$tarikh);
    
    //print_r($Class_Transaction->getSingleTransaction($array));
    //print_r($Class_Transaction->getSingle($array));
    $isExists = $Class_Transaction->getSingle($array);
    if($isExists){
        $update = $Class_Transaction->update(array(
            'column'    => array(
                'status' => 'paid'
            ),
            'where'     => array(
                'trx_ref'   => $trx_ref,
                'rcx_uid'   => $upline_id,
                'trx_uid'   => $session->uid
            )
        ));
        
        
        
        if($update){
            if($upload_id){
                $Class_Transaction->createMeta($isExists['trx_ref'], 'upload_id', $upload_id);
            }
            
            $Class_Transaction->createMeta($isExists['trx_ref'], 'payment_date', $bayar['tarikh']);
            $Class_Transaction->createMeta($isExists['trx_ref'], 'payment_time', $bayar['masa']);
            $Class_Transaction->createMeta($isExists['trx_ref'], 'payment_reference', $bayar['rujukan']);
            $Class_Transaction->createMeta($isExists['trx_ref'], 'status', 'paid');
            
            $array = array(
                'rcx_uid'   => $upline_id,
                'trx_uid'   => $session->uid,
                'trx_type'  => 'pendaftaran',
                'status'    => 'paid'
            );
            $output['id']   = $isExists['id'];
            $output['payment_date'] = $Class_Transaction->getSingleValueByRefMeta($isExists['trx_ref'], 'payment_date');
            $output['payment_time'] = $Class_Transaction->getSingleValueByRefMeta($isExists['trx_ref'], 'payment_time');
            $output['payment_reference'] = $Class_Transaction->getSingleValueByRefMeta($isExists['trx_ref'], 'payment_reference');
            $output['payment_status'] = 'paid';
            $output['status'] = 'success';
        }
        
        
        //check status
        $count = $session->userinfo['pakej']/2;
        
        $uplineList = $Class_unilevel->getAllUplineIdByUplineId($session->userinfo['uplineid'], $count);
        //print_r($uplineList);
        foreach($uplineList as $upline => $uplineInfo){
            
            $upline_trx = $Class_Transaction->getSingleTransaction(array(
                'trx_ref'   => 'user'.$session->uid.'_upline'.$uplineInfo['id'],
                'trx_type'  => 'pendaftaran'
            ), 'status');
            if($upline_trx == 'paid'){
                $upline_paid[] = $uplineInfo['id'];
            }
        }
        
        
        if(count($upline_paid) == $count){
            $database->updateUserFieldById($session->uid, 'userlevel', '3');
            $output['user_status'] = 'verified';
        }else{
            $output['user_status'] = 'unverified';
        }
        
        
        //
        $need_update = array();
        $vcx_user = $database->getUserInfoById($session->uid);
        if((!is_numeric($vcx_user['bank_acc'])) || (strlen($vcx_user['bank_acc']) != 12)){
            $need_update[] = 'bank_acc';
        }
        if((!is_numeric($vcx_user['phone'])) || (strlen($vcx_user['phone']) < 10) || (strlen($vcx_user['phone']) > 14)){
            $need_update[] = 'phone';
        }
        
        if(count($need_update) == 0){
            $output['need_update'] = 'no';
        }else{
            $output['need_update'] = 'yes';
        }
        
    }else{
        $output['status'] = 'error';
    }
}

echo json_encode($output);



exit();
?>