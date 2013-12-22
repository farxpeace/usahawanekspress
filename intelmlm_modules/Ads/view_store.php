<?php
include(THEME_LOC."/main_header.php");
$storeid = $_REQUEST['storeid'];
if($Class_Ads->check_storeid_is_valid_userid($storeid, $session->uid)){
    $Class_Ads->store['id'] = $storeid;
    //$edit_ads = $Class_Ads->create_ads_by_userid();
    //print_r($Class_Ads);
    //exit();
    $store = $Class_Ads->get_store_by_storeid();
    
    print_r($store);
    //exit();
}
?>

<div class="grid fluid" style="padding: 10px;">
    <div class="row">
        
        <div class="span12">
        
        
        </div>
    </div>
</div>