<?php

namespace app\models;

use app\core\Model;

class Index extends Model {
  public function getTasks() {
    $query = "SELECT * FROM task_book";
    $tasks = $this->dsn->query( $query );
    return $tasks;
  }
}

?>
