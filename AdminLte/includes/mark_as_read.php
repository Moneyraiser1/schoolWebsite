
<?php
require_once 'AdminController/AdminUserController.php';

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $controller = new AdminUserController();
    $controller->markAsRead($id);

    echo "success";
} else {
    echo "error";
}
?>

