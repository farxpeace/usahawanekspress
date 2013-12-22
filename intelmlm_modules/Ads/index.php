<?php

$op = $_REQUEST['op'];

if($op == 'post_ads_form'){
    include('form_post_ads.php');
}elseif($op == 'post_ads'){
    include('post_ads.php');
}elseif($op == 'post_new_store'){
    include('post_new_store.php');
}elseif($op == 'view_ads'){
    include('view_ads.php');
}elseif($op == 'view_store'){
    include('view_store.php');

}elseif($op == 'mystore'){
    include('mystore.php');
}elseif($op == 'myads'){
    include('my_ads.php');
}

?>