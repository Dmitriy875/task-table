<?php

namespace app\models;

use app\core\Model;
use app\controllers\AdminController;
use app\lib\Db;
use app\lib\Utilities;

class Admin extends Model {
  use Utilities;
  protected $query = "SELECT * FROM task_book ";
  public function getTasks() {
    $tasks = $this->dsn->query( $this->query );
    return $tasks;
  }

  public function updateStatus( $logInCheck ) {
    if( !$logInCheck ) {
      return false;
    } else {
      $status = self::disarm( $_POST['status'] ); //
      $sql = "UPDATE task_book
      SET status  = '$status'
      WHERE id = '$_POST[id]';

      ";
      $config = Db::getInstance();
      $stmt	= $config->pdo->prepare( $sql );
      $stmt->execute();
    }
  }

  public function updateAll( $logInCheck ) {
    if( !$logInCheck ) {
      return false;
    } else {
      $task = ( $_POST['task'] );     //
      $status = ( $_POST['status'] ); //
      $sql = "UPDATE task_book
              SET task    = '$task',
                  status  = '$status',
                  admin_edit = true
              WHERE id = '$_POST[id]';

              ";
      $config = Db::getInstance();
      $stmt	= $config->pdo->prepare( $sql );
      $stmt->execute();
    }
  }
}

?>
