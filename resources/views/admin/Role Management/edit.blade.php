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
                            <h5 class="mb-0">Edit Role</h5>
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
                            <a href="{{ route('role.index') }}" class="btn btn-primary">Role List</a>
                            <form method="POST" action="{{ route('role.update', $role->id) }}">
                                @csrf
                                {{-- <div class="mb-3">
                                    <label for="exampleInputName" class="form-label">Role Name</label>
                                    <input type="text" class="form-control" id="exampleInputName"
                                        aria-describedby="emailHelp" name="name" value="{{ $role->name }}">
                                </div> --}}
                                <div class="col-md-12">
                                    <label for="input3" class="form-label">Role Name</label>
                                    <input type="text" class="form-control mb-3" name="name" id="input3"
                                        placeholder="Enter the role name" value="{{ $role->name }}" />
                                </div>
                                @if ($permissionGroups->count())
                                    <div class="row">
                                        @foreach ($permissionGroups as $permissionGroup)
                                            <div class="col-md-4">
                                                <h6>{{ $permissionGroup->name }}</h6>

                                                @if ($permissionGroup->permissions->count())
                                                    @foreach ($permissionGroup->permissions as $permission)
                                                        <div class="form-check">
                                                            <input @if (in_array($permission->id, $role->permissions->pluck('id')->toArray())) checked @endif
                                                                value={{ $permission->id }} name="permission_id[]"
                                                                class="form-check-input" type="checkbox"
                                                                id="flexCheckDefault">
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                {{ $permission->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-primary px-4">
                                            Update Role
                                        </button>
                                        <button type="button" class="btn btn-light px-4">
                                            Reset
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end page wrapper -->
@endsection
