@extends('layouts.app')
@section('title')
    Home
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-primary">
                                    <i class="dripicons-wallet font-24 avatar-title text-primary"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1"><span
                                            data-plugin="counterup">{{ $countTransactionPaid }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Total Transaksi Berhasil</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-success">
                                    <i class="dripicons-basket font-24 avatar-title text-success"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $countTransaction }}</span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate">Total Seluruh Transaksi</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-info">
                                    <i class="dripicons-shopping-bag font-24 avatar-title text-info"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $countProduct }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Produk</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-warning">
                                    <i class="dripicons-user-group font-24 avatar-title text-warning"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $countUser }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Pengguna</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->


        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Transaction History</h4>
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">Nama</th>
                                        <th class="border-top-0">Order Id</th>
                                        <th class="border-top-0">Tanggal</th>
                                        <th class="border-top-0">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $item)
                                        <tr>
                                            <td>
                                                <span class="ms-2">{{ $item->user->name }}</span>
                                            </td>
                                            <td>
                                                <span class="ms-2">{{ $item->order_id }}</span>
                                            </td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                {{-- <span class="badge rounded-pill bg-danger">{{ $item->status }}</span> --}}
                                                @if ($item->status === 'paid')
                                                    <span class="badge rounded-pill bg-success">Paid</span>
                                                @elseif($item->status === 'unpaid')
                                                    <span class="badge rounded-pill bg-info">Unpaid</span>
                                                @elseif($item->status === 'sending')
                                                    <span class="badge rounded-pill bg-warning">Sending</span>
                                                @elseif($item->status === 'delivered')
                                                    <span class="badge rounded-pill bg-primary">Delivered</span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger">Cenceled</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive -->
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col-->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Produk Terbaru</h4>

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">Produk</th>
                                        <th class="border-top-0">Kategori</th>
                                        <th class="border-top-0">Tanggal Ditambahkan</th>
                                        <th class="border-top-0">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                        <tr>
                                            <td>
                                                <span class="ms-2">{{ $item->title }}</span>
                                            </td>
                                            <td>
                                                {{ $item->categoryProduct->title }}
                                            </td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>@currency($item->price)</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div> <!-- end table-responsive -->
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->
@endsection
