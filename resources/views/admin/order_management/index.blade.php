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

            {{-- form Starts --}}
            <form action="{{ route('search_data.index') }}" method="GET">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-9 d-flex">
                        <a href="{{ route('order.index') }}">
                            <button class="btn btn-primary mx-1">All Data</button>
                        </a>
                        <input type="text" class="form-control" placeholder="Search For Something" name="search_text" />
                        <button class="btn btn-primary mx-1">Search</button>
                    </div>
                </div>
            </form>




            {{-- form Ends --}}
            <div class="row mt-3">
                <div class="col-xl-12 mx-auto">
                    <x-message />
                    <div class="card">
                        <div class="card-body">
                            {{-- <a href="{{ url()->previous() }}"class="btn btn-primary">Back</a> --}}

                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        {{-- <th scope="col">Name</th> --}}
                                        <th scope="col" style="width:250px">Product Name</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Price</th>
                                        {{-- <th scope="col">Quantity</th> --}}
                                        <th scope="col">Payment Status</th>
                                        <th scope="col">Delivery Status</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">Print PDF</th>
                                        <th scope="col">Mail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($order_data as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            {{-- <td>{{ $order->user->name }}</td> --}}
                                            <td>{{ $order->product->name }}</td>
                                            <td>
                                                @if ($order->product->image)
                                                    <img src="{{ asset('storage/' . $order->product->image) }}"
                                                        alt="{{ $order->product->name }}" width="50px" height="50px"
                                                        style="object-fit: contain">
                                                @else
                                                    <p>No image available</p>
                                                @endif
                                            </td>
                                            <td>{{ $order->product->price }}</td>
                                            {{-- <td>{{ $order->quantity }}</td> --}}
                                            <td>
                                                @if ($order->payment_status == 'cash on delivery')
                                                    <span
                                                        class="badge bg-gradient-quepal text-white shadow-sm w-75">{{ $order->payment_status }}</span>
                                                @elseif ($order->payment_status == 'failed')
                                                    <span class="badge bg-gradient-bloody text-white shadow-sm w-75">Failed
                                                    </span>
                                                @elseif ($order->payment_status == 'paid')
                                                    <span class="badge bg-gradient-blooker text-white shadow-sm w-75">paid
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge bg-gradient-blooker text-white shadow-sm w-75">Pending</span>
                                                @endif
                                                {{-- <span class="badge bg-gradient-bloody text-white shadow-sm w-100">Failed</span> --}}
                                                {{-- <span class="badge bg-gradient-quepal text-white shadow-sm w-50">{{ $order->payment_status }}</span> --}}
                                            </td>
                                            <td>{{ $order->delivery_status }}</td>
                                            <td>
                                                {{-- <a href="{{ route('product.edit_page', $order->id) }}">
                                                    <i class="fadeIn animated bx bx-pencil fs-5"></i>
                                                </a>
                                                <span data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                    data-category-id="{{ $order->id }}"> <i
                                                        class="fadeIn animated bx bx-trash fs-5 text-danger"></i></span>
                                                <i class="fadeIn animated bx bx-show-alt fs-5 text-secondry"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#productModal{{ $order->id }}"></i> --}}
                                                {{-- <i class="lni lni-pencil"></i> --}}
                                                <a href="{{ route('delivered.index', $order->id) }}">
                                                    <button class="btn btn-primary">Delivery</button>

                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('print_pdf.index', $order->id) }}">
                                                    <i class="fadeIn animated bx bx-pencil fs-5"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('send_mail.index', $order->id) }}">
                                                    <button class="btn btn-primary">send
                                                    </button>

                                                </a>
                                            </td>


                                        </tr>
                                        <!-- Bootstrap Modal for Product Details -->
                                        <div class="modal fade" id="productModal{{ $order->id }}" tabindex="-1"
                                            aria-labelledby="productModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content pb-4">
                                                    <div class="modal-body text-center">
                                                        <lord-icon src="https://cdn.lordicon.com/skkahier.json"
                                                            trigger="loop" delay="2000" style="width:50px;height:50px">
                                                        </lord-icon>
                                                        <p>{{ $order->product->name }}</p>
                                                        <p>{{ $order->product->price }}</p>
                                                        <p>{{ $order->quantity }}</p>
                                                        <p>{{ $order->payment_status }}</p>
                                                        <p>{{ $order->delivery_status }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-center">
                                                        <a id="deleteLink" href="">
                                                            <button type="button"
                                                                class="btn btn-primary mx-2 btn-delete">Yes, delete
                                                                it!</button>
                                                        </a>
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- view data Ends --}}
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">No Data Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            {{-- pagination Starts --}}
                            <!-- Pagination links -->
                            <div class="pagination_container">
                                {{ $order_data->links() }}
                            </div>
                            {{-- pagination Ends --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card radius-10">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Recent Orders</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"
                                aria-expanded="false"><i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                            </a>
                            <ul class="dropdown-menu" style="">
                                <li><a class="dropdown-item" href="javascript:;">Action</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 ">
                            <thead class="table-light">
                                <tr>
                                    <th class="align-middle">Product</th>
                                    <th>Photo</th>
                                    <th>Product ID</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Shipping</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>Earphone GL</td>
                                    <td><img src="assets/images/products/02.png" class="product-img-2" alt="product img">
                                    </td>
                                    <td>#8304620</td>
                                    <td><span class="badge bg-gradient-blooker text-white shadow-sm w-100">Pending</span>
                                    </td>
                                    <td>$1500.00</td>
                                    <td>05 Feb 2020</td>
                                    <td>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-gradient-blooker" role="progressbar"
                                                style="width: 60%"></div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>HD Hand Camera</td>
                                    <td><img src="assets/images/products/03.png" class="product-img-2" alt="product img">
                                    </td>
                                    <td>#4736890</td>
                                    <td><span class="badge bg-gradient-bloody text-white shadow-sm w-100">Failed</span>
                                    </td>
                                    <td>$1400.00</td>
                                    <td>06 Feb 2020</td>
                                    <td>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-gradient-bloody" role="progressbar"
                                                style="width: 70%"></div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Clasic Shoes</td>
                                    <td><img src="assets/images/products/04.png" class="product-img-2" alt="product img">
                                    </td>
                                    <td>#8543765</td>
                                    <td><span class="badge bg-gradient-quepal text-white shadow-sm w-100">Paid</span>
                                    </td>
                                    <td>$1200.00</td>
                                    <td>14 Feb 2020</td>
                                    <td>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-gradient-quepal" role="progressbar"
                                                style="width: 100%"></div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Hand Watch</td>
                                    <td><img src="assets/images/products/05.png" class="product-img-2" alt="product img">
                                    </td>
                                    <td>#8506790</td>
                                    <td><span class="badge bg-gradient-bloody text-white shadow-sm w-100">Failed</span>
                                    </td>
                                    <td>$1800.00</td>
                                    <td>21 Feb 2020</td>
                                    <td>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-gradient-bloody" role="progressbar"
                                                style="width: 40%"></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end page wrapper -->

    {{-- Modal Starts For Delete --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content pb-4">
                <div class="modal-body text-center">
                    <lord-icon src="https://cdn.lordicon.com/skkahier.json" trigger="loop" delay="2000"
                        style="width:50px;height:50px">
                    </lord-icon>
                    <h4>Are you Sure?</h4>
                    <p>You won't be able to revert this!</p>
                </div>
                <div class="d-flex justify-content-center">
                    <a id="deleteLink" href="">
                        <button type="button" class="btn btn-primary mx-2 btn-delete">Yes, delete it!</button>
                    </a>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Ends For Delete --}}
    {{-- view data starts --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var categoryId = button.getAttribute('data-category-id');
                var deleteLink = deleteModal.querySelector('#deleteLink');
                var deleteRoute = "{{ route('product.delete', ':categoryId') }}";
                deleteRoute = deleteRoute.replace(':categoryId', categoryId);
                deleteLink.setAttribute('href', deleteRoute);
            });
        });
    </script>
@endsection
