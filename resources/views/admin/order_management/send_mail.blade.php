@extends('admin.layouts.index')

@section('content')
    <style>
        .bg-gradient-blooker {
            background: #ffdf40;
            background: -webkit-linear-gradient(45deg, #5a3be8, #1892f6) !important;
            background: linear-gradient(45deg, #5a3be8, #1892f6) !important;
        }

        .bg-gradient-quepal {
            background: #ffdf40;
            background: -webkit-linear-gradient(45deg, #1fae67, #17b7bf) !important;
            background: linear-gradient(45deg, #1fae67, #17b7bf) !important;
        }

        <style>.pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .page-link {
            color: #007bff;
        }

        .page-link:hover {
            color: #0056b3;
            text-decoration: none;
            background-color: transparent;
            border-color: #007bff;
        }

        .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            cursor: not-allowed;
            background-color: #fff;
            border-color: #dee2e6;
        }

        .w-5.h-5 {
            width: 20px;
        }

        .pagination_container nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>

    </style>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3 fs-6">Order Management</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item fs-6">
                                <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active fs-6" aria-current="page">
                                All Orders
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('product.create') }}" class="btn btn-primary">Create Product</a>

                    </div>
                </div>
            </div>
            <!--end breadcrumb-->


            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <x-message />



                    <div class="items" data-index="0">
                        <div class="card">
                            <div class="card-body">

                                <!-- Repeater Content -->
                                <form action="{{ route('send_email.user', $order_data->id) }}" method="POST">
                                    @csrf
                                    {{ $order_data->user->email }}
                                    <div class="item-content">
                                        <div class="mb-3">
                                            <label for="test_0_name" class="form-label">Email Greeting:</label>
                                            <input type="text" class="form-control" id="greeting" placeholder="Name"
                                                name="greeting" value="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email FirstLing</label>
                                            <input type="text" class="form-control" id="firstline" placeholder="Email"
                                                name="firstline" value="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Body:</label>
                                            <input type="text" class="form-control" id="body" placeholder="Email"
                                                name="body" value="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Button Name:</label>
                                            <input type="text" class="form-control" id="button" placeholder="Email"
                                                name="button" value="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email URL:</label>
                                            <input type="text" class="form-control" id="url" placeholder="Email"
                                                name="url" value="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email LastLine:</label>
                                            <input type="text" class="form-control" id="lastline" placeholder="Lastline"
                                                name="lastline" value="">
                                        </div>
                                    </div>
                                    <!-- Repeater Remove Btn -->
                                    <div class="repeater-remove-btn">
                                        <button class="btn btn-primary remove-btn px-4">
                                            Submit
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!--end row-->
    </div>
    </div>
    <!--end page wrapper -->
@endsection
