<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['address']) && !empty($_POST['products'])) {
        $_SESSION['address'] = $_POST['address'];
        $_SESSION['products'] = $_POST['products'];
        echo "success";
    } else {
        echo "missing_data";
    }
} else {
    echo "invalid_request";
}
