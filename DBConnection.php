<?php
require_once 'config.php';
$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE.";charset=UTF8", DB_USER, DB_PASSWORD);
?>