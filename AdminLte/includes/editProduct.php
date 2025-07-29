<?php 
require 'AdminController/productController.php';
    $product = new productController();
    $id = $_SESSION['id'];
   $productNew = $product->fetchSingleproduct($id);

    if(isset($_POST['update_pro'])){
            $barcode = $_POST['barcode'];
        $proname = $_POST['pro_name'];
        $stock = $_POST['stock_qty'];
        $pro_img = $_FILES['pro_image'];
        $pro_desc = $_POST['pro_desc'];
        $purchase_p = $_POST['purchase_price'];
        $selling_p = $_POST['sales_price'];

        $upd_msg = "";
        
        if(!$product->updateProduct($id, $barcode, $proname, $stock, $pro_img, $pro_desc, $purchase_p, $selling_p)){
            //  echo "Error! Credentials Failed";
            $upd_msg = '<div class="alert alert-danger alert-dismissible">
                          <strong>Failed!</strong> Something went wrong.
                        </div>';
        }else{
          $upd_msg = '<div class="alert alert-success alert-dismissible">
                          <strong>Success!</strong> Registered successfully.
                      </div>';
            header('Location: adminDashboard.php?product');
          
        }

    }
?>
<div class="card-body">
      <?php if (isset($upd_msg)) echo $upd_msg; ?>
            <div class="form-group">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" value="<?= $productNew->barcode ?>" class="form-control" name="barcode">
                        </div>
                        <div class="form-group">
                            <input type="text" value="<?= $productNew->pro_name ?>" class="form-control" name="pro_name">
                        </div>

                        <div class="form-group">
                            <input type="number" min="0" step="any" value="<?= $productNew->stock ?>" class="form-control" name="stock_qty">
                        </div>
                        <div class="form-group">
                            <label for="">Product Image</label>
                            <input type="file" class="" name="pro_image">
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea class="form-control" name="pro_desc" id="" cols="9" rows="2"><?= $productNew->pro_desc ?></textarea>
                        </div>
                        <div class="form-group">
                            <input type="number"  placeholder="&#8358; Purchase Price" name="purchase_price" class="form-control" value="<?= $productNew->purchase_price ?>">
                        </div>
                        <div class="form-group">
                            <input type="number"  placeholder="&#8358; Sales Price" name="sales_price" class="form-control" value="<?= $productNew->sales_price ?>">
                        </div>
                    </div>
                    <button style="margin-left: 15px;" type="submit" class=" ms-5 btn btn-primary" name="update_pro">Update products</button>   
                </form>
            </div>
        </div>