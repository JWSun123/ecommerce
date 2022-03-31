@extends('layouts.front')

@section('title')
@if (@isset($products))
                {{$products[0]->category->name}}
@endif
@endsection

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="mb-3">
                <h2>
                    @if (@isset($products))
                    {{$products[0]->category->name}}
                    @endif
                </h2>
            </div>

            @foreach ($products as $product)

                <div class="col-md-3 mb-5">
                    <a href="{{ url('view-product/'.$product->id) }}">
                    <div class="card zoom">
                        <img class = "product-image" src="{{ asset('assets/uploads/products/'.$product->image) }}" alt="Product image">
                        <div class="card-body">
                            <h5>{{ $product->name }}</h5>
                            <span class="float-start">${{ $product->price }}</span>
                            <span class="float-end">{{ $product->brand }}</span>
                        </div>
                    </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- modal -->
<!-- <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mediumBody">
                    <div> -->
                        <!-- the result to be displayed apply here -->
                    <!-- </div>
                </div>
            </div>
        </div>
    </div> -->
@endsection

@section('scripts')
<!-- <script>
    $(document).on('click', '#mediumButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#mediumModal').modal("show");
                    $('#mediumBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
</script> -->
@endsection
