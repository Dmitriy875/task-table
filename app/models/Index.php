<?php

namespace app\models;

use app\core\Model;
use app\controllers\IndexController;
use app\lib\Db;
use app\lib\Utilities;

class Index extends Model {
  use Utilities;
  protected $authPermission;  //
  public static $query = "SELECT * FROM task_book ";

  public function getTasks() {
    $tasks = $this->dsn->query( self::$query );
    return $tasks;
  }

  public function createTask( $insecurePost ) {
    $name   = self::disarm( $insecurePost['name'] );
    $email  = self::disarm( $insecurePost['email'] );
    $task   = self::disarm( $insecurePost['task'] );

    $sql = "INSERT INTO task_book (user, email, task, status)
            VALUES ('$name', '$email', '$task', 'new')";

    $config = Db::getInstance();
    $stmt	= $config->pdo->prepare( $sql );
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }

  public function getUsers() {
    $query = "SELECT user FROM task_book";
    $users = $this->dsn->query( $query );
    $users = $users->fetchAll();
    return $users;
  }
  public function getEmails() {
    $query = "SELECT email FROM task_book";
    $emails = $this->dsn->query( $query );
    $emails = $emails->fetchAll();
    return $emails;
  }
  public function getStatuses() {
    $query = "SELECT status FROM task_book";
    $statuses = $this->dsn->query( $query );
    $statuses = $statuses->fetchAll();
    return $statuses;
  }

  public function getNumOfItems() {
    $stmt	= $this->dsn->prepare( IndexController::sqlModify( self::$query) ); //
    $stmt->execute();
    $result = $stmt->fetchAll();

    // Count all notes in DB
    return count( $result );
  }

  public function authQuery( $safeAuthData ) {
    if( $safeAuthData["error"] )
      return false;
    $error = "";
    $sql = "SELECT name, password
            FROM users WHERE name = '$safeAuthData[admin_name]'AND password = '$safeAuthData[admin_password]'";

    $config = Db::getInstance();
    $stmt	= $config->pdo->prepare( $sql );
    $stmt->execute();
    $result = $stmt->fetchAll();
    if( $result ) {
      return $this->authPermission = true;
    }
  }

  public function getOrderBy( $sql ) {
    $stmt	= $this->dsn->prepare( $sql );
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }
}

?>
