<?php

$store = $_REQUEST['store'];
$error = array();

$check_storename = $Class_Ads->check_storename($store['name']);
if(is_array($check_storename)){
    foreach($check_storename as $a => $b){
        array_push($error, $b);
    }
    
}

echo '<pre>';
print_r($store);
print_r($error);

if(count($error) == 0){
    
    $insert_store = $Class_Ads->create_store_by_userid($store);
    
    print_r($insert_store);
    
    if($insert_store['operation'] == 'create'){
        
        
        Header("Location: index.php?modules=Ads&op=mystore&storeid=".$insert_store['storeid']);
    }elseif($insert_store['operation'] == 'update'){
        Header("Location: index.php?modules=Ads&op=mystore&storeid=".$insert_store['storeid']);
    }
    
    
}

?>