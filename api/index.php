<?php

use R\DB\Schema;

error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

$loader = require_once("vendor/autoload.php");

$app = new PUXT\App(__DIR__);

$db = $app->config["database"];
Model::SetSchema(new Schema($db["hostname"], $db["username"], $db["password"], $db["database"]));

$app->run();
