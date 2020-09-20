<?php
namespace app\core;
use app\core\View;
use app\models\Index;
use app\views\IndexView;

abstract class Controller {
  protected $route;
  protected $view;
  protected $model; //

  public function __construct( $route ) {
    $this->route = $route;
    $this->view = self::getView( $this->route['controller'] );
    $this->model = self::getModel( $this->route['controller'] ); //
  }

  public function getModel( $model ) {
    $path = "app\models\\" . ucfirst( $model );
    if( class_exists( $path ) ) {
      return new $path;
    } else {
      echo "модель не найдена ";
    }
  }

  public function getView( $view ) {
    $path = "app\\views\\" . ucfirst( $view ) . "View";
    if( class_exists( $path ) ) {
      return new $path( $this->route );
    } else {
      echo "вид " . $path . " не найден ";
    }
  }
}

?>
