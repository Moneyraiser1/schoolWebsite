<?php

$host = 'localhost';
$db = 'flcs';
$user = 'root';
$pass = ''; // or your DB password

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// 2. Get the student ID from the URL
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $id = $_GET['edit'];

    // 3. Prepare and execute the SQL query
    $sql = "SELECT * FROM students WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $student = mysqli_fetch_assoc($result);

    if (!$student) {
        echo "<div class='alert alert-danger'>Student not found.</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-warning'>No student selected.</div>";
    exit;
}