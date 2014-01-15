<?php

class SchemeReader {

    private $schemaName;
    private static $xml;
    private static $model;
    

    private $modelName;
    private $table;
    private $columns;
    private $constraints;
    private $modelAttributes = array();
    private $modelTable = array();
    private $modelColumns = array();
    private $modelConstraints = array();

    public function __construct($directory, $name) {
        
        $this->schemaName = $directory.$name.".xml";
        //print_r($this->schemaName);
        //exit();
        if(is_file($this->schemaName) and is_readable($this->schemaName)) {
            self::$xml = simplexml_load_file($this->schemaName);
        } else {
            throw new Exception("no schema to load.");
        }
    }

    public function getModel(){
        return $this->model;
    }
    
    function build($tablename){
        $this->fetchModel($tablename);
        $this->fetchTable();
        $this->fetchColumns();
        $this->fetchConstraints();
        
        $attributes = $this->getAttributes();
    }

    public function fetchModel($modelName) {
        $this->modelName = $modelName;
        self::$model = self::$xml->xpath('//*/table[@name="'.$modelName.'"]/..');
        $this->getModelAttributes();
        return $this;
    }

    private function getModelAttributes() {
        $attributes = array();    
        print_r($this);    
        foreach($this->model[0]->attributes() as $key => $val){
            $attributes[$key] = (string)$val;
        }
        $this->modelAttributes = $attributes;
        return $this;
    }

    public function fetchTable() {
        $this->table = self::$model[0]->xpath('table[@name="'.$this->modelName.'"]');
        $this->getTableAttributes();
        return $this;
    }

    private function getTableAttributes() {
        $attributes = array();
        foreach($this->table as $table){
            foreach($table->attributes() as $key => $val){
                $attributes[$key] = (string)$val;
            }
        }
        $this->modelTable = $attributes;
        return $this;
    }

    public function fetchColumns() {
        $this->columns = self::$model[0]->xpath('table[@name="'.$this->modelName.'"]/column');
        $this->getColumnAttributes();
        return $this;
    }

    private function getColumnAttributes() {
        $attributes = array();
        foreach($this->columns as $index => $column) {
            foreach($column->attributes() as $key => $val){
                $attributes[$index][$key] = (string)$val;
            }
        }
        $this->modelColumns = $attributes;
        return $this;
    }


    public function fetchConstraints() {
        $this->constraints = self::$model[0]->xpath('../*/table[@name="'.$this->modelName.'"]/foreignkey');        
        $this->getConstraintAttributes();
        return $this;
    }

    private function getConstraintAttributes() {
        $attributes = array();

        if(isset($this->constraints)) {
            foreach($this->constraints as $index => $constraint) {
                foreach($constraint->attributes() as $key => $val){
                    $attributes[$index][$key] = (string)$val;
                }
            }
            $this->modelConstraints = $attributes;
        }
        return $this;
    }

    public function getAttributes() {
        $array = array();
        $array["model"] = $this->modelAttributes;
        $array["table"] = $this->modelTable;
        $array["columns"] = $this->modelColumns;
        $array["constraints"] = $this->modelConstraints;
        return $array;
    }
    
}