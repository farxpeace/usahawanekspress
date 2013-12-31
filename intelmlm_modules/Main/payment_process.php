<?php
$payment = $_REQUEST['bayar'];

foreach($payment as $upline_id => $bayar){
    
    $array = array(
        'rcx_uid'   => $upline_id,
        'trx_uid'   => $session->uid,
        'trx_type'  => 'pendaftaran',
        'status'    => 'waiting_for_payment'
    );
    
    $tarikh = explode(" ", $bayar['tarikh']);
    $tarikh = implode('-',$tarikh);
    
    
    //$isExists = $Class_Transaction->getSingle($array);
    if($isExists){
        $update = $Class_Transaction->update(array(
            'column'    => array(
                'status' => 'paid'
            ),
            'where'     => array(
                'rcx_uid'   => $upline_id,
                'trx_uid'   => $session->uid
            )
        ));
        
        if($update){
            $Class_Transaction->createMeta($isExists['id'], 'payment_date', $bayar['tarikh']);
            $Class_Transaction->createMeta($isExists['id'], 'payment_time', $bayar['masa']);
            $Class_Transaction->createMeta($isExists['id'], 'payment_reference', $bayar['rujukan']);
            
            $array = array(
                'rcx_uid'   => $upline_id,
                'trx_uid'   => $session->uid,
                'trx_type'  => 'pendaftaran',
                'status'    => 'paid'
            );
            $output['id']   = $isExists['id'];
            $output['payment_date'] = $Class_Transaction->getSingleValueByRefMeta($isExists['id'], 'payment_date');
            $output['payment_time'] = $Class_Transaction->getSingleValueByRefMeta($isExists['id'], 'payment_time');
            $output['payment_reference'] = $Class_Transaction->getSingleValueByRefMeta($isExists['id'], 'payment_reference');
            $output['payment_status'] = 'success';
        }
    }else{
        $output['payment_status'] = 'error';
    }
}

echo json_encode($output);



exit();
?>