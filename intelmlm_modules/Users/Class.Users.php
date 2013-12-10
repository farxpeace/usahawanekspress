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
            $row['userrole'] = $session->role_by_user($row['id']);
            $output[] = $row;
        }
        return $output;
    }
    
    
    function list_allrole(){
        global $database, $session;
        $output = array();
        $result = mysql_query("SELECT * FROM ".TBL_ROLE);
        while($row = mysql_fetch_assoc($result)){
            $list[] = $database->get_all_role_by_roleid($row['id']);
            //$output[] = $row;
        }
        print_r($list);
        return $list;
    }
    
    
    
}

?>