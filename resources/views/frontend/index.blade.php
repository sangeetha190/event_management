@extends('frontend.layouts.index')
@section('content')

    <!-- slider section -->
    @include('frontend.slider')
    <!-- end slider section -->
    <!-- why section -->
    @include('frontend.why')
    <!-- end why section -->

    <!-- arrival section -->
    @include('frontend.arrival')
    <!-- end arrival section -->

    <!-- product section -->
    @include('frontend.product')
    <!-- end product section -->

    <!-- subscribe section -->
    @include('frontend.subscribe')
    <!-- end subscribe section -->
    <!-- client section -->
    @include('frontend.client')
    <!-- end client section -->
@endsection
