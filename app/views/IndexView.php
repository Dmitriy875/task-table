<?php

namespace app\views;

use app\core\View;
use app\lib\modules\paginator\Paginator;

class IndexView extends View {

  public function getHeader( $title, $vars = [] ) {
    require_once( 'app/views/layouts/' . $this->layout . '/' . $this->route['method'][0] . '.php' );
  }

  public function getContent( $tasks, $users, $emails, $statuses, $paginator, $current_page, $itemsToShow, $numOfAllItems, $dbResult, $alert, $validation ) {
    require_once( 'app/views/layouts/' . $this->layout . '/' . $this->route['method'][1] . '.php' );
  }

  public function getFooter() {
    require_once( 'app/views/layouts/' . $this->layout . '/' . $this->route['method'][2] . '.php' );
  }

  public function getPaginator() {
    return new Paginator;
  }

  public function notify( $reject ) {
      for( $i = 0; $i < count( $reject['error'] ); $i++ )
        return "<span class='text-danger'>".$reject['error'][$i]."</span>";
  }


}


?>
