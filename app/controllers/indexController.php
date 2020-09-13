<?php
namespace app\controllers;
use app\core\Controller;


class IndexController extends Controller {

  public function mainAction() {
    $this->view->getHeader( "Main page" );
    $this->view->getContent(
              // Requests for sorting by SELECT
    						$this->model->getTasks(),
    						$this->model->getUsers(),
    						$this->model->getEmails(),
    						$this->model->getStatuses(),

              // Paginator parameters
    						$paginator = $this->view->getPaginator(),
                $paginator->getCurrentPage(),
                $paginator->getNumOfItemsToShow(),
                $this->model->getNumOfItems(),
                $dbResult = $this->model->selectByGetParam( $res = $paginator->paginatorCurrentPage(), $paginator->getNumOfItemsToShow() )
    						);
    $this->view->getFooter();
  }

  public static function sqlModify( $sql ) {
    if( isset( $_GET['sort'] ) AND isset( $_GET['type'] ) )
      $sort = " ORDER BY " . $_GET['type'] . " " . $_GET['sort'];

    if( isset( $_GET['name'] ) ) {
      $sql .= " WHERE user = '$_GET[name]'";
    }
    elseif ( $_GET['email'] ) {
      $sql .= " WHERE email = '$_GET[email]'";
    }
    elseif ( $_GET['status'] ) {
      $sql .= " WHERE status = '$_GET[status]'";
    }
    else {
      $sql .= $sort;
    }
    return $sql;
  }
}


?>
