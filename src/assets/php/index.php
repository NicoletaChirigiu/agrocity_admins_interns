<?php

$config = require './core/config.php';

require './core/database/connection.php';
require "./core/database/queryBuilderTable.php";
require "./core/router.php";
require "./core/request.php";
require "./core/database/createTables.php";
require_once './core/database/insertInTables.php';


$connection = (ConnectionDB::make($config['db']));
Create::tables($connection);
// Insert::teams($connection);
// Insert::skills($connection);


require Router::load('routes.php')
    ->direct(Request::uri());
