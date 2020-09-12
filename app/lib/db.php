<?php

namespace app\lib;

use PDO;


class Db {
  private $host 		  = 'localhost';
  private $user 	   	= 'cadr';
  private $pass 		  = '';
  private $charset 	  = 'utf8';
  private $database 	= 'beejee';
  public 	$pdo;
  private static $instance;

  private function __construct() {}

  public static function getInstance() {
    if( empty( self::$instance ) ) {
      self::$instance = new Db;
    }
    return self::$instance;
  }

  function getConnection() {
    $dsn = "mysql:host=$this->host;dbname=$this->database;charset=$this->charset";
    $opt = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $this->pdo = new PDO( $dsn, $this->user, $this->pass, $opt );
    return $this->pdo;
  }
}

?>
