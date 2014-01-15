<?php 

ini_set("max_execution_time",180);

include_once("interface.php");
include_once("SchemeModel.class.php");
include_once("SchemeCreator.class.php");
include_once("Db_AdapterMysql.class.php");
include_once("Db_AdapterPdo.class.php");

$dsn = new stdClass;
$dsn->host = "localhost";
$dsn->database = "users";
$dsn->user = "root";
$dsn->password = "password";
$dsn->type = "Mysql";
$dsn->adapter = "Pdo";
$dsn->socket = false;


$showTable  = new SchemeCreator(GLOBALMODELSDIR.DIRECTORY_SEPARATOR);
$showTable->setDb(new SchemeModel($dsn));
$showTable->doCreate();

