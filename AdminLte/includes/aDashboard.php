<?php 
     include 'AdminController/orderListController.php';
     include 'AdminController/AdminUserController.php';
    $data = new orderListController;
    $user = new AdminUserController;


    $countUser = $user->countRegisteredStudents();
    $countContact = $user->countContact();
    $countData = $data->countOrderList();
?>
<section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $countData->num_orders ?></h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="adminDashboard.php?order" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $countContact->num_message ?></h3>

              <p>New messages</p>
            </div>
            <div class="icon">
              <i class="fa fa-phone"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $countUser->num_students ?></h3>

              <p>Students registered</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="adminDashboard.php?register" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      
      <!-- /.row (main row) -->

    </section>

          
<div class="col-md-9 mb-5">
    <div class="alert alert-success alert-dismissible">
    <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
    <strong>Note!</strong> Data in order list, contact deletes after 30 days from entry.
  </div>