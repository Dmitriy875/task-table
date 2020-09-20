<?php

namespace app\controllers;
use app\core\Controller;

class AdminController extends Controller {
  private $auth = false;

  public function manageAction() {
    self::sessionBreak();
    self::sessionCheck();
    $this->view->getHeader( "Admin panel" );
    $tasks = $this->model->getTasks();
    $this->view->getContent( $tasks, self::postAction() );
  }

  public function sessionCheck() {
    if( !$_SESSION['authenticated'] ) {
      header( "Location: /");
      return false;
    } else
        return $this->auth = true;
  }

  public function postAction() {
    if( $_POST ) {
      if( $_POST['task'] == $_POST['task_check'] ) {
        $this->model->updateStatus( $this->auth );
      } else {
        $this->model->updateAll( $this->auth );
      }
    }
  }

  public function sessionBreak() {
    if( $_GET['auth'] === "logout" )  {
      session_unset();
      session_destroy();
    }
  }
}



?>
