$(document).ready(function () {
    $('#btn-place-order').click(function (event) {
        event.preventDefault();

        var name_of_food = $("#name_of_food").val();
        var number_of_units = $("#number_of_units").val();
        var unit_price = $("#unit_price").val();
        var order_status = $("#status").val();

        $.ajax({
            url: "http://localhost/IAP_LABS/labs/api/v1/orders/index.php",
            type: "post",
            data: {
                name_of_food,
                number_of_units,
                unit_price,
                order_status
            },
            headers: {
                'Authorization': "Basic Ef1PhBDSaoCaYe1o0I7la5umm028iVathvEAFLKa04I8MM12bOJXm982mBbpL4Ah    ",

            },
            success: function (data) {
                alert(JSON.parse(data)['message']);
            },
            error: function () {
                alert("An error occurred");
            }
        })
    })

    $('#btn-check-order').click(function (event) {
        event.preventDefault();
        var order_id = $('#order_id').val()
        $.ajax({
            url: "http://localhost/IAP_LABS/labs/api/v1/orders/index.php",
            type: "post",
            data: {
                order_id,
                check_order: true
            },
            headers: {
                'Authorization': "Basic Ef1PhBDSaoCaYe1o0I7la5umm028iVathvEAFLKa04I8MM12bOJXm982mBbpL4Ah    ",

            },
            success: function (data) {
                alert(JSON.parse(data)['message']);
            },
            error: function () {
                alert("An error occurred");
            }
        })
    })
})