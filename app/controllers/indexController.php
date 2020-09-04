<?php
namespace app\controllers;
use app\core\Controller;

class IndexController extends Controller {

  public function mainAction() {
    echo "Стартовая страница.\nЕдиная точка входа";
    $this->view->render( "Главная страница" );
  }
}


?>
