@extends('admin.layouts.index')
@section('content')
    <div class="container mt-5 mx-auto my-auto">
        <div class="row justify-content-center align-items-center">
            {{-- <h2>Welcome</h2> --}}
            {{-- test starts --}}
            @hasrole('Admin')
                <h5>Welcome, Admin</h5>
            @else
                <h5>Your not admin</h5>
            @endhasrole
            {{-- test starts --}}





        </div>
        @can('User create')
            <button class="btn btn-info">User Create</button>
        @endcan

        @can('User edit')
            <button class="btn btn-info">User Edit</button>
        @endcan

        @can('User update')
            <button class="btn btn-info">User Update</button>
        @endcan

        @can('User delete')
            <button class="btn btn-info">User Delete</button>
        @endcan

        @can('Customer create')
            <button class="btn btn-info">Customer Create</button>
        @endcan

        @can('Customer edit')
            <button class="btn btn-info">Customer Edit</button>
        @endcan

        @can('Customer update')
            <button class="btn btn-info">Customer Update</button>
        @endcan

        @can('Customer delete')
            <button class="btn btn-info">Customer Delete</button>
        @endcan
    </div>
@endsection
