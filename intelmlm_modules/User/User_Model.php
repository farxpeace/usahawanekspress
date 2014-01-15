<?php
  /**
   * User Model
   * @package    MX
   * @subpackage Controller
   * @author     Ijul Farizul <farxpeace@gmail.com>
   */
class User_Model extends Model {
    
    /** !Column PrimaryKey, Integer, AutoIncrement */
    public $id;
        
    /** !Column String */
    public $username;
        
    /** !Column Text */
    public $email;
    
    private $tablename = 'intelmlm_users';
    
    function __construct(){
        parent::__construct(); 
    }
    
    public function getRowByUserId(){
        
    }
    
    /**
     * Get column value by user id
     * @param string $column table column e.g username, password
     * @param integer $userid userid
     * @return boolean
     */
    public function getColumnByUserid($column,$userid){
        $res = $this->db->GetOne("SELECT * FROM ".$this->tablename);
        if ($res === false) die("failed"); 
    }
    
}
?>