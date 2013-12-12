<?php
Class Product {
    
    function getProductById($productid){
        $result = mysql_query("SELECT * FROM ".TBL_PRODUCT." WHERE id='$productid'");
        while($row = mysql_fetch_assoc($result)){
            $list = $row;
        }
        
        return $list;
    }
    
    function list_all_category(){
        $result = mysql_query("SELECT * FROM ".TBL_PRODUCT_META." WHERE meta='category'");
        while($row = mysql_fetch_assoc($result)){
            $list[] = array('id' => $row['id'], 'name' => $row['value']);
        }
        print_r($list);
        return $list;
    }
    
    function add_edit_product(){
        global $session;
        $userid = $_REQUEST['id'];
        $edit = $_REQUEST['edit'];
        $add = $_REQUEST['add'];
        if(!$userid){
            $userid = $session->uid;
            Header("Location: ".SYSURL."?modules=Product&op=editproduct&id=$userid");
        }        
        $output = array();
        if($edit == 'yes'){
                
                $output = $this->edit_product($userid);
                $session->referrer = $session->referrer = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";                
            
        }elseif($add == 'yes'){
                        
            $output[add] = 'yes';
            $output['productid'] = $this->add_product();
            $session->referrer = SYSURL."?modules=Product&op=editproduct&id=$output[productid]";            
            
        }
        
                
        return $output;
    }
    
    function add_product(){
        $time = time();
        $productname = 'temporary'.$time;
        $query1 = mysql_query("INSERT INTO ".TBL_PRODUCT." SET productname='".$productname."', create_date='".time()."'");
        $productid = mysql_insert_id();
        return $productid;
        
    }
    function edit_product($productid){
        
        $can_edit = array('productname',);
        $output['status'] = 'ok';
        //echo '<pre>';
        //print_r($_REQUEST);
        foreach($can_edit as $editable){
            
            $data = $_REQUEST[$editable];
            $query = mysql_query("UPDATE ".TBL_PRODUCT." SET $editable='".$data."' WHERE id='".$productid."'"); 
            
        }
        
        return $output;
    }
    
}

?>