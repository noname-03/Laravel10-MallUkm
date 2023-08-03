@extends('layouts.app')
@section('title', 'Edit Data Pertanyaan')
@section('content')
    @push('styles')
        <!-- Plugins css-->
        <link href="{{ asset('/') }}assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="{{ asset('/') }}assets/css/app.min.css" rel="stylesheet" type="text/css" />
    @endpush

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('question.index') }}">Pertanyaan</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Data Pertanyaan</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Data Pertanyaan</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('question.update', $question->id) }}" method="post">
                        @csrf @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Pertanyaan <span
                                                        class="text-danger">*</span></label>
                                                <textarea class="form-control @error('title') is-invalid @enderror" id="title" rows="3"
                                                    placeholder="e.g : bahwa ini adalah sesuatu yang baik dan benar" name="title">{{ old('title', $question->title) }}</textarea>
                                                @error('title')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control select2" id="status" name="status">
                                                    <option value="1" {{ $question->status == 1 ? 'selected' : '' }}>
                                                        Aktif
                                                    </option>
                                                    <option value="0" {{ $question->status == 0 ? 'selected' : '' }}>
                                                        Nonaktif
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-center mb-3">
                                        <a href="{{ route('question.index') }}"
                                            class="btn w-sm btn-primary waves-effect">Kembali</a>
                                        <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Simpan
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
    <script src="{{ asset('/') }}assets/libs/select2/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
