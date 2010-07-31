<?php

//Initial config, move to startup file?
require_once "config.php";
require_once ROOT_PATH . "/core/Autoload.php";
Autoload::register();

//Doctrine stuff, move to separate file
require_once 'Doctrine/Doctrine.php';
spl_autoload_register(array('Doctrine', 'autoload'));
Doctrine_Manager::getInstance()->setAttribute('model_loading', 'conservative');
Doctrine::loadModels(ROOT_PATH . '/core/models');
Doctrine_Manager::connection(DB_SERVER . '://' . DB_USER . ':' . DB_PASSWORD . '@' . DB_HOST . '/' . DB_NAME);

//PHPTAL stuff
require_once 'PHPTAL/PHPTAL.php';

//Session stuff
//$session = new SessionManager(md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['HTTP_ACCEPT'] . "saltysaltsalt"));
session_start();

//Exception handling
function exception_handler($exception) {
  echo "Uncaught exception: " , $exception->getMessage(), "\n";
}
set_exception_handler('exception_handler');

?>