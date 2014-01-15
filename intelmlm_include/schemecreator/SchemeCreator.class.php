<?php

/**
 * SchemeCreator
 * @author Thomas Schaefer
 * @email scaphare@gmail.com
 */
class SchemeCreator {

    public $connectionData;
    private $connection;
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

    public function doCreate(){
        $this->fetchAll();
        $this->build();
    }
    function fetchOne($dbname, $tablename){
        $context = $this->connectionData->database;
        $c = array();
        $a = new stdClass;
        $a->Tables_in_intelmlm = $tablename;
        $c[] = $a;
        print_r($c);
        $result = $this->showTablesIn($dbname)->getObjects();
        print_r($result);
        foreach($c as $key => $value) {
            $relationName = $context .".". $value->{"Tables_in_".$context};
            
            $this->results[$value->{"Tables_in_".$context}] = $this->describe($relationName);
            $this->results[$value->{"Tables_in_".$context}]["FullQualifiedName"] = $relationName;


            $constraints = $this->showJoinedConstraintsWithColumnsOnRelation($context, $value->{"Tables_in_".$context})->getObjects();            
            if(count($constraints)) {
                $this->results[$value->{"Tables_in_".$context}]["Constraints"] = $constraints;
            }

            $references = $this->showJoinedReference($context, $value->{"Tables_in_".$context})->getObjects();
            if(count($references)) {
                $this->results[$value->{"Tables_in_".$context}]["References"] = $references;
            }

            if(isset( $value->{"Tables_in_".$context})) {
                $tables = $this->getTableInfo($context, $value->{"Tables_in_".$context})->getObject();
                $this->results[$value->{"Tables_in_".$context}]["Info"] = $tables;
            }
        }
        //$this->build();
        return $this;
    }
    public function fetchAll(){
        
        $context = $this->connectionData->database;

        $result = $this->showTablesIn($context)->getObjects();
        foreach($result as $key => $value) {
            $relationName = $context .".". $value->{"Tables_in_".$context};
            
            $this->results[$value->{"Tables_in_".$context}] = $this->describe($relationName);
            $this->results[$value->{"Tables_in_".$context}]["FullQualifiedName"] = $relationName;


            $constraints = $this->showJoinedConstraintsWithColumnsOnRelation($context, $value->{"Tables_in_".$context})->getObjects();            
            if(count($constraints)) {
                $this->results[$value->{"Tables_in_".$context}]["Constraints"] = $constraints;
            }

            $references = $this->showJoinedReference($context, $value->{"Tables_in_".$context})->getObjects();
            if(count($references)) {
                $this->results[$value->{"Tables_in_".$context}]["References"] = $references;
            }

            if(isset( $value->{"Tables_in_".$context})) {
                $tables = $this->getTableInfo($context, $value->{"Tables_in_".$context})->getObject();
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
            $table->addAttribute("phpName", self::ucfirstAndCamelcased($result["TableNames"][0] ) );

            if($tableResults = $result["Info"]) {
                $table->addAttribute("engine", $tableResults->ENGINE);
                $table->addAttribute("type", self::ucfirstAndCamelcased( str_replace("" ,"_",strtolower( $tableResults->TABLE_TYPE ) ) ) );
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
                                    if($val=self::intBool($attributeValue)) {
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


    /**
     * mysql methods
     */

    /**
     *
     * @param string $host
     * @param string $db
     * @param string $user
     * @param string $password
     */
    public function setConnection($host,$db,$user,$password){
        $this->connectionData = new stdClass;
        $this->connectionData->host = $host;
        $this->connectionData->database = $db;
        $this->connectionData->user = $user;
        $this->connectionData->password = $password;
        return $this;
    }

    /**
     * connext
     */
    private function connect() {
        if(empty($this->connection)){
            $this->connection = mysql_connect($this->connectionData->host, $this->connectionData->user, $this->connectionData->password);
            if(empty($this->connection)){
                throw new Exception("Could not establish database connection. Error: ". mysql_error());
            }
        }
    }

    /**
     * query
     * @param string $sql
     * @return void
     */
    private function query($sql) {
        $this->resource = mysql_query($sql);
        return $this;
    }

    /**
     * getObject
     * @return stdClass
     */
    private function getObject() {
        if(is_resource($this->resource)){
            return mysql_fetch_object($this->resource);
        } else {
            throw new Exception("No resource available. Error: ". $this->error());
        }
    }

    /**
     * getPbjects
     * @return array
     */
    public function getObjects() {
        $array = array();
        if($this->getNumRows() and !$this->hasError()){
            while($obj=$this->getObject()){
                $array[] = $obj;
            }
        }
        return $array;
    }

    /**
     * getNumRows
     * @return int
     */
    private function getNumRows(){
        return mysql_num_rows($this->resource);
    }

    /**
     * error
     * @return string
     */
    private function error(){
        return mysql_error($this->connection);
    }

    /**
     * hasError
     * @return mixed
     */
    private function hasError(){
        if (mysql_errno()>0) {
			return mysql_errno();
		}
		return false;
    }

    /**
     * close
     */
    private function close(){
        mysql_close($this->connection);
    }

    /**
     * statements
     */

    /**
     * showTablesIn
     * @param string $contextName database
     * @return resource
     */
	public function showTablesIn($contextName) {
		return $this->query("SHOW TABLES IN ".$contextName.";");
	}

    /**
     * showJoinedReference
     * @param string $contextName database
     * @param string $relationName table
     * @return resource
     */
	public function showJoinedReference($contextName, $relationName) {
		return $this->query("SELECT * FROM phpmyadmin.pma_relation WHERE master_db='".$contextName."' AND master_table='".$relationName."';");
	}

    /**
     * showJoinedConstraintsWithColumnsOnRelation
     * @param string $contextName database
     * @param string $relationName table
     * @return resource
     */
	public function showJoinedConstraintsWithColumnsOnRelation($contextName, $relationName) {
		return $this->query("SELECT distinct col.*,rs.* FROM information_schema.TABLE_CONSTRAINTS ts
LEFT JOIN information_schema.REFERENTIAL_CONSTRAINTS rs ON rs.CONSTRAINT_SCHEMA=ts.CONSTRAINT_SCHEMA AND rs.TABLE_NAME=ts.TABLE_NAME
LEFT JOIN information_schema.COLUMNS col ON col.TABLE_SCHEMA = rs.CONSTRAINT_SCHEMA AND col.TABLE_NAME = rs.TABLE_NAME
WHERE ts.CONSTRAINT_TYPE = 'FOREIGN KEY' AND col.COLUMN_KEY='PRI'  AND col.DATA_TYPE='int'
AND rs.CONSTRAINT_SCHEMA='".$contextName."' AND rs.TABLE_NAME='".$relationName."';");
	}

    /**
     * getTableInfo
     * @param string $contextName database
     * @param string $relationName table
     * @return resource
     */
	public function getTableInfo($contextName, $relationName) {
        return $this->query("SELECT *  FROM information_schema.TABLES WHERE TABLE_SCHEMA='".$contextName."' AND TABLE_NAME='".$relationName."';");
	}

    /**
     * describe
     * @param string $relationName
     * @return array
     */
	public function describe($relationName){

        $header = $this->header;
		if($relationName) {
			$rel = explode(".", $relationName);

			$database = $rel[0];
			$table = $rel[1];

			$header["Databases"]  = array( $database );
			$header["TableNames"] = array( $table );

			$resultObject = $this->query(" SHOW FULL COLUMNS FROM ".$relationName)->getObjects();
            
			foreach($resultObject as $key => $row) {
                $object = SchemeCreator::fetchField($row);                
                $perspectiveName = self::ucfirstAndCamelcased($object->name . 'Of' . ucfirst($table). 'In' . ucfirst($database));
                $header["ColumnNames"][$table.".".$object->name] = $perspectiveName;
                $header["Columns"][$perspectiveName] = $object->name;

                $object->privileges = $row->Privileges;
                $object->comment = $row->Comment;
                
                $header["Attributes"][$object->name] = $object;
			}
		}
		return $header;
	}

    /**
     * convention helpers
     */

    /**
     * fetchField
     * @param stdClass $row
     * @return stdClass
     */
	private static function fetchField($row) {
		$object = new stdClass();
		$object->name = $row->Field;
		$split = preg_split("/[\(\),]/", $row->Type);
		$mode = is_array($split)?$split[0]:$split[0];
		switch($mode) {
			case "varchar":
			case "char":
			case "int":
			case "tinyint":
			case "mediumint":
			case "smallint":
			case "bigint":
			case "bit":
				$object->type = $split[0];
				$object->length = $split[1];
				break;
			case "decimals":
			case "float":
				$object->type = $split[0];
				$object->length = $split[1];
				$object->decimals = $split[2];
				break;
			case "longtext":
			case "longblob":
				$object->max_length = 4294967295;
				$object->type = $mode;
				break;
			case "mediumblob":
			case "mediumtext":
				$object->max_length = 16777215 ;
				$object->type = $mode;
				break;
			case "blob":
			case "text":
				$object->max_length = 65535;
				$object->type = $mode;
				break;
			case "enum":
				$object->type = $mode;
				unset($split[0]);
				unset($split[count($split)]);
				$object->default = implode(",",$split);
				break;
			default:
				$object->type = $mode;
				break;
		}

		$object->required = ($row->Null == "NO") ? true : false;
		$object->multiple_key = (stristr($row->Key,"MUL")) ? true : false;
		$object->primary_key = (stristr($row->Key,"PRI")) ? true : false;
		$object->unique = (stristr($row->Key,"UNI")) ? true : false;
		$object->auto_increment = (stristr($row->Extra,"auto_increment")) ? true : false;
		if(empty($object->default)) {
			$object->default = $row->Default!=""? true : false;
		}
		return $object;

	}

    /**
     * ucfirstAndCamelcased
     * @param string $word
     * @return string
     */
	public static function ucfirstAndCamelcased($word = null) {
		$return = str_replace(" ", "", ucwords(str_replace("_", " ", $word)));
        $string = strtoupper(substr($return,0,1)).substr($return,1);
        return $string;
	}

    /**
     * intBool
     * @param string $value
     * @return mixed
     */
    private static function intBool($value) {
       return ($value==1?"true":false);
    }

}
