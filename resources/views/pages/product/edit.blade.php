@extends('layouts.app')
@section('title', 'Edit Produk')
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
                        <li class="breadcrumb-item"><a href="{{route('Product.index')}}">Product</a></li>
                        <li class="breadcrumb-item active">Edit Produk</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Produk</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{route('Product.update', $product->id)}}" method="post" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Kategori <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control select2" id="category_id" name="category_id">
                                        @foreach ($category as $item)
                                        <option value="{{$item->id}}" {{$product->category_id ===
                                            $item->id ? 'selected' : ''}}>{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="title" class="form-label">Nama Produk <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="title" name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        placeholder="e.g : Batik" value="{{old('title')}}" required>
                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga <span
                                            class="text-danger">*</span></label>
                                    <input type="number" id="price" name="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        placeholder="e.g : 120000" value="{{old('price')}}" required>
                                    @error('price')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="price_retail" class="form-label">Harga Promo </label>
                                    <input type="number" id="price_retail" name="price_retail"
                                        class="form-control @error('price_retail') is-invalid @enderror"
                                        placeholder="e.g : 150000" value="{{old('price_retail')}}">
                                    @error('price_retail')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="qty" class="form-label">Kuantitas </label>
                                    <input type="number" id="qty" name="qty"
                                        class="form-control @error('qty') is-invalid @enderror" placeholder="e.g : 150"
                                        value="{{old('qty')}}" required>
                                    @error('qty')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="unit" class="form-label">Nama Satuan </label>
                                    <input type="text" id="unit" name="unit"
                                        class="form-control @error('unit') is-invalid @enderror"
                                        placeholder="e.g : Level Pedas/Ukuran/" value="{{old('unit')}}" required>
                                    @error('unit')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="unit_variant" class="form-label">Varian Satuan </label>
                                    <textarea class="form-control" id="unit_variant" rows="3"
                                        placeholder="e.g : 1,2,3, || pisahkan dengan koma untuk jumlah banyak "
                                        name="unit_variant" required>{{old('unit_variant')}}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi </label>
                                    <textarea class="form-control" id="description" rows="3"
                                        placeholder="e.g : Ngejelasain Prodak " name="description"
                                        required>{{old('description')}}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="photo" class="form-label">Photo <span
                                            class="text-danger">*</span></label>
                                    <input type="file" id="photo" name="photo[]" class="form-control" accept="image/*"
                                        multiple required>
                                    @error('photo')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <!-- Preview -->
                                <div class="dropzone-previews mt-3" id="file-previews"></div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center mb-3">
                                <a href="{{route('Product.index')}}" class="btn w-sm btn-danger waves-effect">Cancel</a>
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
