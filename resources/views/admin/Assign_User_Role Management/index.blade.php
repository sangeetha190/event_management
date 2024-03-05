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
                            <a href="{{ route('assign_role.create') }}" class="btn btn-primary">Create Assign</a>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Roles</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($users->count())
                                        @foreach ($users as $user)
                                            <tr>
                                                <th scope="row">{{ $user->id }}</th>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if (count($user->roles->pluck('name')->toArray()) > 0)
                                                        {{ implode(',', $user->roles->pluck('name')->toArray()) }}
                                                    @else
                                                        No Role Assigned
                                                    @endif


                                                </td>
                                                <td>
                                                    <a href="{{ url('assign_role/edit/' . $user->id) }}">
                                                        <button class="btn btn-primary">Edit</button>
                                                    </a>

                                                    {{-- <a href="{{ route('assign_role.delete', $user->id) }}"> --}}

                                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"
                                                        data-user-id="{{ $user->id }}">Delete</button>
                                                    {{-- </a> --}}
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
        </div>
    </div>
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
    <script src="https://cdn.lordicon.com/lordicon.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var userId = button.getAttribute('data-user-id');
                var deleteLink = deleteModal.querySelector('#deleteLink');
                var deleteRoute = "{{ route('assign_role.delete', ':userId') }}";
                deleteRoute = deleteRoute.replace(':userId', userId);
                deleteLink.setAttribute('href', deleteRoute);
            });
        });
    </script>
@endsection
