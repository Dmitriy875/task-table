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
}

?>
