<?php require '../inc/header.php' ?>
<?php require '../inc/alertify.php';
    if(!isset($_SESSION['auth_user']['username'])){
        header('Location: ../index.php');
    }
?>
<style>
    .card img {
    transition: all 0.3s ease-in-out;
    filter: none;
    transform: scale(1);
}

.card img:hover {
    filter: grayscale(100%);
    transform: scale(0.9);
}
</style>

<div class="container">
        <div class="row mt-5 p-2">
        <?php 
        
            $row = $db->query('SELECT * FROM products WHERE stock > 0 ORDER BY RAND()');
            $row->execute();
            $fetch = $row->fetchAll(PDO::FETCH_OBJ);

            foreach($fetch as $rows): 

        ?>
            <div class="col-md-3 p-2">
                <div class="card">
                    <a href="singlepage.php?id=<?= $rows->id ?>" class="text-decoration-none text-dark">
                    <img src="<?= APPURL ?>/AdminLte/includes/productImage/<?= $rows->pro_image; ?>" alt="" class="card-img-top" style="width: 300px; height: 300px; margin: 3px;">

                    <div class="card-body">
                        <h5 class="card-title"><?= $rows->pro_name; ?> <br> <span> &#8358; <?= number_format($rows->sales_price, 2); ?></span></h5>

                        <p class="card-text lead">
                        <?= substr($rows->pro_desc,0, 45); ?>...
                        </p>
                    </div>
                    <button class="btn btn-success btn-block w-100">More <span>-></span></button>
                    </a>
                </div>
            </div>

            <?php endforeach; ?>
            

        </div>
    </div>
      <?php require '../inc/footer.php'; ?>