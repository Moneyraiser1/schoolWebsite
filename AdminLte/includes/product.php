<?php require 'AdminController/productController.php'; ?>
<?php
   $product = new productController();

    if(isset($_POST['add_pro'])){
        
        $barcode = $_POST['barcode'];
        $proname = $_POST['pro_name'];
        $stock = $_POST['stock_qty'];
        $pro_img = $_FILES['pro_image'];
        $pro_desc = $_POST['pro_desc'];
        $purchase_p = $_POST['purchase_price'];
        $selling_p = $_POST['sales_price'];
        $reg_msg = "";
        $result = $product->InsertProducts($barcode, $proname, $stock, $pro_img, $pro_desc, $purchase_p, $selling_p); 
        if($result === true){
            //  echo "Error! Credentials Failed";
            $reg_msg = '<div class="alert alert-success alert-dismissible">
                            <button type="button" class="btn-close" data-bs-dismiss="alert">X</button>
                          <strong>Failed!</strong>Product Registered Successfully .
                        </div>';
        }else{
          $reg_msg = '<div class="alert alert-danger alert-dismissible">
                          <button type="button" class="btn-close" data-bs-dismiss="alert">X</button>
                          <strong>Failed!</strong> '. $result .'
                      </div>';
          
        }

    }
if (isset($_GET['deleteProduct'])) {
    $id = intval($_GET['deleteProduct']);
    $product->deleteProduct($id);
    header("Location: adminDashboard.php?product");
    exit();
}
?>
    <div class="card">

     <?php if (isset($reg_msg)) echo $reg_msg; ?>

        <div class="card-header">
            <h3 class="ms-5">Add Products</h3>
        </div>

        <div class="card-body">
            <div class="form-group">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" placeholder="Barcode" class="form-control" name="barcode">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Product name" class="form-control" name="pro_name">
                        </div>

                        <div class="form-group">
                            <input type="number" min="0" step="any" placeholder="Stock Qty" class="form-control" name="stock_qty">
                        </div>
                        <div class="form-group">
                            <label for="">Product Image</label>
                            <input type="file" class="" name="pro_image">
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea class="form-control" name="pro_desc" id="" cols="9" rows="2" placeholder="Product description"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="number"  placeholder="&#8358; Purchase Price" class="form-control" name="purchase_price">
                        </div>
                        <div class="form-group">
                            <input type="number"  placeholder="&#8358; Sales Price" class="form-control" name="sales_price">
                        </div>
                    </div>
                    <button style="margin-left: 15px;" type="submit" class=" ms-5 btn btn-primary" name="add_pro">Add products</button>   
                </form>
            </div>
        </div>
    </div>

    <hr>
    <hr>
    <div class="row justify-content-center mt-5" style="margin-left: 15px; margin-right: 15px; ">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Barcode</th>
                  <th>Product name</th>
                  <th>Product Image</th>
                  <th>Stock</th>
                  <th>Product description</th>
                  <th>Purchase Price</th>
                  <th>Sales Price</th>
                  <th>Edit</th>
                </tr>
                </thead>
                <tbody>
<?php 
    $items = $product->fetchproducts();
    if(!empty($items)):

        foreach( $items as $item):
            $_SESSION['id'] = $item->id;
            // if($item->Class == ['JSS1, JSS2, JSS3, SSS1, SSS2, SSS3'])
?>
                <tr>

                  <td><?= $item->barcode ?></td>
                  <td><?= $item->pro_name ?> </td>
                  <td>  <img style="width: 40px; height: 40px;" src="/FLCS/AdminLte/includes/productImage/<?= $item->pro_image ?>" alt="Image"></td>
                  <td> <?= $item->stock ?> </td>
                  <td> <?= $item->pro_desc ?> </td>
                  <td> <?= $item->purchase_price ?> </td>
                  <td> <?= $item->sales_price
 ?> </td>
                  <td> 
                  <a href="adminDashboard.php?editProduct= <?= $_SESSION['id']; ?>"  class="btn btn-success text-light">Edit</a>     
                  <a href="adminDashboard.php?deleteProduct= <?= $_SESSION['id']; ?>"  class="btn btn-danger text-light">Delete</a>     
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

  
 
 