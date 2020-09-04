<?php
namespace app\core;

class View {
  public $path;
  public $layout = "default";

  public function __construct( $route ) {
    $this->route = $route;
    $this->path = $this->route['controller'] . "/" . $this->route['action'];
  }

  public function render( $title, $vars = [] ) {
    require_once( 'app/views/layouts/' . $this->layout . '/' . $this->route['action'] . '.php' );
  }
}

?>
