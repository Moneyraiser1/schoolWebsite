<?php require '../inc/header.php' ?>
<?php require '../inc/alertify.php';?>

<div class="container">
    <div class="row justify-content-center mb-5 p-2">
        <div class="col-md-6">
            <form class="form-control mt-5" method="POST" action="contact.php">
                <h4 class="text-center mt-3">Contact us</h4>
                <div class="">
                    <label for="staticemail" class="col-sm-2 col-form-label">Title:</label>
                    <div class="">
                        <input type="text" class="form-control" name="title" placeholder="Title">
                    </div>
                </div>
                <div class="">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Description:</label>
                    <div class="">
                       <textarea class="form-control" name="desc" id="" cols="50" rows="10" placeholder="Description"></textarea>
                    </div>
                </div>

                <button type="submit" name="submit" class="w-100 btn btn-lg btn-dark mt-4 mb-4 ">Send <span><i class="fa fa-paper-plane"></i></span></button>
                
            </form>
        </div>
    </div>

</div>

<?php require '../inc/footer.php'; ?>

<?php sendData(); ?>