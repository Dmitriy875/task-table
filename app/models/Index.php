<?php

namespace app\models;

use app\core\Model;

class Index extends Model {
  public function getTasks() {
    $query = "SELECT * FROM task_book";
    $tasks = $this->dsn->query( $query );
    return $tasks;
  }

  public function getUsers() {
    $query = "SELECT user FROM task_book";
    $users = $this->dsn->query( $query );
    return $users;
  }
  public function getEmail() {
    $query = "SELECT email FROM task_book";
    $emails = $this->dsn->query( $query );
    return $emails;
  }
  public function getStatus() {
    $query = "SELECT status FROM task_book";
    $statuses = $this->dsn->query( $query );
    return $statuses;
  }  
}

?>
