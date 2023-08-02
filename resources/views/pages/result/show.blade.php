@extends('layouts.app')
@section('title', 'Detail Hasil')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('result.index') }}">Hasil</a></li>
                            <li class="breadcrumb-item active">Detail Hasil</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Detail Hasil</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Logo & title -->
                        <div class="clearfix">
                            <div class="float-start">
                                <div class="auth-brand">
                                    <div class="logo logo-dark">
                                        <span class="logo-lg">
                                            <img src="assets/images/logo-dark.png" alt="" height="22">
                                        </span>
                                    </div>

                                    <div class="logo logo-light">
                                        <span class="logo-lg">
                                            <img src="assets/images/logo-light.png" alt="" height="22">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="float-end">
                                <h4 class="m-0 d-print-none">Detail Hasil</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mt-3">
                                    <p><b>Saran: </b></p>
                                    <p
                                        style="margin: 0;
                                    text-indent: 2rem;
                                    text-align: justify;">
                                        <b>Hello, {{ $result->suggestion }}</b>
                                    </p>
                                </div>

                            </div><!-- end col -->
                            <div class="col-md-6 offset-md-2">
                                <div class="mt-3 float-end">
                                    <p><strong>Nama : </strong> <span class="float-end"> &nbsp;&nbsp;&nbsp;&nbsp;
                                            {{ $result->user->name }}</span></p>
                                    <p><strong>Tanggal Di Buat : </strong> <span class="float-end"> &nbsp;&nbsp;&nbsp;&nbsp;
                                            {{ $result->created_at }}</span></p>
                                    <p><strong>Tanggal Di Perbarui : </strong> <span class="float-end">
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            {{ $result->updated_at }}</span></p>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table mt-4 table-centered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th style="width: 100%">Pertanyaan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($result->answers as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <b>{{ $item->title }}</b> <br />
                                                        MIS : {{ $item->mis }} <br>
                                                        MSS : {{ $item->mss }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="clearfix pt-1">
                                    {{-- <h6 class="text-muted">Notes:</h6>

                                <small class="text-muted">
                                    All accounts are to be paid within 7 days from receipt of
                                    invoice. To be paid by cheque or credit card or direct payment
                                    online. If account is not paid within 7 days the credits details
                                    supplied as confirmation of work undertaken will be charged the
                                    agreed quoted fee noted above.
                                </small> --}}
                                </div>
                            </div> <!-- end col -->
                            <div class="col-sm-6">

                                <div class="clearfix"></div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="mt-4 mb-1">
                            <div class="text-end d-print-none">
                                <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i
                                        class="mdi mdi-printer me-1"></i> Print</a>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection
