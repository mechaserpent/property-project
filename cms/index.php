<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
    header("HTTP/1.1 200 OK");
    exit();
}
require_once("vendor/autoload.php");
(new PUXT\App(__DIR__))->run();
