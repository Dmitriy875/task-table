<?php
namespace app\core;
use app\lib\modules\paginator\Paginator;

class View {
  public $path;
  public $layout = "default";

  public static $cssFilesToConnect = array();
  public static $trustedCssFiles = array(
    "bootstrap.min.css" => "default",
  );

  public function __construct( $route ) {
    $this->route = $route;
    $this->path = $this->route['controller'] . "/" . $this->route['action'];
  }

  public function getHeader( $title, $vars = [] ) {
    require_once( 'app/views/layouts/' . $this->layout . '/' . $this->route['method'][0] . '.php' );
  }

  public function getContent( $tasks, $users, $emails, $statuses, $paginator, $current_page, $itemsToShow, $numOfAllItems, $dbResult ) {
    require_once( 'app/views/layouts/' . $this->layout . '/' . $this->route['method'][1] . '.php' );
  }

  public function getFooter() {
    require_once( 'app/views/layouts/' . $this->layout . '/' . $this->route['method'][2] . '.php' );
  }

  public function getPaginator() {
      return new Paginator;
  }


  // CSS connection
  public static function getCssFiles() {
    foreach( self::$trustedCssFiles as $cssFile => $template) {
      $filePath = "public/css/" . $cssFile;
      if( file_exists( $filePath ) ){
        self::$cssFilesToConnect[] .= $filePath;
      }
    }
  }

  public function includeCssFiles() {
    foreach( self::$cssFilesToConnect as $file ) {
      echo "<link rel='stylesheet' href='" . $file . "'>";
    }
  }
}




?>
