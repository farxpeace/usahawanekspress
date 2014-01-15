interface iDb_Adapter {
    public function __construct(stdClass $dsn);
    public function getDsn();
    public function connect();
    public function hasConnection();
    public function getConnection();
    public function query($sql);
    public function getObject();
    public function getNumRows();
    public function hasError();
    public function getError();
    public function close();
}
