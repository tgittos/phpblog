<?php

/**
* This is a not-so-simple blog engine. But it started simple.
*/

include_once 'core/Startup.php';

$request = Request::getInstance(new Filter());
$controller = new Controller();
$controller->process($request->mode);
?>