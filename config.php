<?php
require 'environment.php';

$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost/sistema/");
	$config['dbname'] = 'financeira';
	$config['host'] = 'localhost:3306';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
} else {
	define("BASE_URL", "http://localhost/nova_loja_painel/");
	$config['dbname'] = 'loja2';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
}

global $db;
try {
	$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}
