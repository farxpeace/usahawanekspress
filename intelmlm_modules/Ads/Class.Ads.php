<?php
Class Ads {
    var $ref;
    var $ads;
    var $store;     //Hold store information
    var $default_ads_image = 'default_ads_image.png';
    
    function __construct($adsid = null){
        $this->ref = __CLASS__;
        if($ads['id']){
            $this->ads[id] = $ads['id'];
        }
        
    }
//Check store
    function check_storeid_is_valid_userid($storeid, $userid){
        global $session, $database;
        $query = mysql_query("SELECT id FROM ".$database->tbl_store." WHERE id='".$storeid."' AND userid='".$userid."'");
        $numrow = mysql_num_rows($query);
        if($numrow == 1){
            $output = true;
        }else{
            $output = false;
        }
        
        return $output;
    }
//Create Store
    function check_storename($storename){
        global $session, $database;
        $store = array('name' => $storename);
        $is_valid = GUMP::is_valid($store, array(
            'name' => 'required|max_len,100|min_len,6'
        ));
        
        return $is_valid;
        
    }
    function create_store_by_userid($store = null){
        global $session, $database;
        
        if($store['id'] == null){  
            //default store_status;
            $store_id = $database->getSingleIdByMetaAndRef('store_level', 'enterprise');
            
            $query = mysql_query("INSERT INTO ".$database->tbl_store." (
                userid,
                store_name,
                create_date,
                store_level,
                store_status
            )VALUES(
                '".$session->uid."',
                '".$store['name']."',
                '".time()."',
                '".$store_id."',
                'need_admin_approval'
            )");
            $store_status['operation'] = 'create';
            $store_id = mysql_insert_id();
            $this->store[id] = $store_id;
            $store_status['storeid'] = $store_id;
        }else{
            $this->store[id] = $store['id'];
            $this->update_store($store);
            $store_status['operation'] = 'update';
            $store_status['adsid'] = $store['id'];
            //exit();
        }
        
        return $store_status;
    }
    
//load store
    function get_all_store_by_userid($userid){
        global $session, $database;
        
        $query = mysql_query("SELECT * FROM ".$database->tbl_store." WHERE userid='".$userid."'");
        while($row = mysql_fetch_assoc($query)){
            $list[] = $row;
        }
        return $list;
    }
    
    function get_store_by_storeid($storeid = null){
        global $session, $database;
        if($storeid == null){ $storeid = $this->store['id']; }
        $store = array();
        
        $store['id'] = $storeid;
        $store['name'] = $this->get_store_single_by_column_and_storeid('store_name', $storeid);
        return $store;
    }

//load ads
    
    function get_list_ads_by_userid($userid){
        global $session, $database;
        
        $query = mysql_query("SELECT * FROM ".$database->tbl_ads_name." WHERE userid='".$userid."' ORDER BY id DESC");
        while($row = mysql_fetch_assoc($query)){
            $list[] = $row;
        }
        return $list;
    }
    
    function get_ads_by_adsid($adsid = null){
        global $session, $database;
        if($adsid == null){ $adsid = $this->ads['id']; }
        $ads = array();
        
        $ads['id'] = $adsid;
        $ads['title'] = $this->get_SingleDb_by_column_and_adsid('title', $adsid);
        $ads['description'] = $this->get_SingleDb_by_column_and_adsid('description', $adsid);
        $ads['userid'] = $this->get_SingleDb_by_column_and_adsid('userid', $adsid);
        
        $ads['category'] = $this->get_SingleDb_by_column_and_adsid('category', $adsid);
        $ads['subcategory'] = $this->get_SingleDb_by_column_and_adsid('subcategory', $adsid);
        $ads['price_sale'] = $this->get_SingleDb_by_column_and_adsid('price_sale', $adsid);
        
        //images
        $ads['images'] = array();
        $ads_images = $this->get_SingleDb_by_column_and_adsid('images', $adsid);
        if($ads_images){
            $images = explode(',',$ads_images);
            $image_list = array();
            
            foreach($images as $count => $imageid){
                //print_r($count);
                $image_list[] = $this->get_single_image_by_imageid($imageid);
            }
            
        }else{
            $image_list[] = array('name' => $this->default_ads_image);
        }
        $ads['images'] = $image_list;
        
        
        return $ads;
        
    }
    
    function get_store_single_by_column_and_storeid($column,$storeid = null){
        global $session, $database;
        if($storeid == null){ $storeid = $this->store['id']; }
        $query = mysql_query("SELECT ".$column." FROM ".$database->tbl_store." WHERE id='".$storeid."'");
        $row = mysql_fetch_assoc($query);
        return $row[$column];
        
    }
    
    function get_SingleDb_by_column_and_adsid($column,$adsid = null){
        global $session, $database;
        if($adsid == null){ $adsid = $this->ads['id']; }
        $query = mysql_query("SELECT ".$column." FROM ".$database->tbl_ads_name." WHERE id='".$adsid."'");
        $row = mysql_fetch_assoc($query);
        return $row[$column];
        
    }
    
    function get_single_image_by_userid($userid){
        global $session, $database;
        
        
        $query = mysql_query("SELECT * FROM ".$database->tbl_files_name." WHERE uid=".$userid);
        $row = mysql_fetch_assoc($query);
        return $row;
    }
    
    function get_single_image_by_imageid($imageid){
        global $session, $database;
        
        
        $query = mysql_query("SELECT * FROM ".$database->tbl_files_name." WHERE id=".$imageid);
        if($query){
            $row = mysql_fetch_assoc($query);
            
        }
        
        return $row;
    }
    
//post ads
    function create_ads_by_userid($ads = null){
        global $session, $database;
        print_r($ads);
        if($ads['id'] == null){  
            $query = mysql_query("INSERT INTO ".$database->tbl_ads_name." (
                userid,
                title,
                create_date,
                status
            )VALUES(
                '".$session->uid."',
                '".$ads['title']."',
                '".time()."',
                'need_admin_approval'
            )");
            $ads_status['operation'] = 'create';
            $ads_id = mysql_insert_id();
            $this->ads[id] = $ads_id;
            $ads_status['adsid'] = $ads_id;
        }else{
            $this->ads[id] = $ads['id'];
            $this->update_ads($ads);
            $ads_status['operation'] = 'update';
            $ads_status['adsid'] = $ads['id'];
            //exit();
        }
        
        
        
        
        $update_description = $this->update_description($ads['description']);
        $update_category = $this->update_category($ads['category']);
        $update_subcategory = $this->update_subcategory($ads['subcategory']);
        $update_saleprice = $this->update_AdsColumnValue_by_adsid('price_sale', $ads['sale_price']);
        $update_image = $this->update_image($ads['image']);
        
        
        return $ads_status;
    } 
    
    function update_ads($ads, $adsid = null){
        global $session, $database;
        if($adsid == null){ $adsid = $this->ads['id']; }
        //print_r($adsid);
        //echo 'aaaa';
        //exit();
        //update title
        $this->update_AdsColumnValue_by_adsid('title', $ads['title']);
    }
    
    function update_image($image, $adsid = null){
        global $session, $database;
        if($adsid == null){ $adsid = $this->ads['id']; }
        $imagelist = array();
        
        foreach($image as $i => $id){
            array_push($imagelist, $id);
        }
        $img_arr = implode(',', $imagelist);
        
        $this->update_AdsColumnValue_by_adsid('images', $img_arr);
    }
    
    function update_AdsColumnValue_by_adsid($column, $value, $adsid = false){
        global $session, $database;
        if($adsid == false){ $adsid = $this->ads['id']; }
        
        $query = mysql_query("UPDATE ".$database->tbl_ads_name." SET ".$column."='".$value."' WHERE id='".$adsid."'");
    }
    
    function update_category($categoryid, $adsid = false){
        global $session, $database;
        if($adsid == false){ $adsid = $this->ads['id']; }
        
        $query = mysql_query("UPDATE ".$database->tbl_ads_name." SET category='".$categoryid."' WHERE id='".$adsid."'");
    }
    
    function update_subcategory($subcategoryid, $adsid = false){
        global $session, $database;
        if($adsid == false){ $adsid = $this->ads['id']; }
        $query = mysql_query("UPDATE ".$database->tbl_ads_name." SET subcategory='".$subcategoryid."' WHERE id='".$adsid."'");
    }
    
    
    
    function update_description($description,$adsid = false){
        global $session, $database;
        if($adsid == false){ $adsid = $this->ads['id']; }
        
        $query = mysql_query("UPDATE ".$database->tbl_ads_name." SET description='".$description."' WHERE id='".$adsid."'");
        
    }

    function check_post_ads($ads){
         $is_valid = GUMP::is_valid($ads, array(
            'title' => 'required|max_len,100|min_len,6',
            'description' => 'required|max_len,100|min_len,6',
            'category' => 'required|alpha_numeric',
            'subcategory' => 'required|alpha_numeric',
            'sale_price' => 'required|numeric',
            'agreement' => 'required|contains,accept'
        ));
        
        return $is_valid;
    }
    
    function check_image($img){
        global $session, $database;
        $error = array();
        if(is_array($img)){
            foreach($img as $image){
                $query = mysql_query("SELECT * FROM ".$database->tbl_files_name." WHERE id='".$image."' AND uid='".$session->uid."'");
                $row = mysql_fetch_assoc($query);
                $numrow = mysql_num_rows($query);
                if($numrow != 1){
                    $error[imageid][] = $image;
                }
                
                
            }
        }else{
            $error[image] = 'Please select image';
        }
        
        if(count($error) == 0){
            $error = 1;
        }
        return $error;
        
    }
    function check_titleanddescription($ads){
        $is_valid = GUMP::is_valid($ads, array(
            'title' => 'required|alpha_numeric',
            'description' => 'required|max_len,100|min_len,6'
        ));
        
        return $is_valid;
    }
    
    function check_category($ads){
        $is_valid = GUMP::is_valid($ads, array(
            'category' => 'required|alpha_numeric',
            'subcategory' => 'required|alpha_numeric'
        ));
        
        return $is_valid;
    }
    
    function check_price($ads){
        $is_valid = GUMP::is_valid($ads, array(
            'sale_price' => 'required|numeric'
        ));
    }
    
    function main_page_list(){
        
    }
    
    function get_latest_ads_limit_by($limit, $status = 'published'){
        global $database;
        $query = mysql_query("SELECT * FROM ". $database->tbl_ads_name." WHERE status='".$status."' ORDER BY publish_date LIMIT $limit");
        while($row = mysql_fetch_assoc($query)){
            $list[] = $this->get_ads_by_adsid($row['id']);
        }
        return $list;
    }
    
    function get_ads_by_id($adsid){
        global $database;
        $query = mysql_query("SELECT * FROM ". $database->tbl_ads_name." WHERE id='$adsid'");
        $row = mysql_fetch_assoc($query);
        return $row;
    }
}

$Class_Ads = new Ads;
?>