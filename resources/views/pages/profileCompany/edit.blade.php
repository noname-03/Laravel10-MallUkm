@extends('layouts.app')
@section('title', 'Edit Data Profil Perusahaan')
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
                        <li class="breadcrumb-item"><a href="{{route('profileCompany.index')}}">Profil Perusahaan</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Data Profil Perusahaan</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Data Profil Perusahaan</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{route('profileCompany.update', $profileCompany->id)}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="latitude" class="form-label">Latitude <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="latitude" name="latitude"
                                                class="form-control @error('latitude') is-invalid @enderror"
                                                placeholder="e.g : 6282311223344"
                                                value="{{old('latitude', $profileCompany->latitude)}}">
                                            @error('latitude')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="longitude" class="form-label">Longitude
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" id="longitude" name="longitude"
                                                class="form-control @error('longitude') is-invalid @enderror"
                                                placeholder="e.g : 6282311223344"
                                                value="{{old('longitude', $profileCompany->longitude)}}">
                                            @error('longitude')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">phone <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" id="phone" name="phone"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="e.g : 6282311223344"
                                                value="{{old('phone', $profileCompany->phone)}}">
                                            @error('phone')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="terms" class="form-label">Syarat <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control @error('terms') is-invalid @enderror"
                                                id="terms" rows="3"
                                                placeholder="e.g : bahwa ini adalah sesuatu yang baik dan benar"
                                                name="terms">{{old('terms', $profileCompany->terms)}}</textarea>
                                            @error('terms')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="conditions" class="form-label">Ketentuan <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control @error('conditions') is-invalid @enderror id="
                                                conditions" rows="3"
                                                placeholder="e.g : bahwa ini adalah sesuatu yang baik dan benar"
                                                name="conditions">{{old('conditions', $profileCompany->conditions)}}</textarea>
                                            @error('conditions')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center mb-3">
                                    <a href="{{route('profileCompany.index')}}"
                                        class="btn w-sm btn-danger waves-effect">Kembali</a>
                                    <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Perbarui
                                        Data</button>
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
