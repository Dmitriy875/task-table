<?php

// Autoload
set_include_path( get_include_path() . PATH_SEPARATOR . "C:\OpenServer\domains\beejee2" );
spl_autoload_register();
spl_autoload_extensions( ".php,.inc" );

$router = new route\RouterEngine;
echo $router->hi;
?>
