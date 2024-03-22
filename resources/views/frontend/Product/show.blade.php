@extends('frontend.layouts.index')
<style>
    button:focus,
    input:focus {
        outline: none;
        box-shadow: none;
    }


    /*--------------------------*/
    .qty-container {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qty-container .input-qty {
        text-align: center;
        padding: 6px 10px;
        border: 1px solid #d4d4d4;
        max-width: 80px;
        height: 38px;
        margin-bottom: 0 !important;
    }

    .qty-container .qty-btn-minus,
    .qty-container .qty-btn-plus {
        border: 1px solid #d4d4d4;
        padding: 10px 13px;
        font-size: 10px;
        height: 38px;
        width: 38px;
        transition: 0.3s;
    }

    .qty-container .qty-btn-plus {
        margin-left: -1px;
    }

    .qty-container .qty-btn-minus {
        margin-right: -1px;
    }


    /*---------------------------*/
    .btn-cornered,
    .input-cornered {
        border-radius: 4px;
    }

    .btn-rounded {
        border-radius: 50%;
    }

    .input-rounded {
        border-radius: 50px;
    }
</style>
@section('content')
    <div class="container mt-5 mb-5">
        <x-alert />
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $single_product->image) }}" class="card-img-top"
                    alt="{{ $single_product->name }}" style="height: 300px; object-fit: contain;">
            </div>
            <div class="col-md-6">
                <h2>{{ $single_product->name }}</h2>
                <p><strong>Price:</strong> {{ $single_product->price }}</p>
                <p><strong>Description:</strong> {{ $single_product->description }}</p>

                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <div class="col-md-4 mb-3">
                        <div class="qty-container">
                            <button class="qty-btn-minus btn-light" type="button"><i class="fa fa-minus"></i></button>
                            <input type="text" name="quantity" value="1" class="input-qty" />
                            <button class="qty-btn-plus btn-light" type="button"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>


                    <!-- Hidden input field to store product ID -->
                    <input type="hidden" name="productId" value="{{ $single_product->id }}">
                    <button type="submit" name="addToCart" value="1" class="btn btn-danger">Buy Now</button>
                    <button type="submit" name="addToCart" value="1" class="btn btn-secondary">Add To Cart</button>
                </form>
            </div>
        </div>


    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        var buttonPlus = $(".qty-btn-plus");
        var buttonMinus = $(".qty-btn-minus");

        var incrementPlus = buttonPlus.click(function() {
            var $n = $(this)
                .parent(".qty-container")
                .find(".input-qty");
            $n.val(Number($n.val()) + 1);
        });

        var incrementMinus = buttonMinus.click(function() {
            var $n = $(this)
                .parent(".qty-container")
                .find(".input-qty");
            var amount = Number($n.val());
            if (amount > 0) {
                $n.val(amount - 1);
            }
        });
    </script>
@endsection

