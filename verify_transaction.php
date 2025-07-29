<?php


session_start();

// Load config file (contains DB connection and secret key)
require_once 'config/config.php';

// Get and sanitize reference from query string
$ref = $_GET['reference'];
$ref = filter_var($ref, FILTER_SANITIZE_STRING);

// If no reference, redirect safely
if (empty($ref)) {
    header("Location: error.html");
}

// Verify transaction with Paystack
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($ref),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer sk_test_5319a03cc70845cabd046072fe1447cd939c0d03" , // from config.php
        "Cache-Control: no-cache"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

// Handle cURL error
if ($err) {
    echo "❌ Payment verification error: " . htmlspecialchars($err);
    exit();
}

// Decode JSON response
$result = json_decode($response);

// Check if API response is valid
if (!isset($result->data)) {
    echo "❌ Invalid response from Paystack.";
    exit();
}

// Check if user address exists in session
if (!isset($_SESSION['address'])) {
    header("Location: 404.php");
    exit();
}

// If transaction was successful
if ($result->data->status === "success") {
    // Extract customer info
    $status = $result->data->status;
    $reference = $result->data->reference ?? '';
    $fname = $result->data->customer->first_name ?? '';
    $lname = $result->data->customer->last_name ?? '';
    $full_name = trim($fname . ' ' . $lname);
    $cus_email = $result->data->customer->email ?? '';
    $amount = $result->data->amount / 100;
    $address = $_SESSION['address'];
    $phone = $_SESSION['auth_user']['phone'];
    $product = $_SESSION['products'];
    $user_id = $_SESSION['auth_user']['id'];
    date_default_timezone_set('Africa/Lagos');
    $date_time = date("Y-m-d H:i:s");

    try {
        $stmt = $db->prepare("
            INSERT INTO paystack_payment (status, reference, full_name, email, address, product, user_id, amount, phone) 
            VALUES (:st, :rf, :fn, :em, :ad, :pr, :uid, :am, :ph )
        ");
        $stmt->bindParam(":st", $status);
        $stmt->bindParam(":rf", $reference);
        $stmt->bindParam(":fn", $full_name);
        $stmt->bindParam(":em", $cus_email);
        $stmt->bindParam(":ad", $address);
        $stmt->bindParam(":pr", $product);
        $stmt->bindParam(":uid", $user_id);
        $stmt->bindParam(":am", $amount);
        $stmt->bindParam(":ph", $phone);

        if ($stmt->execute()) {
            $userId = $_SESSION['auth_user']['id'];

            $deleteCart = $db->prepare("DELETE FROM cart WHERE user_id = :user_id");
            $deleteCart->execute([':user_id' => $userId]);
            header("Location: success.php");
            exit();
        } else {
            echo "❌ Failed to save transaction. Please try again.";
        }
    } catch (PDOException $e) {
        echo "❌ Database error: " . htmlspecialchars($e->getMessage());
    }
} else {
    header("Location: error.html");
    exit();
}
