<?php require 'loginHeader.php'; ?>
<?php require '../inc/alertify.php';
    
?>

<div class="container">
    <div class="row justify-content-center mb-5 p-2">
        <div class="col-md-6">
            <form class="form-control mt-5" method="POST" action="login.php">
                <h4 class="text-center mt-3">Log in</h4>
                <div class="">
                    <label for="staticemail" class="col-sm-2 col-form-label">UserId:</label>
                    <div class="">
                        <input type="text" class="form-control" name="userId" placeholder="user123">
                    </div>
                </div>
                <div class="">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password:</label>
                    <div class="">
                        <input type="password" class="form-control" id="inputPassword" placeholder="*******" name="password">
                    </div>
                </div>

                <button type="submit" name="submit" class="w-100 btn btn-lg btn-dark mt-4 mb-4 ">Register</button>
                
            </form>
        </div>
    </div>

</div>

<?php require '../inc/footer.php'; ?>

<?php login(); ?>