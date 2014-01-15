
class Db_AdapterMysql implements iDb_Adapter {
    private $dsn;
    private $resource;
    private $connection;
    public function __construct(stdClass $dsn){
        $this->dsn = $dsn;
    }
    public function getDsn(){
        return $this->dsn;
    }
    public function hasError(){
        if (mysql_errno()>0) {
			return mysql_errno();
		}
		return false;
    }
    public function getError(){
        return mysql_error($this->connection);
    }
    public function connect() {
        if(empty($this->connection)){
            $this->connection = mysql_connect($this->dsn->host, $this->dsn->user, $this->dsn->password);
            if(empty($this->connection)){
                throw new Exception("Could not establish database connection. Error: ". mysql_error());
            }
        }
    }
	public function hasConnection() {
		return (isset($this->connection)?true:false);
	}
	public function getConnection() {
		return $this->connection;
	}
    public function getNumRows(){
        return mysql_num_rows($this->resource);
    }
    public function query($sql) {
        $this->resource = mysql_query($sql);
    }
    public function getObject() {
        if(is_resource($this->resource)){
            return mysql_fetch_object($this->resource);
        } else {
            throw new Exception("No resource available. Error: ". $this->error());
        }
    }
    public function close(){
        mysql_close($this->connection);
    }
}
