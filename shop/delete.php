
<?php
include_once '../config/config.php';

if(isset($_GET['del'])){
    
    $deleteId = $_GET['del'];

    $delete = $db->prepare("DELETE FROM cart WHERE id=:id");
    $delete->bindParam(':id', $deleteId, PDO::PARAM_INT);
    if ($delete->execute()) {
       header('Location: shoppingCart.php');
    } else {
        echo "Delete Failed";
    }
}
?>