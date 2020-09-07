<?php
namespace Route;
use app\controllers;

class RouterEngine {
  protected $routes = array();
  protected $params = array();

  public function __construct() {
    $arr = require_once( 'app/config/routes.php');
    foreach( $arr as $route => $params ) {
      self::add( $route, $params );
    }
  }

  public function add( $route, $params ) {
    $route = "#^" .$route . "$#";
    $this->routes[ $route ] = $params;
  }

  public function match() {
    $url = trim( $_SERVER['REQUEST_URI'], '/' );
    foreach ($this->routes as $route => $params ) {
      if( preg_match( $route, $url, $matches ) ) {
        $this->params = $params;
        return true;
      }
    }
  }

  public function start() {
    if( self::match() ) {
      $path = "app\controllers\\" . ucfirst( $this->params['controller'] ) . "Controller";
      if( class_exists( $path ) ) {
        $action = $this->params['action'] . "Action";
        if( method_exists( $path, $action ) ) {
          $controller = new $path( $this->params );
          $controller->$action();

          foreach( $this->params['method'] as $method ) {
            $method = "get" . ucfirst( $this->$method );
            if( method_exists( $path, $method ) ) {
              $controller->$method();
              echo ( $method );
            }

          }
        }
      } else {
        echo "не найден: " . $path;
      }
    } else {
      echo "Маршрут не найден";
    }

  }
}

?>
