<?php 

/**
 * SchemeModel
 * @author Thomas Schäfer
 */
class SchemeModel {

    private $db;

    public function __construct(stdClass $dsn) {
        $adapterClass = "Db_Adapter".ucfirst($dsn->adapter);
        if(class_exists($adapterClass)) {
            $this->db = new $adapterClass($dsn);
        } else {
            throw new Exception("Database Adapter $adapterClass does not exist.");
        }
    }

    public function getDb() {
        return $this->db;
    }

    /**
     * connect
     */
    public function connect() {
        $this->getDb()->connect();
        return $this;
    }

    public function getDsn(){
        return $this->getDb()->getDsn();
    }

    /**
     * query
     * @param string $sql
     * @return void
     */
    private function query($sql) {
        $this->getDb()->query($sql);
        return $this;
    }
    
    /**
     * getObjects
     * @return array
     */
    public function getObjects() {
        $array = array();
        if($this->getDb()->getNumRows() and !$this->getDb()->hasError()){
            while($obj=$this->getDb()->getObject()){
                $array[] = $obj;
            }
        }
        return $array;
    }

    /**
     * getNumRows
     * @return int
     */
    public function getNumRows(){
        return $this->getDb()->getNumRows();
    }

    /**
     * error
     * @return string
     */
    private function error(){
        return $this->getDb()->getError();
    }

    /**
     * hasError
     * @return mixed
     */
    public function hasError(){
        return $this->getDb()->hasError();
    }

    /**
     * close
     */
    public function close(){
        $this->getDb()->getClose();
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
                $object = SchemeModel::fetchField($row);
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
	public static function fetchField($row) {
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
    public static function intBool($value) {
       return ($value==1?"true":false);
    }

}
