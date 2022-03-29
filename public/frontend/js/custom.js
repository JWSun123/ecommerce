 $(document).ready(function () {

     //loadcart();
    // loadwishlist();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function loadcart()
    {
        $.ajax({
            method: "GET",
            url: "/load-cart-data",
            success: function (response) {
                $('.cart-count').html('');
                $('.cart-count').html(response.count);
            }
        });
    }

    // function loadwishlist()
    // {
    //     $.ajax({
    //         method: "GET",
    //         url: "/load-wislist-count",
    //         success: function (response) {
    //             $('.wishlist-count').html('');
    //             $('.wishlist-count').html(response.count);
    //         }
    //     });
    // }

    $('.addToCartBtn').click(function (e) {
        e.preventDefault();

        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var product_qty = $(this).closest('.product_data').find('.qty-input').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            data: {
                'product_id': product_id,
                'product_qty' : product_qty,
            },
            success: function (response) {
                swal(response.status);
                // loadcart();
            }
        });
    });

    $(document).on('click','.increment-btn', function (e) {
        e.preventDefault();

        var inc_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if(value < 10)
        {
            value++;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });

    $(document).on('click','.decrement-btn', function (e) {
        e.preventDefault();

        var dec_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if(value > 1)
        {
            value--;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });

    $(document).on('click','.delete-cart-item', function (e) {
        e.preventDefault();

        var prod_id = $(this).closest('.product_data').find('.prod_id').val();
        $.ajax({
            method: "POST",
            url: "delete-cart-item",
            data: {
                'prod_id':prod_id,
            },
            success: function (response) {
                loadcart();
                $('.cartitems').load(location.href + " .cartitems");
                swal("", response.status, "success");
            }
        });
    });

    // $(document).on('click','.remove-wishlist-item', function (e) {
    //     e.preventDefault();
    //     var prod_id = $(this).closest('.product_data').find('.prod_id').val();

    //     $.ajax({
    //         method: "POST",
    //         url: "delete-wishlist-item",
    //         data: {
    //             'prod_id':prod_id,
    //         },
    //         success: function (response) {
    //             loadwishlist();
    //             $('.wishlistitems').load(location.href + " .wishlistitems");
    //             swal("", response.status, "success");
    //         }
    //     });
    // });

    $(document).on('click','.changeQuantity', function (e) {
        e.preventDefault();

        var prod_id = $(this).closest('.product_data').find('.prod_id').val();
        var prod_qty = $(this).closest('.product_data').find('.qty-input').val();
        data = {
            'prod_id' : prod_id,
            'prod_qty' : prod_qty,
        }
        $.ajax({
            method: "POST",
            url: "update-cart",
            data: data,
            success: function (response) {
                //$('.cartitems').load(location.href + " .cartitems");
                window.location.reload();
            }
        });

    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#storedpayment').on('change',function(e){

        var payment_id = $(this).val();

        $.ajax({
            method:"POST",
            url:"show-payment",
            data:{
                'payment_id':payment_id,
            },
            success:function(response){
                $('#method').val(response.payment_method);
                $("#username").val(response.user_name);
                $("#cardnumber").val(response.card_number);
                $("#expirydate").val(response.expiry_date);
                $("#cvv").val(response.cvv);
                $('.paymentinfo').prop('disabled', true);
            }
        })
    })
    $('#select-size').on('change', function(e){
        var entry_id = $(this).find(":selected").data('id');
        $.ajax({
            method:"POST",
            url:"select-size",
            data:{
                'entry_id': entry_id,
            },
            success:function(response){
                $('#select-color').val(response.color_id);
                // $('#select-color').prop('disabled',false);
            }
        })
    })


});
