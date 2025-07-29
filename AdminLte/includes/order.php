
<?php 
    include 'AdminController/orderListController.php';
    $data = new orderListController;
?>
<div class="row justify-content-center"  >
    <div class="box" style="margin-left: 0px; margin-right: 5px;">

            <div class="box-header">
              <h3 class="box-title">New orders</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Email</th>
                  <th>Reference</th>
                  <th>Phone number</th>
                  <th>Product bought</th>
                  <th>Price</th>
                  <th>Delivery Status</th>
                  <th>Date Created</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
<?php 
    $items = $data->fetchNewOrders();
    if(!empty($items)):

        foreach( $items as $item):
            $_SESSION['id'] = $item->id;
            // if($item->Class == ['JSS1, JSS2, JSS3, SSS1, SSS2, SSS3'])
?>
                <tr>
                  <td><?= $item->email ?></td>
                  <td><?= $item->reference ?></td>
                  <td><?= $item->phone ?> </td>
                  <td> <?= $item->product ?> </td>
                  <td> <?= $item->amount ?> </td>
                  <td> <?= $item->delivered ?> </td>
                  <td> <?= $item->created_at ?> </td>
                  <td> 
                  <a href="adminDashboard.php?editDelivery= <?= $_SESSION['id']; ?>"  class="btn btn-success">Edit Delivery status</a>     
                </td>
                </tr>
<?php
     endforeach; 
    else: echo "No data";
    endif;  
?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
</div>
<!-- 
Undelivered -->

<div class="row justify-content-center mt-2" >
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Delivered orders</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Email</th>
                  <th>Reference</th>
                  <th>Phone number</th>
                  <th>Product bought</th>
                  <th>Price</th>
                  <th>Delivery Status</th>
                  <th>Date Created</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
<?php 
    $items = $data->fetchOldOrders();
    if(!empty($items)):

        foreach( $items as $item):
            $_SESSION['oldid'] = $item->id;
            // if($item->Class == ['JSS1, JSS2, JSS3, SSS1, SSS2, SSS3'])
?>
                <tr>
                  <td><?= $item->email ?></td>
                  <td><?= $item->reference ?></td>
                  <td><?= $item->phone ?> </td>
                  <td> <?= $item->product ?> </td>
                  <td> <?= $item->amount ?> </td>
                  <td> <?= $item->delivered ?> </td>
                  <td> <?= $item->created_at ?> </td>
                  <td> 
                  <a href="adminDashboard.php?editOldDelivery= <?= $_SESSION['oldid']; ?>"  class="btn btn-success">Edit Delivery status</a>     
                </td>
                </tr>
<?php
     endforeach; 
    else: echo "No data";
    endif;  
?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
</div>
</div>

<script>
  $(function () {
    $('#example3').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>