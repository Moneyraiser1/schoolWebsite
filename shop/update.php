<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $pro_amount = $_POST['quantity'];

    if (!is_numeric($pro_amount) || !is_numeric($id)) {
        echo "<div class='alert alert-danger'>Invalid input data.</div>";
    } else {
        $stmt = $db->prepare("UPDATE cart SET pro_amount = :pro_amount WHERE id = :id AND user_id = :user_id");
        $stmt->bindParam(':pro_amount', $pro_amount, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $_SESSION['auth_user']['id'], PDO::PARAM_INT);

        $stmt->execute();
        
    }
}