<?php
namespace app\core;
use app\core\View;
use app\models\Index;

abstract class Controller {
  protected $route;
  protected $view;
  protected $model; //

  public function __construct( $route ) {
    $this->route = $route;
    $this->view = new View( $this->route );
    $this->model = self::getModel( $this->route['controller'] ); //
  }

  public function getModel( $model ) {
    $path = "app\models\\" . ucfirst( $model );
    if( class_exists( $path ) ) {
      return new $path;
    } else {
      echo "модель не найдена";
    }
  }
}

?>
