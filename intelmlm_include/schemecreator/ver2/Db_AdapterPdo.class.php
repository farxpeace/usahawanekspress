class Db_AdapterPdo implements iDb_Adapter {

    /**
     * @var stdClass $dsn
     */
	private $dsn;

	/**
	 * @var resource $connection
	 */
	private $connection;

	/**
	 * @var PDO_Statement $statement
	 */
	private $statement;

	/**
	 * @param stdClass $dsn
	 * @return void
	 */
	public function __construct(stdClass $dsn) {
		if($dsn) {
			$this->dsn = $dsn;
		}		
	}

    public function getDsn(){
        return $this->dsn;
    }

	/**
	 * connect
     * @desc PDO instance via driver invocation
	 * @return void
	 */
	public function connect() {
		$DSN = $this->dsn;
        if(empty($DSN->type)){
            throw new Exception("Wrong PDO Adapter chosen.");
        }
		if(empty($this->connection)) {
			$connectionString = strtolower($DSN->type).":dbname=".$DSN->database.";host=". $DSN->host;
			if(!empty($DSN->port)) $connectionString .= ";port:".$DSN->port;
			if(!empty($DSN->socket)) $connectionString .= ";socket:".$DSN->socket;            
            try {
                $this->connection = new PDO($connectionString,$DSN->user,$DSN->password);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
		}
	}


	public function hasConnection() {
        return (empty($this->connection)?false:true);
	}

	public function getConnection() {
		return $this->connection;
	}

    public function getStatement(){
		return $this->statement;
	}
    
    public function getNumRows(){
        return $this->getStatement()->rowCount();
    }

	public function query($sql){        
		$this->statement = $this->getConnection()->query($sql);
		return $this;
	}

	public function getObject(){
		return $this->getStatement()->fetch(PDO::FETCH_OBJ);
	}

	public function hasError(){
		return ($this->getConnection()->errorCode()!=0?true:false);
	}

	public function getError(){
		return $this->getConnection()->errorCode();
	}

    public function close(){
        return $this->getConnection()->close();
    }
}
