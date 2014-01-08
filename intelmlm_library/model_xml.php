<?php
class Model_xml {


    
    function __construct($model){
        
        $this->config = new stdClass;
        $this->config->check_table = true;
        $this->config->create_table = true;
        
        foreach ($model as $i => $modelname){
            $xml = simplexml_load_file(FOLDER_MODULES.'/'.$modelname.'/Model.xml');
            $modelname = strtolower($modelname);
            $arr = (array) $xml;
            $self = $this->{$modelname} = $xml;
            //$self = $this->{$modelname};
            
            
            //$self->xml_obj = $xml;
            
            
            //check table exists
            if($this->config->check_table){
                $self->xml->table->isExists = $this->table_exists($self->attributes()->{'name'});
            }
            if($this->config->create_table){
                
            }
            //echo '<pre>';
            //print_r($this->{$modelname});
            
        }
    }
    
    function table_exists($tablename) {
        
        $res = $this->db->Execute("
            SELECT COUNT(*) AS count 
            FROM information_schema.tables 
            WHERE table_schema ='".$this->db->databaseName."' AND table_name = '$tablename'
        ");
        
        
        return ($res->fields['count'] ? true : false);
    }
}






?>