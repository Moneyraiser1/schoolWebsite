
<?php
include 'AdminController/AdminUserController.php';

    $users = new AdminUserController();
    $users->remove($_GET['remove']);