
<script src="../jquery/jquery.min.js"></script>
$(document).ready( function () {

    $(".pro_amount").mouseup(function (){

    
    var el = $(this).closest('tr');
    var pro_amount = parseFloat(el.find(".pro_amount").val());
    var pro_price = parseFloat(el.find(".pro_price").text().replace(/[^\d.-]/g, ''));

    if (!isNaN(pro_amount) && !isNaN(pro_price)) {
        var total = pro_amount * pro_price;
        el.find(".total_price").html('&#8358;' + total.toFixed(2));
    } else {
        el.find(".total_price").html('&#8358;0.00');
    }

    updateTotalPrice();


    $(".btn-update").on("click", function(e) {
    var id = $(this).data("id"); 
    var pro_amount = $(this).closest("tr").find(".pro_amount").val();

        $.ajax({
            type: "POST",
            url: "update-item.php",
            data: {
                update: "update",
                id: id,
                pro_amount: pro_amount
            },
        success: function() {
            location.reload();
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: " + error);
        }
    });
});

$(document).on("click", ".delete-btn", function(e) {
    e.preventDefault();

    var id = $(this).data('id');

    if (!id) {
        alert("Invalid ID!");
        return;
    }

    if (confirm("Are you sure you want to delete this item?")) {
        $.ajax({
            type: "POST",
            url: "delete-item.php",
            data: { delete: "delete", id: id },
            dataType: "json", 
            success: function(response) {
                console.log("Server Response:", response);
                if (response.success) {
                    alert(response.message);
                    location.reload();
                } else {
                    alert("Delete failed: " + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
                alert("Delete request failed.");
            }
        });
    }
});

    function reload(){
        $('body').load("cart.php");
    }

    });

    updateTotalPrice();

});

function updateTotalPrice() {
    var sum = 0;
    $('.total_price').each(function () {
        var price = parseFloat($(this).text().replace(/[^\d.-]/g, ''));
        if (!isNaN(price)) {
            sum += price;
        }
    });
    $(".full_price").html('&#8358;' + sum.toFixed(2));
    $(".full_price").val(sum.toFixed(2));
}


