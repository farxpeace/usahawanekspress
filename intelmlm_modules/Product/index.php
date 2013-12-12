<?php
$op = $_REQUEST['op'];
include('Class.Product.php');
$Product = new Product;
if($session->logged_in){
    if($op == 'allproduct'){
        include('member_product.php');
    }elseif($op == 'editproduct'){
        $output = $Product->add_edit_product();
        if($output[status] == 'ok'){
            Header("Location: ".$session->referrer);
        }elseif($output['add'] == 'yes'){
            Header("Location: ".$session->referrer);
        }
        include('member_editproduct.php');
    }
}

?>