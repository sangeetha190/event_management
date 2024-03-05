@extends('admin.layouts.index')
@section('content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!-- Repeater Html Start -->
            <div id="repeater">
                <!-- Repeater Heading -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Create Role</h5>
                            <button class="btn btn-primary repeater-add-btn px-4">
                                Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Repeater End -->

            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <x-message />
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ url()->previous() }}"class="btn btn-primary">Back</a>
                            <a href="{{ route('role.create') }}" class="btn btn-primary">Create Role</a>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Role Name</th>
                                        <th scope="col">Permissions</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($roles->count())
                                        @foreach ($roles as $role)
                                            <tr>
                                                <th scope="row">{{ $role->id }}</th>
                                                <td>{{ $role->name }}</td>
                                                {{-- <td>{{ $role->permissions->pluck('name') }}</td> --}}
                                                <td>{{ implode(',', $role->permissions->pluck('name')->toArray()) }}</td>
                                                <td>
                                                    <a href="{{ url('role/edit/' . $role->id) }}">
                                                        <button class="btn btn-primary">Edit</button>
                                                    </a>
                                                    {{-- <a href="{{ route('role.delete', $role->id) }}"></a> --}}
                                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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
                    <a href="{{ route('role.delete', $role->id) }}">
                        <button type="button" class="btn btn-primary mx-2">Yes, delete it!</button></a>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Ends For Delete --}}

    {{-- Modal Starts For Success --}}
    {{-- <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content pb-4">
                <div class="modal-body text-center">
                    <lord-icon src="https://cdn.lordicon.com/lomfljuq.json" trigger="loop" delay="2000"
                        style="width:50px;height:50px">
                    </lord-icon>
                    <h4>Deleted!</h4>
                    <p>Your file has been deleted.</p>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('role.delete', $role->id) }}">
                        <button type="button" class="btn btn-success" onclick="closeBothModals()"
                            aria-label="Close">OK</button>
                    </a>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- Modal Ends For Success --}}

    {{-- <script>
        // function closeBothModals() {
        //     var deleteModal = document.getElementById('deleteModal');
        //     var successModal = document.getElementById('successModal');

        //     if (deleteModal) {
        //         var deleteModalBS = bootstrap.Modal.getInstance(deleteModal);
        //         deleteModalBS.hide();
        //     }

        //     if (successModal) {
        //         var successModalBS = bootstrap.Modal.getInstance(successModal);
        //         successModalBS.hide();
        //     }
        // }
    </script> --}}

    <script src="https://cdn.lordicon.com/lordicon.js"></script>
@endsection
