<?php
Class Users {
    
    
    function __construct(){
        
    }
    
    function getUserInfo_by_id($id){
        global $database;
      $q = sprintf("SELECT * FROM ".$this->tbl_users_name." WHERE id = '$id'",
            mysql_real_escape_string($username));
      $result = mysql_query($q, $this->connection);
      /* Error occurred, return given name by default */
      if(!$result || (mysql_numrows($result) < 1)){
         return NULL;
      }
      /* Return result array */
      $dbarray = mysql_fetch_assoc($result);
      return $dbarray;
   }
   
   
   /**
    * Update when duplicate exists.
    * @param $select an array key value defined column and value
    * @param $value string
    */
   function meta_insertUpdate($statement = array(), $value = array()){
        global $database;
        
            
        $isExists = $this->meta_selectOne(array('id'), $statement);
        
        $action = 'insert';
        if($isExists > 1){
            $action = 'update';
        }
        echo $action;
        if($action == 'update'){
            $this->meta_update($statement, $value);
        }elseif($action == 'insert'){
            $data = array_merge($statement, $value);
            $this->meta_insert($data);
        }
        
   }
   
   function meta_insert($data){
        global $database;
        
        $data2['data'] = $data;
        $id = $database->insert($database->tbl_users_meta, $data2);
        return $id;
   }
   /**
    * Select meta
    * @param $statement Array
    * @return Array
    */
   function meta_selectOne($column, $statement){
        global $database;
    
        $arr_key = array_keys($statement);
        $column = implode(',',$column);
        
        foreach($statement as $c_k => $c_v){
            $select[] = $c_k."='".$c_v."'";
        }
        $where = implode(' AND ', $select);
        $q = "SELECT ".$column." FROM ".$database->tbl_users_meta." WHERE ".$where;
        $result = mysql_query($q);
        $row = mysql_fetch_assoc($result);
        
        return $row;
    
   }
   
   function meta_update($statement = array(), $value = array()){
        global $database;
        $arr_key = array_keys($statement);
        $column = implode(',',$arr_key);
        
        foreach($statement as $c_k => $c_v){
            $select[] = $c_k."='".$c_v."'";
        }
        $where = implode(' AND ', $select);
        
        $uk = key($value);
        $uv = $value[$uk];
        
        $query = mysql_query("UPDATE ".$database->tbl_users_meta." SET ".$uk."='".$uv."' WHERE ".$where);
        return $query;
   }
   
   function meta_updateValueBy_RefMeta($ref,$meta,$value){
    
   }
    
}
?>