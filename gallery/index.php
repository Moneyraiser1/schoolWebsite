<?php require '../inc/header.php' ?>

<style>
    .card-img img {
    transition: all 0.3s ease-in-out;
    filter: none;
    transform: scale(1);
}

.card-img img:hover {
    filter: grayscale(100%);
    transform: scale(0.9);
}
</style>

<div class="container">
        <div class="row mt-5 p-2">

        <?php 
            $row = $db->query('SELECT * FROM gallery ORDER BY RAND()');
            $row->execute();
            $fetch = $row->fetchAll(PDO::FETCH_OBJ);

            foreach($fetch as $rows): 

        ?>
            <div class="col-md-4 p-2">
                <div class="card-img">
                    
                    <img src="<?= APPURL ?>/AdminLte/includes/GalleryImage/<?= htmlspecialchars($rows->gallery) ?>" 
                        alt="Image" class="card-img-top" style="width: 300px; height: 200px;">
                        <div class="card-footer">
                            <?= htmlspecialchars($rows->title) ?>
                        </div>
              </div>
            </div>

            <?php endforeach; ?>
            

        </div>
    </div>
  <?php require '../inc/footer.php'; ?>