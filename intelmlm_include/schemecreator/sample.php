<?php

include_once("SchemeCreator.class.php");

$create  = new SchemeCreator("{outputdirectory}");
$create  ->setConnection("{host}", "{database}", "{user}", "{password}")
         ->doCreate();

