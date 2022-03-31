@extends('layouts.front')

@section('title')
Ecommerce
@endsection

@section('content')


<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="mb-4">
                <h2 class="center-text">About Us</h2>
                <div>
                    <p class="center-text" id="description">@if(isset($description)){{$description->description}}@endif</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
