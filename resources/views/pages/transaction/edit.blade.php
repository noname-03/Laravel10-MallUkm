@extends('layouts.app')
@section('title', 'Edit Transaksi')
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
                        <li class="breadcrumb-item"><a href="{{route('transaction.index')}}">Transaksi</a></li>
                        <li class="breadcrumb-item active">Edit Transaksi</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Transaksi</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{route('transaction.update', $transaction->id)}}" method="post"
                    enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control select2" id="status" name="status">
                                                <option value="paid" {{$transaction->status === 'paid' ? 'selected' :
                                                    ''}}>Paid</option>
                                                <option value="unpaid" {{$transaction->status === 'unpaid' ? 'selected'
                                                    :
                                                    ''}}>Unpaid</option>
                                                <option value="canceled" {{$transaction->status === 'canceled' ?
                                                    'selected'
                                                    :
                                                    ''}}>Canceled</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="receipt_number" class="form-label">Nomer Resi </label>
                                            <input type="text" id="receipt_number" name="receipt_number"
                                                class="form-control @error('receipt_number') is-invalid @enderror"
                                                placeholder="e.g : 222000JNE"
                                                value="{{old('receipt_number', $transaction->receipt_number)}}">
                                            @error('receipt_number')
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