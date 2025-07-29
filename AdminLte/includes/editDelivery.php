<?php 
    include 'AdminController/orderListController.php';
    $data = new orderListController;
    if(isset($_POST['update'])){
        $class = $_POST['delivery'];
        $id = $_SESSION['id'];
        $result = $data->markasdelivered($id);
        $update_msg = "";
        if($result === true){
            $update_msg = '<div class="alert alert-success alert-dismissible">
                          <strong>Success!</strong> 
                        </div>';
        }else{
             $update_msg = '<div class="alert alert-danger alert-dismissible">
                          <strong>Failed!</strong> Something went wrong.
                        </div>';
        }
    }
?>
        <?php 
            if(isset($update_msg)){
                echo $update_msg;
                header('adminDashboard?order');
            }
        ?>
<form action="" method="post">

        <div class="form-group">
            <select name="delivery" id="" class="form-control">
            <option value="">SELECT STATUS</option>
            <option value="delivered">Delivered</option>
            </select>
                   
        </div>
        <button type="submit" name="update" class="btn btn-success">Update</button>
</form>