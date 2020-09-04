<?php
namespace app\core;
use app\core\View;

abstract class Controller {
  protected $route;
  protected $view;

  public function __construct( $route ) {
    $this->route = $route;
    $this->view = new View( $this->route );

    // print_r( $route );
  }
}

?>
