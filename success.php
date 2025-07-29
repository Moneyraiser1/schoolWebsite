
<?php
include 'inc/header.php';

if (!isset($_SESSION['auth_user']['username'])) {
    header('Location: login.php');
    exit(); // Always add exit after header redirects
}


$userId = $_SESSION['auth_user']['id'];

// Corrected: bind the actual email from session
$fetch = $db->prepare("SELECT * FROM paystack_payment WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 1");
$fetch->bindParam(':user_id', $userId, PDO::PARAM_STR);
$fetch->execute();
$fetchData = $fetch->fetch(PDO::FETCH_ASSOC);
?>


<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="spinner-border text-primary"></div>
            <div class="col-md-12 p-5">
                <h6 class="text-light display-1 lead">PURCHASE SUCCESSFUL</h6>
            </div>

            <?php if ($fetchData): ?>
                <div class="text-light display-6 text-center">
                    Username: <?= $_SESSION['auth_user']['username'] ?> <br>
                    Email: <?= htmlspecialchars(string: $fetchData['email'])  ?> <br>
                    Address: <?= htmlspecialchars(string: $fetchData["address"]) ?> <br>
                    Product bought: <?= htmlspecialchars(string: $fetchData["product"]) ?> <br>
                    Date Purchased: <?= htmlspecialchars($fetchData['created_at']) ?>
                </div>
            <?php else: ?>
                <div class="text-light display-6 text-center">
                    <p>We couldn't retrieve your payment details. Please contact support.</p>
                </div>
            <?php endif; ?>

            <a href="index.php" style="width: 200px;" class="m-5 btn btn-success w-10 text-light display-6 text-decoration-none">Back to home page</a>
        </div>
    </div>
</body>
  <?php require 'inc/footer.php'; ?>