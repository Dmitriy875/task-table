<?php
namespace app\controllers;
use app\core\Controller;

class IndexController extends Controller {

  public function mainAction() {
    $this->view->getHeader( "Main page" );
    $this->view->getContent();
    $this->view->getFooter();
  }
}


?>
