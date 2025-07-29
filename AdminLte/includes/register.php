
<?php
include 'AdminController/AdminUserController.php';

    $users = new AdminUserController();
    if(isset($_POST['submit'])){
        $userid = "STUDENT".rand(0, 999);
        $username = $_POST['username'];
        $phone = $_POST['Phone'];
        $userPassword = $_POST['password'];
        $class = $_POST['class'];

        
        $reg_msg = "";
        
        if(!$users->register($userid, $username, $phone, $userPassword, $class)){
            //  echo "Error! Credentials Failed";
            $reg_msg = '<div class="alert alert-danger alert-dismissible">
                          <strong>Failed!</strong> Something went wrong.
                        </div>';
        }else{
          $reg_msg = '<div class="alert alert-success alert-dismissible">
                          
                          <strong>Success!</strong> Registered successfully.
                      </div>';
          
        }

    }

?>
    <div class="container">

    <div class="row justify-content-center align-items-center" >
        <div class="col-md-6">
        <?php 
            if(isset($reg_msg)){
                echo $reg_msg;
            }
        ?>
            <form class="p-3 shadow bg-white rounded " method="POST" action="">
                <h4 class="text-center mb-4">Register</h4>

                <!-- User ID -->
                <div class="form-group">
                    <label for="userId">User ID</label>
                    <input type="text" class="form-control" id="userId" name="userId" readonly value="STUDENT123" required>
                </div>
                <div class="form-group">
                    <label for="userId">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="userId">Phone number</label>
                    <input type="text" class="form-control" id="Phone" name="Phone" placeholder="Phone" required>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" class="form-control" id="inputPassword" name="password" placeholder="*******" required>
                </div>
                <div class="form-group">
                   <select name="class" id="" class="form-control">
                   <option value="">SELECT CLASS</option>
                   <option value="JSS1">JSS1</option>
                   <option value="JSS2">JSS2</option>
                   <option value="JSS3">JSS3</option>
                   <option value="SSS1">SSS1</option>
                   <option value="SSS2">SSS2</option>
                   <option value="SSS3">SSS3</option>
                   </select>
                   
                </div>

                <!-- Submit Button -->
                <button type="submit" name="submit" class="btn btn-success btn-block mt-3">Register</button>
            </form>
        </div>
    </div>
</div>

<div class="row justify-content-center mt-2" >
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">STUDENT DATA</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>User id</th>
                  <th>Username</th>
                  <th>Phone</th>
                  <th>Class</th>
                  <th>School Fees</th>
                  <th>Date Created</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
<?php 
    $items = $users->showUsers();
    if(!empty($items)):

        foreach( $items as $item):
            // if($item->Class == ['JSS1, JSS2, JSS3, SSS1, SSS2, SSS3'])
?>
                <tr>
                  <td><?= $item->userId ?></td>
                  <td><?= $item->username ?></td>
                  <td><?= $item->phone_number ?> </td>
                  <td> <?= $item->class ?> </td>
                  <td> <?= $item->school_fees ?> </td>
                  <td> <?= $item->created_at ?> </td>
                  <td> 
                  <a href="adminDashboard.php?edit= <?= $item->id; ?>"  class="btn btn-success">Edit</a>  
                  <a href="adminDashboard.php?remove= <?= $item->id; ?>"  class="btn btn-danger">Remove</a>  
                    
                </td>
                </tr>
<?php
     endforeach; 
    endif;  
?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
</div>

