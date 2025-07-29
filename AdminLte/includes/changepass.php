<?php 
include 'AdminController/AdminUserController.php';
$users = new AdminUserController();

// Handle password update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $userid = trim($_POST['userID']);
    $username = trim($_POST['username']);
    $phone = trim($_POST['phone']);
    $class = trim($_POST['class']);
    $schoolFee = trim($_POST['schoolFees']);
 
    // You may want to pass the $userid too if changing another user's password
    $result = $users->adminChangePassword($id,$userid, $username, $phone, $class, $schoolFee);

    if ($result === true) {
        echo '<div class="alert alert-success">Updated Details successfully.</div>';
    } else {
        echo '<div class="alert alert-danger">Error: ' . htmlspecialchars($result) . '</div>';
    }
}

include 'displaystudents.php';  
?>


<div class="col-md-8">
<div class="card">
    <div class="card-header">
        <h1>Change Password</h1>
    </div>
<div class="card-body">

            <div class="form-group">
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($student['id']) ?>">


                        <div class="form-group">
                            <input type="text" class="form-control" value="<?= htmlspecialchars($student['userId']) ?>" name="userID">
                        </div>
                        <div class="form-group">
                            <input type="text"  class="form-control" name="username" value="<?= htmlspecialchars($student['username']) ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" value="<?= htmlspecialchars($student['phone_number']) ?>">
                        </div>
                        <div class="form-group">
                            <select name="class" id="" class="form-control">
                            <option value="<?= htmlspecialchars($student['Class']) ?>"><?= htmlspecialchars($student['Class']) ?></option>
                            <option value="JSS1">JSS1</option>
                            <option value="JSS2">JSS2</option>
                            <option value="JSS3">JSS3</option>
                            <option value="SSS1">SSS1</option>
                            <option value="SSS2">SSS2</option>
                            <option value="SSS3">SSS3</option>
                            </select>   
                        </div>
                        <div class="form-group">
                            <select name="schoolFees" id="" class="form-control">
                                <option value="<?= htmlspecialchars($student['school_fees']) ?>"><?= htmlspecialchars($student['school_fees']) ?></option>
                                <option value="paid">Paid</option>
                                <option value="unpaid">Unpaid</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class=" ms-5 btn btn-primary" name="update">Update</button>   
                </form>
            </div>
        </div>
</div>

<?php
// 1. Connect to the database

?>