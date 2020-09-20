<?php
namespace app\core;

use app\lib\modules\paginator\Paginator;

abstract class View {
  public $path;
  public $layout = "default";
  public $route;

  public static $cssFilesToConnect = array();
  public static $trustedCssFiles = array(
    "bootstrap.min.css" => "default",
  );

  public function __construct( $route ) {
    $this->route = $route;
    $this->path = $this->route['controller'] . "/" . $this->route['action'];
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

  public static function includeCssFiles() {
    foreach( self::$cssFilesToConnect as $file ) {
      echo "<link rel='stylesheet' href='" . $file . "'>";
    }
  }
}




?>
