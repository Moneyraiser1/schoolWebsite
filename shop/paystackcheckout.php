<?php  
include '../inc/header.php'; 

$productList = "";
if (isset($_SESSION['auth_user']['id'])) {
    $stmt = $db->prepare("SELECT pro_name, pro_amount FROM cart WHERE user_id = :user_id");
    $stmt->execute([':user_id' => $_SESSION['auth_user']['id']]);
    $products = $stmt->fetchAll(PDO::FETCH_OBJ);
    foreach ($products as $prod) {
        $productList .= $prod->pro_name . " (Qty: " . $prod->pro_amount . "), ";
    }
    $productList = rtrim($productList, ", ");
}
?>

<div class="container">
   <div class="row mt-5 justify-content-center">
        <div class="col-md-8 border rounded">
            <div class="p-2 text-center"><h3>Checkout</h3></div>

            <div class="form-group">
                <form id="paymentForm">
                   <div class="p-2">
                        <label for="username">Username:</label>
                        <div class="input-group">
                            <span class="bg-dark text-light p-2"><i class="fa fa-users"></i></span>
                            <input type="text" id="username" readonly class="form-control" value="<?= $_SESSION['auth_user']['username']; ?>">
                        </div>
                   </div>
                   <div class="p-2">
                        <label for="email">Email:</label>
                        <div class="input-group">
                            <span class="bg-dark text-light p-2"><i class="fa fa-envelope"></i></span>
                            <input type="email" id="email" class="form-control" placeholder="Email" required>
                        </div>
                   </div>
                   <div class="p-2">
                        <label for="Price">Price:</label>
                        <div class="input-group">
                            <span class="bg-dark text-light p-2"><i class="fa fa-money-bill"></i></span>
                            <input type="text" id="Price" readonly class="form-control" value="<?= $_SESSION['price']; ?>">
                        </div>
                   </div>
                   <div class="p-2">
                        <label for="address">Address:</label>
                        <div class="input-group">
                            <textarea name="address" required placeholder="Enter Home address here" id="address" cols="100" rows="5" class="form-control"></textarea>
                        </div>
                   </div>
                   <div class="p-2">
                        <label for="products">Products about to be purchased:</label>
                        <div class="input-group">
                            <textarea readonly name="products" id="products" cols="100" rows="5" class="form-control"><?= $productList ?></textarea>
                        </div>
                    </div>

                    <button type="submit" id="submit" class="btn btn-dark w-100 my-2">Pay with Paystack</button>
                </form>
            </div>
        </div>
   </div>
</div>

<!-- ✅ Scripts -->
<script src="../jquery/jquery.min.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("paymentForm").addEventListener("submit", function (e) {
        e.preventDefault();

        let email = document.getElementById('email').value;
        let amount = parseFloat(document.getElementById('Price').value) * 100;
        let username = document.getElementById('username').value;
        let address = document.getElementById('address').value;
        let products = document.getElementById('products').value;

        if (!email || !address || amount <= 0) {
            alert("Please fill in all required fields.");
            return;
        }

        fetch("store_checkout_data.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `address=${encodeURIComponent(address)}&products=${encodeURIComponent(products)}`
        })
        .then(res => res.text())
        .then(data => {
            if (data === "success") {
                let handler = PaystackPop.setup({
                    key: "Replace with your public live key",
                    email: email,
                    amount: amount,
                    metadata: {
                        custom_fields: [
                            {
                                display_name: "Username",
                                variable_name: "username",
                                value: username
                            },
                            {
                                display_name: "Address",
                                variable_name: "address",
                                value: address
                            }
                        ]
                    },
                    reference: 'VS' + Math.floor(Math.random() * 100000000 + 1),
                    callback: function(response) {
                        alert("Payment Complete! Reference: " + response.reference);
                        window.location = "http://localhost/FLCS/verify_transaction.php?reference=" + response.reference;
                    },
                    onClose: function() {
                        alert('Transaction Cancelled');
                        window.location = "index.php?transaction=cancel";
                    }
                });
                handler.openIframe();
            } else {
                alert("Failed to store address. Please try again.");
            }
        });
    });
});
</script>
