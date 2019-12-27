<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

require 'config.php';
require 'vendor/autoload.php';

$core = new Core\Core();
$core->run();