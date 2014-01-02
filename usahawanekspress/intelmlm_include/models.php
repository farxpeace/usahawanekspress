<?php
Class Models {
    var $listfiles;
    var $modules;
    var $model = array();
    function Models(){
        
        $this->modules = $this->scanmodules();
        
        foreach($this->listfiles as $file){
            $this->loadmodel($file);
        }
        
        $this->check_table();
        
    }
    
    function check_table(){
        global $database;
        
        foreach($this->model as $a){
            print_r($a);
        }
    }
    
    function loadmodel($file){
        #$data = file_get_contents($file);
        $data = simplexml_load_file($file);
        print_r($data);
        $this->model[] = $data;
    }
    
    function scanmodules(){
        $files2 = array_diff(scandir(FOLDER_MODULES, 1), array('..', '.'));
        
        foreach($files2 as $folder){
            $files2[] = $this->scanfiles($folder);
        }
        return $files2;
    }
    
    function scanfiles($module){
        $files2 = array_diff(scandir(FOLDER_MODULES.'/'.$module, 1), array('..', '.'));
        foreach($files2 as $filename){
            $filter = substr( $filename, 0, 6 );
            if($filter == 'Models'){
                $this->listfiles[] = FOLDER_MODULES.'/'.$module.'/'.$filename;
            }
        }
        
    }
    
    
    
}
$models = new Models;

?>