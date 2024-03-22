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


            <div class="col-12 col-sm-12 col-lg-12">
                <div>
                    <div class="card ">
                        <div class="card-body">
                            {{-- "id" => 23
                            "user_id" => 1
                            "product_id" => 4
                            "quantity" => 6
                            "payment_status" => "cash on delivery"
                            "delivery_status" => "processing"
                            "created_at" => "2024-03-20 18:28:30"
                            "updated_at" => "2024-03-20 18:28:30" --}}
                            {{-- <h2>Order</h2>   --}}
                            @if ($orderItems->isEmpty())
                                <div class="text-center">
                                    <p>Your cart is empty.</p>
                                </div>
                            @else
                                @foreach ($orderItems as $orderItem)
                                    @if (!$loop->first)
                                        <hr />
                                    @endif

                                    <div class="row">

                                        <div class="col-12 col-sm-12 col-md-2 col-lg-2">
                                            <div class="cart_image" style="width: 112px; height: 112px;">
                                                <img src="{{ asset('storage/' . $orderItem->product->image) }}"
                                                    alt="{{ $orderItem->product->name }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-10 col-lg-10">
                                            <h6 class="text-uppercase product_title_overflow mb-0">
                                                {{ $orderItem->product->name }}
                                            </h6>
                                            <p class="text-muted mb-2">
                                                Blast
                                            </p>
                                            <p class="offer_text"> {{ $orderItem->product->discount }}% offers applied <i
                                                    class="fa fa-check-circle" aria-hidden="true"></i></p>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>

                                                    <h5 class="card-title">
                                                        ₹{{ $orderItem->product->price * $orderItem->quantity }}
                                                    </h5>

                                                </div>

                                                <div class="align-self-start">
                                                    @if ($orderItem->delivery_status == 'processing')
                                                        <a href="{{ route('cancel_order.index', $orderItem->id) }}">
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm align-self-center ">Cancel
                                                                Order</button>
                                                        </a>
                                                    @endif

                                                    <button type="button"
                                                        class="btn btn-secondary btn-sm align-self-center ">
                                                        {{ $orderItem->delivery_status }}
                                                    </button>
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
            {{-- @php
                $totalPrice = 0;

                if (!$cartItems->isEmpty()) {
                    $totalPrice = $cartItems->sum(function ($cartItem) {
                        return $cartItem->product->price * $cartItem->quantity;
                    });
                }
            @endphp --}}

        </div>
    </div>
@endsection
