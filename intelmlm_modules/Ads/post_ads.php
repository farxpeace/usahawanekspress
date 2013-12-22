<?php
$ads = $_REQUEST['ads'];
$image = $_REQUEST['image'];
$error = array();

/*
//check title
$check_title = $Class_Ads->check_titleanddescription($ads);
if(is_array($check_title)){
    array_push($error, $check_title);
}

//check category
$check_category = $Class_Ads->check_category($ads);
if(is_array($check_category)){
    array_push($error, $check_category);
}
*/

$check_post_ads = $Class_Ads->check_post_ads($ads);
if(is_array($check_post_ads)){
    foreach($check_post_ads as $a => $b){
        array_push($error, $b);
    }
    
}

$check_image = $Class_Ads->check_image($ads['image']);
if(is_array($check_image)){
    foreach($check_image as $a => $b){
        array_push($error, $b);
    }
}

echo '<pre>';
print_r($ads);
print_r($error);
print_r($ads['image']);

if(count($error) == 0){
    
    $insert_ads = $Class_Ads->create_ads_by_userid($ads);
    
    print_r($insert_ads);
    //exit();
    if($insert_ads['operation'] == 'create'){
        
        
        Header("Location: index.php?modules=Ads&op=post_ads_form&adsid=".$insert_ads['adsid']);
    }elseif($insert_ads['operation'] == 'update'){
        Header("Location: index.php?modules=Ads&op=post_ads_form&adsid=".$insert_ads['adsid']);
    }
    
    
}else{
    echo 'error';
}

?>