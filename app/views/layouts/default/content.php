<body>
<div class="container">
  <div class="jumbotron pt-4 pb-0">
    <div class="row">
      <div class="col-sm-3 offset-md-9">
      <?php  if( $_SESSION['authenticated']): ?>
      <a href="admin" class="btn btn-light">Admin</a>
          <a href="?auth=logout" class="btn btn-light">Logout</a>
      <?php else: ?>
        <form action="/" method="POST">
          <div class="form-group">
            <input type="text" name="admin_name" placeholder="Login" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>

          <div class="form-group">
            <input type="password" name="admin_password" placeholder="Password" class="form-control" id="exampleInputPassword1">
          </div>

          <div class="row">
            <div class="col-sm-5">
              <button type="submit" name="auth_try" class="btn btn-primary" value='auth'>Sign in</button>
            </div>
            <div class="col-sm-7">
              <?php if( $_POST['auth_try'] ) echo  $alert ?>
            </div>
          </div>
        </form>
      <?php endif ?>

      </div>
      <div class='col-sm-9'>
        <h1 class="display-3 text-white">Task-table</h1>
      </div>
    </div>
  </div>
</div>
<div class="row justify-content-start justify-content-center justify-content-end">
  <div class="col-md-6">
    <div class="alert alert-info" role="alert">

      <?php
      if( $_GET['name'] ) {
          $attr = "&name=".$_GET['name'];
      }
      if( $_GET['email'] ) {
          $attr = "&email=".$_GET['email'];
      }
      if( $_GET['status'] ) {
          $attr = "&status=".$_GET['status'];
      }
      if( $_GET['sort'] ) {
          $sort = "&sort=".$_GET['sort']."&type=".$_GET['type'];
      }
      ?>


            <div class="sm-1">
              <span class="alert-link">Sort by user: </span><span class="small"><a href="?sort=asc&type=user">asc</a> | <a href="?sort=desc&type=user">desc</a></span>
              <select class="" name="" onchange="if (this.value) window.location.href = this.value">
                <option value="">Select</option>
                <?php
                // $users recieved from Index::$getUsers()
                $dbSelectUsers = $users;

                $userNamesArr = array_column( $dbSelectUsers, 'user');
                $userNamesUniqArr = array_unique( $userNamesArr );
                foreach( $userNamesUniqArr as $userName ) {
                  echo "<option value='?name=$userName&select=name'>$userName</option>";
                }?>
              </select>
            </div>
              <div class="sm-1">
                <span class="alert-link">Sort by email: </span><span class="small"><a href="?sort=asc&type=email">asc</a> | <a href="?sort=desc&type=email">desc</a></span>
                <select class="" name="" onchange="if (this.value) window.location.href = this.value">
                  <option value="">Select</option>
                  <?php
                  // $emails recieved from Index::$getEmails()
                  $dbSelectEmails = $emails;

                  $emailArr = array_column( $dbSelectEmails, 'email');
                  $emailUniqArr = array_unique( $emailArr );
                  foreach( $emailUniqArr as $userEmail ) {
                    echo "<option value='?email=$userEmail&select=email'>$userEmail</option>";
                  }?>
                </select>
              </div>
              <div class="sm-1">
                <span class="alert-link">Sort by status: </span><span class="small"><a href="?sort=asc&type=status">asc</a> | <a href="?sort=desc&type=status">desc</a></span>
                <select class="" name="" onchange="if (this.value) window.location.href = this.value">
                  <option value="">Select</option>
                  <?php
                  // $statuses recieved from Index::$getStatuses()
                  $dbSelectStatus = $statuses;

                  $statusArr = array_column( $dbSelectStatus, 'status');
                  $statusUniqArr = array_unique( $statusArr );

                  foreach( $statusUniqArr as $status ) {
                    echo "<option value='?status=$status&select=status'>$status</option>";
                  }?>
                </select>
              </div>






    </div>
      <?php
      // $tasks recieved from Index::$getTasks()
      foreach( $dbResult as $person ): ?>

      <div class="alert alert-secondary" role="alert">

        <div class="clearfix">
          For user: <a href="?name=<?php echo $person['user']; ?>" class="alert-link">
          <?php echo $person['user']; ?></a>

          ( <a href="?email=<?php echo $person['email']; ?>" class="small"><?php echo $person['email']; ?></a> )
        </div>

        <div class="row">
          <div class="col-sm-9">
            Task: <span class="alert-link"><?php echo $person['task']; ?></span>
          </div>

          <div class="col-sm-3 text-right"><?php if( $person['admin_edit'] ) echo "<small>Edited by admin</small>"; ?></div>
        </div>

        <div class="clearfix">
          <a href="?status=<?php echo $person['status']; ?>" class="alert-<?php echo $paginator->statusColor( $person['status'] ) ?>"> <?= $person['status']; ?></a>
        </div>
      </div>
    <?php endforeach ?>
      </tbody>

    <nav aria-label="Page navigation example">
      <ul class="pagination">

        <li class="page-item">
          <a class="page-link" href="?current_page=<?php echo $paginator->navPrevious() . $attr. $sort ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>

      <?php
        for( $i = 1; $i < ( $paginator->getNumOfAllPages( $numOfAllItems ) + 1 ); $i++) {
           echo '<li class="page-item"><a class="page-link" href="?current_page='.$i.$attr.$sort.'">' . $i . '</a></li>';
        }
        ?>

        <li class="page-item">
          <a class="page-link" href="?current_page=<?php echo $paginator->navNext() . $attr.$sort ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
        <?php
        if( $_GET )
         echo '<span><a href="/" class="page-link">reset</a></span>';
        ?>

      </ul>
    </nav>
    <?php echo $validation; require_once( "app/views/layouts/default/forms/add_task.php" ); ?>
  </div>
</div>
</body>
</html>
