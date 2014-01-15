<?php

// filepath => {directorytoreadfrom}{databasenameinschemafile}.xml

$model = "employees";

// read model from schema file
$showTable  = new SchemeReader("{directorytoreadfrom}", "{databasenameinschemafile}");
$showTable->fetchModel($model);
$showTable->fetchTable();
$showTable->fetchColumns();
$showTable->fetchConstraints();

$attributes = $showTable->getAttributes();
