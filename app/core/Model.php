<?php

namespace app\core;

use app\lib\Db;

abstract class Model {

  protected $db;

  public function __construct() {
    $dbConnection = Db::getInstance();
    $this->db = $dbConnection->getConnection();
  }
}

?>
