<?php

/**
 * SchemeCreator
 * @author Thomas Schaefer
 */
class SchemeCreator {

    private $db;
    private $connectionData;
    private $resource;
    private $results;
    private $outputDirectory;
	private $header = array(
		"FieldNames" => false,
		"TableNames" => false,
		"Databases" => false,
	);


    public function __construct($outputDirectory=""){
        $this->outputDirectory = $outputDirectory;
    }

    private function setConnectionData(stdClass $dsn){
        $this->connectionData = $dsn;
        return $this;
    }

    public function setDb($db){
        $this->db = $db;
        $this->setConnectionData($db->getDsn());
        return $this;
    }

    public function getDb(){
        return $this->db;
    }

    public function doCreate(){
        $this->getDb()->connect();
        $this->fetchAll();
        $this->build();
    }

    public function fetchAll(){
        
        $context = $this->connectionData->database;

        $result = $this->getDb()->showTablesIn($context)->getObjects();
        foreach($result as $key => $value) {
            $relationName = $context .".". $value->{"Tables_in_".$context};
            
            $this->results[$value->{"Tables_in_".$context}] = $this->getDb()->describe($relationName);
            $this->results[$value->{"Tables_in_".$context}]["FullQualifiedName"] = $relationName;


            $constraints = $this->getDb()->showJoinedConstraintsWithColumnsOnRelation($context, $value->{"Tables_in_".$context})->getObjects();
            if(count($constraints)) {
                $this->results[$value->{"Tables_in_".$context}]["Constraints"] = $constraints;
            }

            $references = $this->getDb()->showJoinedReference($context, $value->{"Tables_in_".$context})->getObjects();
            if(count($references)) {
                $this->results[$value->{"Tables_in_".$context}]["References"] = $references;
            }

            if(isset( $value->{"Tables_in_".$context})) {
                $tables = $this->getDb()->getTableInfo($context, $value->{"Tables_in_".$context})->getDb()->getObject();
                $this->results[$value->{"Tables_in_".$context}]["Info"] = $tables;
            }
        }
        return $this;
    }

    /**
     * build
     * @return void
     */
	public function build() {
        
        $xml = new SimpleXMLElement('<database></database>');
		$xml->addAttribute("name",$this->connectionData->database);		

        foreach($this->results as $name => $result)
        {
            $table = $xml->addChild("table");
            $table->addAttribute("name", $result["TableNames"][0]);
            $table->addAttribute("phpName", SchemeModel::ucfirstAndCamelcased($result["TableNames"][0] ) );

            if($tableResults = $result["Info"]) {
                $table->addAttribute("engine", $tableResults->ENGINE);
                $table->addAttribute("type", SchemeModel::ucfirstAndCamelcased( str_replace("" ,"_",strtolower( $tableResults->TABLE_TYPE ) ) ) );
                $table->addAttribute("collation", $tableResults->TABLE_COLLATION );
                $table->addAttribute("comment", $tableResults->TABLE_COMMENT );
            }
            
            foreach($result["Columns"] as $fullPhpPerspectiveName => $columnName) {
                $column = $table->addChild("column");
                if(isset($result["Attributes"][$columnName])) {
                    foreach($result["Attributes"][$columnName] as $attributeName => $attributeValue){
                        if(strlen($attributeValue)) {
                            switch($attributeName){
                                case "required":
                                case "multiple_key":
                                case "primary_key":
                                case "auto_increment":
                                case "unique":
                                    if($val=SchemeModel::intBool($attributeValue)) {
                                        $column->addAttribute($attributeName, $val);
                                    }
                                    break;
                                default:
                                    $column->addAttribute($attributeName, $attributeValue);
                                    break;

                            }
                        }
                    }
                }
                $column->addAttribute("phpName",$fullPhpPerspectiveName);
            }
            
            if(array_key_exists("Constraints", $result) and count($result["Constraints"])) {
                $constraintsResults = $result["Constraints"];                
                foreach($constraintsResults as $index => $constraints) {
                    $foreignKey = $table->addChild("foreignkey");
                    $foreignKey->addAttribute("type", "constraint");
                    $foreignKey->addAttribute("localKey", $constraints->TABLE_SCHEMA.".".$constraints->TABLE_NAME.".".$constraints->COLUMN_NAME);
                    $foreignKey->addAttribute("referenceKey", $constraints->CONSTRAINT_SCHEMA .".".$constraints->REFERENCED_TABLE_NAME.".".$constraints->COLUMN_NAME);
                    $foreignKey->addAttribute("constraintName", $constraints->CONSTRAINT_NAME);
                    $foreignKey->addAttribute("onUpdate", $constraints->UPDATE_RULE);
                    $foreignKey->addAttribute("onDelete", $constraints->DELETE_RULE);
                    $foreignKey->addAttribute("matchOption", $constraints->MATCH_OPTION);
                }
            } else {
                // using internal referencee from table phpmyadmin
                // myisam engine                
                if(array_key_exists("References", $result) and count($result["References"])) {
                    $constraintsResults = $result["References"];
                    foreach($constraintsResults as $index => $constraints) {
                        $foreignKey = $table->addChild("foreignkey");
                        $foreignKey->addAttribute("type", "relationship");
                        $foreignKey->addAttribute("localKey", $constraints->master_db.".".$constraints->master_table.".".$constraints->master_field);
                        $foreignKey->addAttribute("referenceKey", $constraints->foreign_db.".".$constraints->foreign_table.".".$constraints->foreign_field);
                        $foreignKey->addAttribute("constraintName", $constraints->master_db."_".$constraints->master_table."_".$constraints->master_field);
                        $foreignKey->addAttribute("onUpdate", "NULL");
                        $foreignKey->addAttribute("onDelete", "NULL");
                        $foreignKey->addAttribute("matchOption", "NULL");
                    }
                }

            }
        }

        // serialize
        $xml->asXML($this->outputDirectory . $this->connectionData->database.".xml");

        return $this;

	}


}
