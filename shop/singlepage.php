<?php require '../inc/header.php' ?>
<?php require '../inc/alertify.php';
    if(!isset($_SESSION['auth_user']['username'])){
        header('Location: ../index.php');
    }
?>

<div class="container">
    <div class="row mt-5 p-3 border rounded ms-5">
        <div class="col-md-10">
            <div class="row">
    <?php 
    
        if(isset($_GET['id'])){
            $pro_id = $_GET['id'];

            $queryData = $db->prepare('SELECT * FROM products WHERE id = :pro_id');
            $queryData->bindParam(':pro_id', $pro_id, PDO::PARAM_INT);
            $queryData->execute();
        
            $row = $queryData->fetch(PDO::FETCH_OBJ);
        
            if($row){
                
                if (isset($_SESSION['auth_user']['id'])) {
                    $user_id = $_SESSION['auth_user']['id'];
                    $checkCartPro = $db->prepare('SELECT * FROM cart WHERE pro_id = :pro_id AND user_id = :user_id');
                    $checkCartPro->bindParam(':pro_id', $row->id, PDO::PARAM_INT);
                    $checkCartPro->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                    $checkCartPro->execute();
                }
                

        }
    ?>

        <div class="col-md-7">

        <form action="" id="form-data" method="post">
            <input name="pro_id" type="hidden" value="<?= $row->id; ?>">
            <input name="pro_name" type="hidden" value="<?= $row->pro_name; ?>">
            <input name="pro_image" type="hidden" value="<?= $row->pro_image; ?>">
            <input name="pro_price" type="hidden" value="<?= $row->purchase_price; ?>">
            <input name="pro_amount" type="hidden" value="1">

            <?php if(isset($_SESSION['auth_user']['id'])){ ?>
            <input name="user_id" type="hidden" value="<?= $_SESSION['auth_user']['id']; ?>">
            <?php } ?>
            <img src="../AdminLte/includes/productImage/<?= $row->pro_image ?>" alt=""  style="width: 70%; margin-left: 100px; height: 100%;">
            
        </div>
        <div class="col-md-4">
           
                <a class="btn btn-primary text-right"  href="../index.php"><i class="fas fa-arrow-left"></i></a>

                    <h5 class="card-title text-uppercase my-4" style="font-family: cursive;"><?= $row->pro_name ?></h5>
                    <span class=" text-uppercase lead">Price: &#8358; <?= $row->purchase_price ?></span>

                    <p class="card-text mt-5" style="font-family: cursive;">
                        <?= $row->pro_desc ?>
                    </p>
                    <?php if(!isset($_SESSION['auth_user']['username'])) : ?> 
        
                        <h3 class="lead"><a href="login.php" class="text-decoration-none text-danger">Login or Register to shop</a></h3>
                
                        <?php else: ?>
                    
                <?php if(isset($_SESSION['auth_user']['id'])): ?>
                
                    <?php if($checkCartPro->rowCount() > 0): ?>
                        <button class="btn btn-primary" id="submit" disabled name="submit" type="submit">  <i class="fa fa-shopping-cart"></i> Added to cart</button>
               
                    <?php else: ?>
                        <?php if(!isset($_SESSION['auth_user']['id'])): ?>
                        <h3 class="lead text-danger"><a href="login.php" class="text-decoration-none">Please Register or Login to shop</a></h3>
                    <?php endif; ?>
                        <button class="btn btn-primary" id="submit" name="submit" type="submit">  <i class="fa fa-shopping-cart"></i> Add to cart</button>
                    <?php endif; ?>
                <?php endif; ?>
                <?php endif; ?>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
       
        <?php }else{
            echo "No Product found!";
        } ?>

    </div>
</div>

<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pro_id     =   $_POST['pro_id'];
        $pro_name   =   $_POST['pro_name'];
        $pro_image  =   $_POST['pro_image'];
        $pro_price  =   $_POST['pro_price'];
        $pro_amount =   $_POST['pro_amount'];
        $user_id    =   $_SESSION['auth_user']['id'];

        $insertQuery = $db->prepare('INSERT INTO cart(pro_id, pro_name, pro_image, pro_price,
        pro_amount, user_id) VALUES(:pid, :pname, :pimage, :pprice, :pamount,  :uid)');

        $insertQuery->bindParam(':pid', $pro_id, PDO::PARAM_INT);
        $insertQuery->bindParam(':pname', $pro_name, PDO::PARAM_STR);
        $insertQuery->bindParam(':pimage', $pro_image, PDO::PARAM_STR);
        $insertQuery->bindParam(':pprice', $pro_price, PDO::PARAM_INT);
        $insertQuery->bindParam(':pamount', $pro_amount, PDO::PARAM_INT);
        $insertQuery->bindParam(':uid', $user_id, PDO::PARAM_INT);

        $insertQuery->execute();
    }
?>

<script src="jquery/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#form-data').on('submit', function(e){
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                type: "POST",
                url: 'singlepage.php?id=<?= $pro_id ?>',
                data: formData,
                success: function(response){
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success('Items added to cart');

                    $('#submit').html(`<i class="me-1 fa fa-shopping-cart"></i>Item added already`)
                                .prop('disabled', true);

                    setTimeout(function(){
                        window.location.reload();
                    }, 1500);
                },
                error: function(xhr, status, error){
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error('Failed to add items to cart. Please try again');
                }
            });
        });
    });
</script>
  <?php require '../inc/footer.php'; ?>