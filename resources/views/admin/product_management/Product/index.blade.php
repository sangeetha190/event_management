@extends('admin.layouts.index')
@section('content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3 fs-6">Product Management</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item fs-6">
                                <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active fs-6" aria-current="page">
                                Create Product
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
                    <div class="card">
                        <div class="card-body">
                            {{-- <a href="{{ url()->previous() }}"class="btn btn-primary">Back</a> --}}

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                @if ($product->image)
                                                    <img src="{{ asset('storage/' . $product->image) }}"
                                                        alt="{{ $product->name }}" width="50px" height="50px"
                                                        style="object-fit: contain">
                                                @else
                                                    <p>No image available</p>
                                                @endif
                                            </td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>
                                                <a href="{{ route('product.edit_page', $product->id) }}">
                                                    <button class="btn btn-primary">Edit</button>
                                                </a>
                                                <button class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal"
                                                    data-category-id="{{ $product->id }}">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Ends For Delete --}}

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
