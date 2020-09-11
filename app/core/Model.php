<?php

namespace app\core;

use app\lib\Db;

abstract class Model {

  protected $dsn;

  public function __construct() {
    $dbConnection = Db::getInstance();
    $this->dsn = $dbConnection->getConnection();
  }
}

?>
