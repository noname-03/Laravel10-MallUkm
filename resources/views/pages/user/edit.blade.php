@extends('layouts.app')
@section('title', 'Edit Data User')
@section('content')
@push('styles')

<!-- Plugins css-->
<link href="{{asset('/')}}assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

<!-- App css -->
<link href="{{asset('/')}}assets/css/app.min.css" rel="stylesheet" type="text/css" />
@endpush

<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('user.index')}}">User</a></li>
                        <li class="breadcrumb-item active">Edit Data User</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Data User</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{route('user.update', $user->id)}}" method="post">
                    @csrf @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama </label>
                                            <input type="text" id="name" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="e.g : Alex" value="{{old('name', $user->name)}}">
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email </label>
                                            <input type="text" id="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="e.g : alex@mail.com"
                                                value="{{old('email', $user->email)}}">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password </label>
                                            <input type="password" id="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="e.g : Kosongkan Jika Tidak Ingin Diganti"
                                                value="{{old('password')}}">
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control select2" id="role" name="role">
                                                <option value="admin" {{$user->role === 'admin' ? 'selected' :
                                                    ''}}>Admin</option>
                                                <option value="buyer" {{$user->role === 'buyer' ? 'selected' :
                                                    ''}}>Buyer</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center mb-3">
                                    <button type="button" class="btn w-sm btn-info waves-effect">Cancel</button>
                                    <button type="submit"
                                        class="btn w-sm btn-success waves-effect waves-light">Perbarui</button>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                </form>
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
    <!-- end row -->

</div> <!-- container -->

@endsection
@push('scripts')


<!-- Select2 js-->
<script src="{{asset('/')}}assets/libs/select2/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
    $('.select2').select2();
});
</script>
@endpush