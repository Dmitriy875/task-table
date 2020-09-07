<?php

// Autoload
set_include_path( get_include_path() . PATH_SEPARATOR . "C:\OpenServer\domains\beejee2" );
spl_autoload_register();
spl_autoload_extensions( ".php,.inc" );

// Router
use route\RouterEngine;

// Session
session_start();

// Router instance
$router = new RouterEngine;
$router->start();
$router->match();
?>
