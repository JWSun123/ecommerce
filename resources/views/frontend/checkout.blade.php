@extends('layouts.front')

@section('title')
    Checkout
@endsection

@section('content')

    <div class="py-3 mb-4 shadow-sm border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">
                    Home
                </a> /
                <a href="{{ url('checkout') }}">
                    Checkout
                </a>
            </h6>
        </div>
    </div>

    <div class="container mt-3">
        <form action="{{ url('place-order') }}" method="POST">
            {{ csrf_field() }}
            <div class="row">

                <div class="col-md-7 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Contact Information</h6>
                            <hr>
                            <div class="col-md-6 mt-3">
                                <label for="">Email</label>
                                <input type="text" required class="form-control email" value="{{ Auth::user()->email }}" name="email" placeholder="Enter Email">
                                <span id="email_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6>Shipping Address</h6>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <input type="text" required class="form-control name" value="{{ Auth::user()->name }}" name="name" placeholder="Name">
                                    <span id="name_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" required class="form-control phone" value="{{ Auth::user()->phone }}" name="phone" placeholder="Phone">
                                    <span id="phone_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <input type="text" required class="form-control address" value="{{ Auth::user()->address }}" name="address" placeholder="Address">
                                    <span id="address_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <input type="text" class="form-control apartment" value="{{ Auth::user()->apartment_error }}" name="apartment" placeholder="Apartment, suit, etc.(optional)">
                                    <span id="apartment_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <input type="text" required class="form-control city" value="{{ Auth::user()->city }}" name="city" placeholder="City">
                                    <span id="city_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <select name="province" id="province" class = "form-select province" value="{{ Auth::user()->province }}" required>
                                        <option value="">Select Province</option>
                                        <option value="Alberta">Alberta</option>
                                        <option value="British Columbia">British Columbia</option>
                                        <option value="Manitoba">Manitoba</option>
                                        <option value="New Brunswick">New Brunswick</option>
                                        <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
                                        <option value="Northwest Territories">Northwest Territories</option>
                                        <option value="Nova Scotia">Nova Scotia</option>
                                        <option value="Nunavut">Nunavut</option>
                                        <option value="Prince Edward Island">Prince Edward Island</option>
                                        <option value="Quebec">Quebec</option>
                                        <option value="Saskatchewan">Saskatchewan</option>
                                        <option value="Yukon">Yukon</option>
                                    </select>
                                    <span id="province_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <select name="country" id="country" class = "form-select country" value="{{ Auth::user()->country }}" required>
                                        <option value="">Select Country</option>
                                        <option value="Canada">Canada</option>
                                    </select>
                                    <span id="country_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <input type="text" required class="form-control postalcode" value="{{ Auth::user()->postalcode }}" name="postalcode" placeholder="Postal Code">
                                    <span id="postalcode" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Order Details</h6>
                            <hr>
                            @php $total = 0; @endphp
                            @if($cartItems->count() > 0)
                                <table class="table table-bordered table-hover">
                                    <thead class = "table-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartItems as $item)
                                        <tr>
                                            @php $total += ($item->products->price * $item->prod_qty) @endphp
                                            <td>{{ $item->products->name }}</td>
                                            <td>{{ $item->prod_qty }}</td>
                                            <td>${{ $item->products->price }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h6 class="px-2">Total <span class="float-end"> ${{ $total }} </span></h6>
                                <hr>

                                <div class="row checkout-form">
                                    <h5>Payment</h5>
                                    <div class="col-md-6 mt-3">
                                        Choose Stored Payment
                                        <select name="storedpayment" id="storedpayment" class = "form-select storedpayment">
                                            <option value="">Add New Payment Method</option>
                                            @foreach ($payments as $payment)
                                            <option value="{{ $payment->id }}">{{ $payment->card_number }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                    Choose Payment Method
                                    <select class="form-select" name = "method">
                                        <option selected>Payment Method</option>
                                        <option value="1">Credit Card</option>
                                        <option value="2">Debit Card</option>
                                    </select>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        Name<input type="text" required class="form-control username" name="username">
                                        <span id="payment_username_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        Card Number<input type="text" required class="form-control cardnumber" name="cardnumber">
                                        <span id="payment_cardnumber_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        Expiry Date<input type="month" required class="form-control expiry_date" name="expirydate">
                                        <span id="payment_expirydate_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        CVV<input type="text" required class="form-control cvv" name="cvv">
                                        <span id="payment_cvv_error" class="text-danger"></span>
                                    </div>
                                </div>


                                <hr>
                                <div class = "text-center">
                                <button class="btn btn-warning w-100">Place Order</button>
                                </div>
                            @else
                                <h4 class="text-center">No products in cart</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script src='https://www.paypal.com/sdk/js?client-id=AZs2Jlax_z6GXz7Xo8iCfBF2PwwbatjT0fG0M--HtqzLpL8UZfLx_zbIB8SupDvz_kH98zh5OwL6QV94'> </script>

    <script>
        paypal.Buttons({
            onClick: function(data, actions) {
                if($.trim($('.name').val()).length == 0){
                    error_name = 'Please enter Name';
                    $('#name_error').text(error_name);
                }else{
                    error_name = '';
                    $('#name_error').text(error_name);
                }

                if($.trim($('.email').val()).length == 0){
                    error_email = 'Enter email address';
                    $('#email_error').text(error_email);
                }else{
                    error_email = '';
                    $('#email_error').text(error_email);
                }

                if($.trim($('.phone').val()).length == 0){
                    error_phone = 'Please enter a valid phone number';
                    $('#phone_error').text(error_phone);
                }else{
                    error_phone = '';
                    $('#phone_error').text(error_phone);
                }

                if($.trim($('.address').val()).length == 0){
                    error_address = 'Please enter address';
                    $('#address_error').text(error_address);
                }else{
                    error_address = '';
                    $('#address_error').text(error_address);
                }
                if($.trim($('.country').val()).length == 0){
                    error_country = 'Please enter your country';
                    $('#country_error').text(error_country);
                }else{
                    error_country = '';
                    $('#country_error').text(error_country);
                }

                if($.trim($('.province').val()).length == 0){
                    error_province = 'Please enter province';
                    $('#province_error').text(error_province);
                }else{
                    error_province = '';
                    $('#province_error').text(error_province);
                }
                if($.trim($('.city').val()).length == 0){
                    error_city = 'Please enter city';
                    $('#city_error').text(error_city);
                }else{
                    error_city = '';
                    $('#city_error').text(error_city);
                }

                if($.trim($('.postalcode').val()).length == 0){
                    error_postalcode = 'Please enter postalcode';
                    $('#postalcode_error').text(error_postalcode);
                }else{
                    error_postalcode = '';
                    $('#postalcode_error').text(error_postalcode);
                }
                if(error_name != ''|| error_phone != '' || error_address != ''
                || error_apartment != '' || error_email != ''
                || error_country != '' || error_province != ''
                || error_city != '' || error_postalcode != '')
                {
                    swal("Information is required!");
                    return false;
                }
                else
                {
                    return true;
                }
            },
            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                purchase_units: [{
                    amount: {
                    value: '{{ $total }}'
                    }
                }]
                });
            },
            onApprove: function(data, actions) {
                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {
                // This function shows a transaction success message to your buyer.
                    var name = $('.name').val();
                    var email = $('.email').val();
                    var phone = $('.phone').val();
                    var address = $('.address').val();
                    var apartment = $('.apartment').val();
                    var city = $('.city').val();
                    var province = $('.province').val();
                    var country = $('.country').val();
                    var postalcode = $('.postalcode').val();

                    $.ajax({
                        method: "POST",
                        url: "/place-order",
                        data: {
                            'name':name,
                            'email':email,
                            'phone':phone,
                            'address':address,
                            'apartment':apartment,
                            'city':city,
                            'province':province,
                            'country':country,
                            'postalcode':postalcode,
                            'payment_mode':"Paid by Paypal",
                            'payment_id':details.id,
                        },
                        success: function (response) {
                            swal(response.status)
                            .then((value) => {
                                window.location.href = "/my-orders";
                            });
                        }
                    });
                });
            }
        }).render('#paypal-button-container');
        //This function displays Smart Payment Buttons on your web page.
    </script>

@endsection
