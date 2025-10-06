$(document).ready(function() {
    // Cart quantity update
    $(".cart-plus-minus").append(
        '<div class="dec qtybutton">-</div><div class="inc qtybutton">+</div>'
    );

    $(".qtybutton").on("click", function () {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        var newVal;

        if ($button.text() == "+") {
            newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 1) {
                newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        $button.parent().find("input").val(newVal);

        // Trigger change event to enable update button
        $button.parent().find("input").trigger('change');
    });

    // Coupon code submission
    $('#coupon_code_btn').on('click', function(e){
        e.preventDefault();
        var couponCode = $('#coupon_code').val();
        if(couponCode) {
            var link = "{{ url('front/cart') }}/" + couponCode;
            window.location.href = link;
        }
    });

    // Show update cart button on quantity change
    $('.product_quantity').on('change', function(){
        $('.purcess_btn').fadeOut(500);
        $('.update_cart').removeClass('btn-disabled');
    });

    // Checkout district dropdown
    $('#division_name').on('change', function() {
        var divisionId = $(this).val();
        if (divisionId) {
            $.ajax({
                url: '/front/getdistrictname',
                type: 'POST',
                data: {
                    id: divisionId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'html',
                success: function(data) {
                    $('#district_name').html(data);
                },
                error: function() {
                    $('#district_name').html('<option value="">-- Could not load districts --</option>');
                }
            });
        } else {
            $('#district_name').html('<option value="">-- Select Division First --</option>');
        }
    });
});