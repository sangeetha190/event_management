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
                            <form method="POST" action="{{ route('assign_role.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputName" class="form-label">Name</label>
                                    <select class="form-select" aria-label="Default select example" name="user_id">
                                        <option value="">Select User</option>
                                        @if ($users->count() > 0)
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->email }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Select Users</label>
                                    <select multiple class="form-select" aria-label="Default select example"
                                        name="role_id[]">
                                        <option value="">Select Role</option>
                                        @if ($roles->count() > 0)
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Assign Role to User</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
