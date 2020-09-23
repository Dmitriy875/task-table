<?php
namespace app\controllers;
use app\core\Controller;


class IndexController extends Controller {

  public function mainAction() {
    // Authentification
    $safeAuthData = $this->safeAuth();
    $authResult   = $this->model->authQuery( $safeAuthData );
    if( !$authResult )
      $alert = $this->view->notify( $safeAuthData );
    $this->auth( $authResult );
    // Logout
    self::sessionBreak();

    $this->view->getHeader( "Main page" );
    $validation = self::formValidation();
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
                $dbResult = $this->selectByGetParam( $res = $paginator->paginatorCurrentPage(), $paginator->getNumOfItemsToShow() ),

              // Validation messages
                $alert,
                $validation
    						);



    $this->view->getFooter();
  }

  // SQL-modification
  public function selectByGetParam( $start, $limit ) {
    $sql = self::sqlModify( $this->model::$query );

    $setLimit = " LIMIT " . $start;
    $startFrom = ", " . $limit;

    if( $_GET['name'] ) {
      $dbResult = $this->model->getOrderBy( $sql . $setLimit . $startFrom );
    }
    elseif ( $_GET['email'] ) {
      $dbResult = $this->model->getOrderBy( $sql . $setLimit . $startFrom );
    }
    elseif ( $_GET['status'] ) {
      $dbResult = $this->model->getOrderBy( $sql . $setLimit . $startFrom );
    }
    else {
      $dbResult = $this->model->getOrderBy( $sql . $setLimit . $startFrom );
      }
    return $dbResult;
  }
  // SQL-modification for SELECT
  public function sqlModify( $sql ) {
    $whitelist = require('app\config\gets.php');

    // & SQL-injection secure using whitelist
    if( isset( $_GET['sort'] ) AND isset( $_GET['type'] ) AND $sort = array_search( $_GET['sort'], $whitelist ) AND $type = array_search( $_GET['type'], $whitelist ) ) {
      $sort = " ORDER BY " . $whitelist[$type] . " " . $whitelist[$sort];
    } else {
      http_response_code(404);
    }

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


  // Auth functions
  public function auth( $answer ) {
    if( $answer == true ) {
      $_SESSION['authenticated'] = true;
      header( "Location: /admin ");
    }
  }

  public function safeAuth() {
    $error = array();
    $safePost = array();
    if( $_POST['auth_try'] ) {
      if(!$_POST['admin_name'] AND !$_POST['admin_password'])
        $error['error'][] = 'Enter anything';

      if( !$_POST['admin_name'] )
        $error['error'][] = 'Enter user name';
      if( !$_POST['admin_password'] )
        $error['error'][] = 'Enter password';

      if( empty( $error ) ) {
        foreach( $_POST as $postItemName => $postItemValue ) {
          $safePost[$postItemName] = $postItemValue ; //
        }
        return $safePost;
      } else {
        return $error;
      }
    }
  }
  // Logout
  public function sessionBreak() {
    if( $_GET['auth'] === "logout" )  {
      session_unset();
      session_destroy();
    }
  }

  public function formValidation() {
    $error = "";
    if( $_POST['create_try'] ) {
      if( $_POST['email']
          AND (!strstr( $_POST['email'], '@' )
              OR strlen( $_POST['email'] ) < 5 ) )  {
        $error .= "<p><div class='alert alert-danger'> Incorrect <b>email</b> value</div></p>";
      }

      foreach( $_POST as $name => $postItem ) {
        if( empty( $postItem ) ) {
          $error .= "<p><div class='alert alert-danger'> <b>" . ucfirst( $name ) . "</b> field is empty!</div></p>";
        }
      }
      if( empty( $error ) ) {
        $this->model->createTask( $_POST );
        return $success = "<p><div class='alert alert-success'>Task is successfully created.</div></p>";
      } else
          return $error;
    }
  }
}

?>
