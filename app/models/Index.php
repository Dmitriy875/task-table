<?php

namespace app\models;

use app\core\Model;
use app\controllers\IndexController;

class Index extends Model {
  protected $query = "SELECT * FROM task_book ";

  public function getTasks() {
    $tasks = $this->dsn->query( $this->query );
    return $tasks;
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
    $stmt	= $this->dsn->prepare( IndexController::sqlModify( $this->query ) );
    $stmt->execute();
    $result = $stmt->fetchAll();

    // Count all notes in DB
    return count( $result );
  }


  public function selectByGetParam( $start, $limit ) {
    $sql = IndexController::sqlModify( $this->query );

    $setLimit = " LIMIT " . $start;
    $startFrom = ", " . $limit;

    if( $_GET['name'] ) {
      $dbResult = self::getOrderBy( $sql . $setLimit . $startFrom );
    }
    elseif ( $_GET['email'] ) {
      $dbResult = self::getOrderBy( $sql . $setLimit . $startFrom );
    }
    elseif ( $_GET['status'] ) {
      $dbResult = self::getOrderBy( $sql . $setLimit . $startFrom );
    }
    else {
      $dbResult = self::getOrderBy( $sql . $setLimit . $startFrom );
      }
    return $dbResult;
  }

  public function getOrderBy( $sql ) {
    $stmt	= $this->dsn->prepare( $sql );
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }
}

?>
