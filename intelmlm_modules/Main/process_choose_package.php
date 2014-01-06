<?php
$package = $_REQUEST['package'];



$package['dbpakej'] = ($session->userinfo['pakej'] == NULL ? 'ok' : 'error');
$package['login']   =  ($session->logged_in ? 'ok' : 'error');


$isValid = GUMP::is_valid($package, array(
    'package' => 'required|alpha_numeric',
    'tel' => 'required|max_len,13|min_len,10|numeric',
    'dbpakej'   => 'contains,ok',
    'login' =>  'contains,ok'
));



if($isValid == 1){
    
        $update = $database->updateUserFieldById($session->uid, 'phone', $package['tel']);
        $updatepakej = $database->updateUserFieldById($session->uid, 'pakej', $package['package']);
    
    
    
    $output['pakej'] = $package['package'];
    $output['status'] = 'success';
}else{
    $output['status'] = 'error';
    $output['error'] = $isValid;
}

echo json_encode($output);


?>