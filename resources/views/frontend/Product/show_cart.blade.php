@extends('frontend.layouts.index')
<style>
    .cart_image {
        position: relative;
        width: 112px;
        height: 112px;
        margin: auto;
        /* background: red; */
    }

    .cart_image img {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        top: 0;
        margin: auto;
        opacity: 1;
        max-width: 100%;
        max-height: 100%;
    }

    .product_title_overflow {
        display: block;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        height: 20px;
    }

    .offer_text {
        font-weight: 600;
        color: green;
    }

    .text-decoration-line-through {
        text-decoration: line-through
    }
</style>
@section('content')
    <div class="container mt-5 mb-5">
        <x-alert />
        <div class="row">

            <div class="col-12 col-sm-12 col-lg-9">
                <div>
                    <div class="card ">
                        <div class="card-body">

                            @if ($cartItems->isEmpty())
                                <div class="text-center">
                                    <p>Your cart is empty.</p>
                                </div>
                            @else
                                @foreach ($cartItems as $cartItem)
                                    @if (!$loop->first)
                                        <hr />
                                    @endif

                                    <div class="row">

                                        <div class="col-12 col-sm-12 col-md-2 col-lg-2">
                                            <div class="cart_image" style="width: 112px; height: 112px;">
                                                <img src="{{ asset('storage/' . $cartItem->product->image) }}"
                                                    alt="{{ $cartItem->product->name }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-10 col-lg-10">
                                            <h6 class="text-uppercase product_title_overflow mb-0">
                                                {{ $cartItem->product->name }}
                                            </h6>
                                            <p class="text-muted mb-2">
                                                Blast
                                            </p>
                                            <p class="offer_text"> {{ $cartItem->product->discount }}% offers applied <i
                                                    class="fa fa-check-circle" aria-hidden="true"></i></p>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <h5 class="card-title">
                                                        ₹{{ $cartItem->product->price * $cartItem->quantity }}</h5>
                                                </div>
                                                <h5>{{ $cartItem->quantity }}</h5>
                                                <div class="align-self-start">
                                                    <a href="{{ route('show_cart.remove', $cartItem->id) }}">
                                                        <button type="button"
                                                            class="btn btn-secondary btn-sm align-self-center ">Remove</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif



                        </div>
                    </div>
                </div>

            </div>
            {{-- Calculate and display total price for all items --}}
            @php
                $totalPrice = 0;

                if (!$cartItems->isEmpty()) {
                    $totalPrice = $cartItems->sum(function ($cartItem) {
                        return $cartItem->product->price * $cartItem->quantity;
                    });
                }
            @endphp
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="text-muted">PRICE DETAILS</h6>
                        <hr />

                        <div class="d-flex align-items-center justify-content-between">
                            <p>Price (1 item)</p>
                            {{-- Display total price --}}
                            <p>₹{{ $totalPrice }}</p>


                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="">Discount</p>
                            <p class=" "><span class="offer_text">₹40</span></p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0">Delivery Charges</p>
                            <p class="mb-0 "> <span class="text-decoration-line-through">₹40</span> <span
                                    class="offer_text">Free</span></p>
                        </div>

                        <hr />
                        <div class="d-flex align-items-center justify-content-between ">
                            <h6 class="card-title mb-0">Total Amount</h6>
                            <h6 class="card-title mb-0">₹{{ $totalPrice }}</h6>
                        </div>


                    </div>
                </div>
                {{-- <button type="button" class="btn btn-danger">Danger</button> --}}
                {{-- <button type="button" class="btn btn-warning btn-block mt-3">Place Order</button> --}}
                <a href="{{ route('cash_on_delivery') }}">
                    <button type="button" class="btn btn-danger btn-block mt-3">Cash On Delivery</button>
                </a>
                <a href="{{ route('stripe', $totalPrice) }}">
                    <button type="button" class="btn btn-danger btn-block mt-3">Online payment</button>
                </a>
            </div>
        </div>
    </div>
@endsection
