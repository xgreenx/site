<?php
//FRONT CONTROLLER

//1 Общие настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);
//2 Подключения файлов в системы
define('ROOT', dirname(__FILE__));


include_once 'models/User.php';
include_once 'models/Tour.php';
include_once 'components/Pagination.php';

//echo __FILE__;
//echo "<br>";
//echo dirname(__FILE__);

//echo "Hello world";
//3 Установка соединения с базой данных
include_once(ROOT.'/components/Db.php');
//4 Вызов Router 

require_once(ROOT.'/components/Router.php');

$router = new Router();
$router->run();
