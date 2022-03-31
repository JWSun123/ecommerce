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
                                            @php $total += ($item->entry->product->price * $item->prod_qty) @endphp
                                            <td>{{ $item->entry->product->name }}</td>
                                            <td>{{ $item->prod_qty }}</td>
                                            <td>${{ $item->entry->product->price }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h6 class="px-2">Total <span class="float-end"> ${{ $total }} </span></h6>
                                <hr>

                                <div class="row checkout-form mt-5">
                                    <h5>Payment</h5>
                                    <div class="col-md-6">
                                        Choose Stored Payment
                                        <select name="storedpayment" class = "form-select storedpayment" id = "storedpayment">
                                            <option value="-1">Add New Payment Method</option>
                                            @foreach ($payments as $payment)
                                            <option value="{{ $payment->id }}">{{ $payment->card_number }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                    Choose Payment Method
                                    <select class="form-select paymentinfo" name = "method" id = "method">
                                        <option selected>Payment Method</option>
                                        <option value="1">Credit Card</option>
                                        <option value="2">Debit Card</option>
                                    </select>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        Name<input type="text" required class="form-control username paymentinfo" name="username" id = "username">
                                        <span id="payment_username_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        Card Number<input type="text" required class="form-control cardnumber paymentinfo" name="cardnumber" id = "cardnumber">
                                        <span id="payment_cardnumber_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        Expiry Date<input type="month" required class="form-control expiry_date paymentinfo" name="expirydate" id = "expirydate">
                                        <span id="payment_expirydate_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        CVV<input type="text" required class="form-control cvv paymentinfo" name="cvv" id="cvv">
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
@endsection

