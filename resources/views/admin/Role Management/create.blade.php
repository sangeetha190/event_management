@extends('admin.layouts.index')
@section('content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3 fs-6">User Management</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item fs-6">
                                <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active fs-6" aria-current="page">
                                Create Role
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="">
                            <button type="button" class="btn btn-primary">Back</button>
                        </a>
                        {{-- <button type="button"
                            class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                            <a class="dropdown-item" href="javascript:;">Action</a>
                            <a class="dropdown-item" href="javascript:;">Another action</a>
                            <a class="dropdown-item" href="javascript:;">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:;">Separated link</a>
                        </div> --}}
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <!-- Repeater Html Start -->
            {{-- <div id="repeater">
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
            </div> --}}
            <!-- Repeater End -->

            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <x-message />
                    <div class="card">
                        <div class="card-body p-4">
                            {{-- <h5 class="mb-4">Vertical Form</h5> --}}
                            {{-- <form class="row g-3"> --}}
                            <form class="row g-3" method="POST" action="{{ route('role.store') }}">
                                @csrf
                                <div class="col-md-12">
                                    <label for="input3" class="form-label">Role Name</label>
                                    <input type="text" class="form-control mb-3" name="name" id="input3"
                                        placeholder="Enter the role name" />
                                </div>



                                @if ($permissionGroups->count())
                                    <div class="row">
                                        @foreach ($permissionGroups as $permissionGroup)
                                            <div class="col-md-4">
                                                <h6>{{ $permissionGroup->name }}</h6>

                                                @if ($permissionGroup->permissions->count())
                                                    @foreach ($permissionGroup->permissions as $permission)
                                                        <div class="form-check">
                                                            {{-- <input class="form-check-input" type="checkbox"
                                                            value="{{ $permission->id }}" id="flexCheckChecked"
                                                            name="permission_ids[]">
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            {{ $permission->name }} </label> --}}

                                                            <input value={{ $permission->id }} name="permission_id[]"
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
                                            Create Role
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
