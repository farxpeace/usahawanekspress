<?php

Class Users {
    
    var $search_query;
    var $query_style;
    var $result_count;
    
    function __construct(){
        $this->query_style = $_REQUEST['query_style'];
        
        
        
        //check
        //$this->search();
    }
    
    function search(){
        global $database;
        $output = array();
        
        if($this->query_style == 'alluser'){
            $output = $this->list_alluser();
        }
        
        //count
        $this->result_count = count($output);
        return $output;
    }
    
    
    function list_alluser(){
        global $database, $session;
        $output = array();
        $result = mysql_query("SELECT * FROM ".TBL_USERS);
        while($row = mysql_fetch_assoc($result)){
            //$row['userrole'] = $session->role_by_user($row['id']);
            //print_r($row);
            $output[] = $row;
        }
        return $output;
    }
    
    
    function list_allrole(){
        global $database, $session;
        $output = array();
        $result = mysql_query("SELECT * FROM ".TBL_ROLE);
        while($row = mysql_fetch_assoc($result)){
            //print_r($row['id']);
            $data = $this->get_role_data($this->get_all_role_by_roleid($row['id']));
            
            $list[$row['id']] = $data;
            //$list[$row['id']] = $role;
            //$output[] = $row;
        }
        
        return $list;
    }
    
    function get_allrole(){
        global $database, $session;
        $output = array();
        $result = mysql_query("SELECT * FROM ".TBL_ROLE);
        while($row = mysql_fetch_assoc($result)){
            $list[] = array('id' => $row[id], 'name' => $row['name']);
        }
        return $list;
    }
    
    function add_edit_user(){
        global $session;
        $userid = $_REQUEST['id'];
        $edit = $_REQUEST['edit'];
        $add = $_REQUEST['add'];
        if(!$userid){
            $userid = $session->uid;
            Header("Location: ".SYSURL."?modules=Users&op=edituser&id=$userid");
        }        
        $output = array();
        if($edit == 'yes'){
                
                $output = $this->edit_user($userid);
                $session->referrer = $session->referrer = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";                
            
        }elseif($add == 'yes'){
                        
            $output[add] = 'yes';
            $output[userid] = $this->add_user($userid);
            $session->referrer = SYSURL."?modules=Users&op=edituser&id=$output[userid]";            
            
        }
        
                
        return $output;
    }
    
    function add_user(){
        $time = time();
        $username = 'temporary'.$time;
        $query1 = mysql_query("INSERT INTO ".TBL_USERS." SET timestamp='".$time."',username='".$username."',password='".md5('123456')."', bpassword='123456', valid='1'");
        $userid = mysql_insert_id();
        return $userid;
        
    }
    
    function edit_user($userid){
        
        $can_edit = array('fullname', 'email', 'userrole');
        $output['status'] = 'ok';
        //echo '<pre>';
        //print_r($_REQUEST);
        foreach($can_edit as $editable){
            
            $data = $_REQUEST[$editable];
            $query = mysql_query("UPDATE ".TBL_USERS." SET $editable='".$data."' WHERE id='".$userid."'"); 
            
        }
        
        return $output;
    }
    
    function get_role_alias_by_meta($roleid, $meta){
        global $database;

        $result = mysql_query("SELECT * FROM ".TBL_ROLE_META." WHERE roleid='".$roleid."' AND meta='".$meta."'");
        $query = mysql_fetch_assoc($result);
        
        return $query['alias'];
    }
    
    function get_role_name_by_id($roleid){
        $result = mysql_query("SELECT * FROM ".TBL_ROLE." WHERE id='".$roleid."'");
        $query = mysql_fetch_assoc($result);
        
        return $query['name'];
    }
    
    function get_role_data($roledata){
        
        if(is_array($roledata)){
            foreach($roledata as $a => $b){
                
                $list[$b['meta']] = $b['value'];
                       
            }
            //
        }
        return $list;
    }
    
    function delete_user($userid){
        $result = mysql_query("DELETE FROM ".TBL_USERS." WHERE id='$userid'");
        $output[status] = 'ok';
        return $output;
    }
    
    
    
    function get_all_role_by_roleid($roleid){
        $result = mysql_query("SELECT * FROM ".TBL_ROLE_META." WHERE roleid='".$roleid."'");
        while($row = mysql_fetch_assoc($result)){
            $list[] = $row;
        }
        return $list;
        
    }
    
    
    
    
    
}

?>