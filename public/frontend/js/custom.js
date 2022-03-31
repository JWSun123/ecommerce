 $(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.addToCartBtn').click(function (e) {
        e.preventDefault();

        var entry_id = $(this).closest('.product_data').find('.prod_id').val();
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
                'entry_id': entry_id,
                'product_qty' : product_qty,
            },
            success: function (response) {
                swal(response.status);
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

        var entry_id = $(this).closest('.product_data').find('.prod_id').val();
        $.ajax({
            method: "POST",
            url: "delete-cart-item",
            data: {
                'entry_id':entry_id,
            },
            success: function (response) {
                loadcart();
                $('.cartitems').load(location.href + " .cartitems");
                swal("", response.status, "success");
            }
        });
    });

    $(document).on('click','.changeQuantity', function (e) {
        e.preventDefault();

        var entry_id = $(this).closest('.product_data').find('.prod_id').val();
        var prod_qty = $(this).closest('.product_data').find('.qty-input').val();
        data = {
            'entry_id' : entry_id,
            'prod_qty' : prod_qty,
        }
        $.ajax({
            method: "POST",
            url: "update-cart",
            data: data,
            success: function (response) {
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
        if (payment_id <= 0){
            $('.paymentinfo').prop('disabled', false);
        }
        else
        {$.ajax({
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
        })}
    })
    $('#select-size').on('change', function(e){
        var product_id = $(this).find(":selected").data('prod');
        var size_id = $(this).find(":selected").data('size');
        $('#select-color .color').remove();
        $('#select-color').prop('disabled', false);
        $.ajax({
            method:"POST",
            url:"select-size",
            data:{
                'product_id': product_id,
                'size_id': size_id,
            },
            success:function(response){
                $.each(response.entries_color, function(index, item){
                    let newOption = $('<option class = "color"></option>')
                    newOption.val(item.color_id)
                    newOption.text(item.color)
                    $('#select-color').append(newOption)
                })
            }
        })
    })

    $("#select-color").on('change', function(e){
        var product_id = $('#select-size').find(":selected").data('prod');
        var size_id = $('#select-size').find(":selected").data('size');
        var color_id = $(this).val();
        $('#select-size .size').remove();
        $.ajax({
            method:"POST",
            url:"get-quantity",
            data:{
                'product_id': product_id,
                'size_id': size_id,
                'color_id':color_id,
            },
            success:function(response){
                console.log(response.entry.quantity);
                $('#get_quantity').val(response.entry.quantity);
                $('#quantity_instock').text(response.entry.quantity+" in stock")
                if(response.entry.quantity>0){
                    $('#quantity_instock').show();
                    $('#out_of_stock').css('display','none');

                }else if(response.entry.quantity==0){
                    $('#out_of_stock').show();
                    $('#quantity_instock').css('display','none');
                }
                $('#prod_id').val(response.entry.id);
            }
        })
    })
});
