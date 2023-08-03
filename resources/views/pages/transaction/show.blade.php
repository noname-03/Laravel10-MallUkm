@extends('layouts.app')
@section('title', 'Faktur')
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
                            <li class="breadcrumb-item"><a href="{{ route('transaction.index') }}">Transaksi</a></li>
                            <li class="breadcrumb-item active">Faktur</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Faktur</h4>
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
                                <h4 class="m-0 d-print-none">Faktur</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mt-3">
                                    {{-- <p><b>Hello, {{$transaction->user->name}}</b></p> --}}
                                </div>

                            </div><!-- end col -->
                            <div class="col-md-6 offset-md-2">
                                <div class="mt-3 float-end">
                                    <p><strong>Akun Pengirim : </strong> <span class="float-end"> &nbsp;&nbsp;&nbsp;&nbsp;
                                            {{ $transaction->user->name }}</span></p>
                                    <p><strong>Status Pembelian : </strong> <span class="float-end">
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            {{ $transaction->status_payment }}</span></p>
                                    @if ($transaction->status_payment == 'online')
                                        <p><strong>Kurir : </strong> <span class="float-end"> &nbsp;&nbsp;&nbsp;&nbsp;
                                                {{ $transaction->courier }}</span></p>
                                        <p><strong>Nomer Resi : </strong> <span class="float-end"> &nbsp;&nbsp;&nbsp;&nbsp;
                                                {{ $transaction->receipt_number }}</span></p>
                                    @endif
                                    <p><strong>Order Date : </strong> <span class="float-end"> &nbsp;&nbsp;&nbsp;&nbsp;
                                            {{ $transaction->created_at }}</span></p>
                                    <p><strong>Order Status : </strong> <span class="float-end">
                                            @if ($transaction->status === 'paid')
                                                <span class="badge bg-success">Paid</span>
                                            @elseif ($transaction->status === 'unpaid')
                                                <span class="badge bg-info">Unpaid</span>
                                            @else
                                                <span class="badge bg-danger">Canceled</span>
                                            @endif
                                        </span></p>
                                    <p><strong>Order No. : </strong> <span class="float-end">{{ $transaction->order_id }}
                                        </span></p>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row mt-3">
                            <div class="col-sm-6">
                                @if ($transaction->status_payment == 'online')
                                    <h6>Alamat Penerima</h6>
                                    <address>
                                        {{ $transaction->address->username }}<br>
                                        {{ $transaction->address->address }}<br>
                                        {{ $transaction->address->address_detail }}<br>
                                        <abbr title="Phone">Nomer HP:</abbr> {{ $transaction->address->phone }}
                                    </address>
                                @endif
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table mt-4 table-centered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Produk</th>
                                                <th style="width: 10%">Kuantitas</th>
                                                <th>Harga</th>
                                                <th class="text-end">Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $grandTotal = 0;
                                            @endphp
                                            @foreach ($transaction->detailTransaction as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <b>{{ $item->product->title }}</b> <br />
                                                        {{ $item->variant }}
                                                    </td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>@currency($item->price)</td>
                                                    <td class="text-end">@currency($item->subtotal)</td>
                                                </tr>
                                                @php
                                                    $grandTotal += $item->subtotal;
                                                @endphp
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
                                <div class="float-end">
                                    <p><b>Sub-total:</b> <span class="float-end">@currency($grandTotal)</span></p>
                                    <p><b>Biaya Pengiriman :</b> <span class="float-end"> &nbsp;&nbsp;&nbsp;
                                            @currency($transaction->cost_courier)</span></p>
                                    @php
                                        $total = $transaction->cost_courier + $grandTotal;
                                    @endphp
                                    <h3>@currency($total)</h3>
                                </div>
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
