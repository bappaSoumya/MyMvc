<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'D:/xampp/htdocs/MyMvc/error.log');

// Verify Composer autoloader exists
$autoloader = '../vendor/autoload.php';
if (!file_exists($autoloader)) {
    die('Error: Composer autoloader not found at ' . $autoloader . '. Run "composer install" in D:\xampp\htdocs\MyMvc');
}
require_once $autoloader;

// Verify .env file exists
use Dotenv\Dotenv;

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

require_once '../app/core/Core.php';
require_once '../config/database.php';
require_once '../config/constants.php';
require_once '../app/core/Router.php';
require_once '../app/core/Registration.php';
require_once '../app/core/Request.php';
require_once '../app/core/fileUpload.php';

$registration = new Registration();



$router = new Router();
$router->route();