<?php
include 'AdminController/galleryController.php';
$gallery = new GalleryController();

// Handle delete action
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $gallery->deleteImage($id);
    header("Location: adminDashboard.php?gallery");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $img_Title = $_POST['img_Title'];
    $uploadStatus = $gallery->uploadData($_FILES['image'], $img_Title);
}


$images = $gallery->fetchGalleryImages();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gallery</title>
    <style>
        .gallery { display: flex; flex-wrap: wrap; }
        .image-box { margin: 10px; border: 1px solid #ccc; padding: 5px; text-align: center; }
        .image-box img { max-width: 150px; height: auto; display: block; }
    </style>
</head>
<body>
    <h1>Image Gallery</h1>

    <div class="gallery">
        <?php if ($images): ?>
            <?php foreach ($images as $img): ?>
                <div class="image-box">
                    <h3> <?= htmlspecialchars($img->title) ?></h3>
                   <img src="/schoolWebsite/AdminLte/includes/GalleryImage/<?= htmlspecialchars($img->gallery) ?>" alt="Image">

                    <br>
                    <a href="?delete=<?= $img->id ?>" onclick="return confirm('Delete this image?')">Delete</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No images found.</p>
        <?php endif; ?>
    </div>
    <?php if (!empty($uploadStatus)) echo "<p>{$uploadStatus}</p>"; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <label>Select image to upload:</label><br>

            <input type="text" placeholder="Image Title" name="img_Title">
            <input type="file" name="image" accept="image/*" required>
            <button type="submit">Upload</button>
        </form>
        <hr>

</body>
</html>
