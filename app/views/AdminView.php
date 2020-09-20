<?php

namespace app\views;

use app\core\View;

class AdminView extends View {

  public function getHeader( $title, $vars = [] ) {
    require_once( 'app/views/layouts/' . $this->layout . '/admin/' . $this->route['method'][0] . '.php' );
  }

  public function getContent( $tasks ) {
    require_once( 'app/views/layouts/' . $this->layout . '/admin/' . $this->route['method'][1] . '.php' );
  }

}

?>
