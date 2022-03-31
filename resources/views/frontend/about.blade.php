@extends('layouts.front')

@section('title')
Ecommerce
@endsection

@section('content')


<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="mb-4">
                <h2>About Us</h2>
                <div>
                    <p id="description">@if(isset($description)){{$description->description}}@endif</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
