<?php require '../inc/header.php'; ?>
<?php require '../inc/alertify.php';

if (!isset($_SESSION['auth_user']['username'])) {
    require_once '404.php';
}
    if (isset($_SESSION['auth_user']['id'])) {
        $number = $db->prepare("SELECT COUNT(*) as num_products FROM cart WHERE user_id=:id");
        $number->execute([':id' => $_SESSION['auth_user']['id']]);
        $fetchData = $number->fetch(PDO::FETCH_OBJ);
    }

    if (isset($_POST['submit'])) {
        $price = $_POST['price'];
        $_SESSION['price'] = $price;
        header("Location: paystackcheckout.php");
    }
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between">
        <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
        <h5 class="mb-0 text-muted"><?= $fetchData->num_products ?> items</h5>
    </div>
    <div class="row d-flex border rounded p-5">
        <div class="col-md-8">
            <?php 
            $total_price = 0;
            if (isset($_SESSION['auth_user']['id'])) {
                $stmt = $db->prepare("SELECT * FROM cart WHERE user_id = :user_id");
                $stmt->execute([':user_id' => $_SESSION['auth_user']['id']]);
                $allProducts = $stmt->fetchAll(PDO::FETCH_OBJ);
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Update</th>
                        <th>Total Price</th>
                        <th>Clear</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    if (count($allProducts) > 0):
                        foreach ($allProducts as $product): 
                            $i++;    
                            $item_total = $product->pro_price * $product->pro_amount;
                            $total_price += $item_total;
                    ?>
                    <form method="post">
                        <tr>
                            <td><?= $i ?></td>
                            <input type="hidden" name="id" value="<?= $product->id ?>">
                            <td><img src="../AdminLte/includes/productImage/<?= $product->pro_image ?>" class="img-fluid rounded" style="width: 70px; height: 50px;" alt=""></td>
                            <td><?= $product->pro_name ?></td>
                            <td class="pro_price">&#8358;<?= $product->pro_price ?></td>
                            <td>
                                <input class="form-control form-control-sm pro_amount"
                                    type="number" min="1"
                                    style="width: 55px; text-align: center;" 
                                    name="quantity" 
                                    value="<?= $product->pro_amount ?>">
                            </td>
                            <td>
                                <button type="submit" name="update" class="btn btn-success btn-sm mt-1">
                                    <i class="fa fa-check-square"></i>
                                </button>
                            </td>
                            <td class="total_price">&#8358;<?= number_format($item_total, 2) ?></td>
                            <td>
                                <a class="btn btn-danger" href="delete.php?del=<?= $product->id ?>">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td> 
                        </tr>
                    </form>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
            <br>
            <a class="btn btn-success" href="../index.php">
                <i class="fa fa-arrow-left"></i> Continue Shopping
            </a>
        </div>

        <div class="col-md-4">
            <form method="post" action="">
                <div class="card shadow">
                    <div class="card-title p-2">
                        <h3 class="lead fw-bold mt-2 text-muted">Total Price =</h3>
                        <h3 class="display_price">&#8358;<?= number_format($total_price, 2) ?></h3>
                        <input type="hidden" name="price" class="price_input" value="<?= $total_price ?>">
                    </div>
                    <div class="card-body">
                        <button class="btn btn-success" name="submit" type="submit">Checkout</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php } else { ?>
    <div class="alert alert-danger bg-danger text-white">
        <p class="mb-0">There is no product in the cart.</p>
    </div>
    <a class="btn btn-success" href="index.php">
        <i class="fa fa-arrow-left"></i> Continue Shopping
    </a>
<?php } ?>

<?php 
if (isset($_GET['del'])) {
    require_once 'delete.php';
}
if (isset($_POST['update'])) {
    require_once 'update.php';
}
?>

<script src="../jquery/jquery.min.js"></script>
<script>
$(document).ready(function () {
    $(".pro_amount").on("input", function () {
        var el = $(this).closest('tr');
        var pro_amount = parseFloat(el.find(".pro_amount").val());
        var pro_price = parseFloat(el.find(".pro_price").text().replace(/[^\d.-]/g, ''));

        if (!isNaN(pro_amount) && !isNaN(pro_price)) {
            var total = pro_amount * pro_price;
            el.find(".total_price").html('&#8358;' + total.toFixed(2));
        } else {
            el.find(".total_price").html('&#8358;0.00');
        }

        updateTotalPrice();
    });

    updateTotalPrice();
});

function updateTotalPrice() {
    var sum = 0;
    $('.total_price').each(function () {
        var price = parseFloat($(this).text().replace(/[^\d.-]/g, ''));
        if (!isNaN(price)) {
            sum += price;
        }
    });
    $(".display_price").html('&#8358;' + sum.toFixed(2));
    $(".price_input").val(sum.toFixed(2));
}
</script>
  <?php require '../inc/footer.php'; ?>