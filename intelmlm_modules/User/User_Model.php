<?php
class User_Model extends Model {
    
    private $tablename = 'intelmlm_users';
    
    function __construct(){
        parent::__construct();
    }
    
    public function selectOne_by_userid($userid){
        $res = $this->db->Execute("SELECT * FROM ".$this->tablename." LIMIT 1");
        if ($res === false) die("failed"); 
    }
    
}
?>