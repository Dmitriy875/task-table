<?php

namespace app\lib\modules\paginator;

class Paginator {
  private $numOfAllItems;
  private $numOfItemsToShow;
  private $currentPage;
  private $numOfAllPages;
  public $model;
  public $view;


  // Get number of current paga from $_GET
  public function getCurrentPage() {
    if( $_GET['current_page'] )
      $this->currentPage = $_GET['current_page'];
    else
      return $this->currentPage = 1;
  }

  // Select number of items to show on page
  public function getNumOfItemsToShow() {
    return $this->numOfItemsToShow = 3;
  }

  // Number of page for sql-query, $start for LIMIT in selectByGetParam()
  public function paginatorCurrentPage() {
    return ($this->currentPage -1) * $this->numOfItemsToShow;
  }

  // Number of pages on paginator scale
  public function getNumOfAllPages( $numOfAllItems ) {
    if( ( $numOfAllItems % $this->numOfItemsToShow) == 0 )
      $num = $numOfAllItems / $this->numOfItemsToShow;
    else
      $num = round( $numOfAllItems / $this->numOfItemsToShow, PHP_ROUND_HALF_UP );
      return $this->numOfAllPages = $num;
  }

  public function navPrevious() {
    if( $this->currentPage == 1 )
      return 1;
    else
      return $this->currentPage - 1;
  }

  public function navNext() {
    if( $this->currentPage < $this->numOfAllPages )
      return $this->currentPage + 1;
    else
      return $this->currentPage;
  }

  public function statusColor( $color ) {
    if( $color == "failed" )
      return "danger";
    elseif( $color == "complete" )
      return "success";
    elseif( $color == "in progress" )
      return "primary";
    elseif( $color == "new" )
      return "warning";
  }
}


?>
