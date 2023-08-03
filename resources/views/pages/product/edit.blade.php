@extends('layouts.app')
@section('title', 'Edit Produk')
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
                            <li class="breadcrumb-item"><a href="{{ route('Product.index') }}">Product</a></li>
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
                    <form action="{{ route('Product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Kategori <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control select2" id="category_id" name="category_id">
                                            @foreach ($category as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id === $product->category_id ? 'selected' : '' }}>
                                                    {{ $item->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Nama Produk <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="title" name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            placeholder="e.g : Batik" value="{{ old('title', $product->title) }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="price" class="form-label">Harga <span
                                                class="text-danger">*</span></label>
                                        <input type="number" id="price" name="price"
                                            class="form-control @error('price') is-invalid @enderror"
                                            placeholder="e.g : 120000" value="{{ old('price', $product->price) }}"
                                            required>
                                        @error('price')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="price_retail" class="form-label">Harga Coret </label>
                                        <input type="number" id="price_retail" name="price_retail"
                                            class="form-control @error('price_retail') is-invalid @enderror"
                                            placeholder="e.g : 150000"
                                            value="{{ old('price_retail', $product->price_retail) }}">
                                        @error('price_retail')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="promo" class="form-label">Promo </label>
                                        <input type="number" id="promo" name="promo"
                                            class="form-control @error('promo') is-invalid @enderror"
                                            placeholder="e.g : 150000 || promo untuk pembelian langsung"
                                            value="{{ old('promo', $product->promo) }}">
                                        @error('promo')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="qty" class="form-label">Kuantitas <span
                                                class="text-danger">*</span></label>
                                        <input type="number" id="qty" name="qty"
                                            class="form-control @error('qty') is-invalid @enderror" placeholder="e.g : 150"
                                            value="{{ old('qty', $product->qty) }}" required>
                                        @error('qty')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="weight" class="form-label">Berat Barang <span
                                                class="text-danger">*</span></label>
                                        <input type="number" step="0.01" id="weight" name="weight"
                                            class="form-control @error('weight') is-invalid @enderror"
                                            placeholder="e.g : 1 || 2.1 || ini dalam satuan Gram"
                                            value="{{ old('weight', $product->weight) }}" required>
                                        @error('weight')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="unit" class="form-label">Nama Satuan <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="unit" name="unit"
                                            class="form-control @error('unit') is-invalid @enderror"
                                            placeholder="e.g : Level Pedas/Ukuran/"
                                            value="{{ old('unit', $product->unit) }}" required>
                                        @error('unit')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="unit_variant" class="form-label">Varian Satuan <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" id="unit_variant" rows="3"
                                            placeholder="e.g : 1,2,3, || pisahkan dengan koma untuk jumlah banyak " name="unit_variant" required>{{ old('unit_variant', $product->unit_variant) }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Deskripsi <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" id="description" rows="3" placeholder="e.g : Ngejelasain Prodak "
                                            name="description" required>{{ old('description', $product->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="photo" class="form-label">Photo <span
                                                class="text-danger">*</span></label>
                                        <input type="file" id="photo" name="photo[]" class="form-control"
                                            accept="image/*" multiple>
                                        @error('photo')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <!-- Preview -->
                                    <div class="dropzone-previews mt-3" id="file-previews1">
                                        <!-- Menampilkan preview foto yang sudah ada -->
                                        <div class="row">
                                            @php
                                                $photos = explode(',', $product->photo);
                                            @endphp

                                            <!-- Loop untuk semua foto -->
                                            @foreach ($photos as $photo)
                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <img src="{{ asset('images/product/' . $photo) }}"
                                                            class="card-img-top" alt="Preview Foto">
                                                        <div class="card-body">
                                                            <a href="#"
                                                                onclick="event.preventDefault(); document.getElementById('deleted-photo-form').submit();"
                                                                class="btn btn-danger btn-block">
                                                                <span>Delete</span>
                                                            </a>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center mb-3">
                                    <a href="{{ route('Product.index') }}"
                                        class="btn w-sm btn-primary waves-effect">Kembali</a>
                                    <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Perbarui
                                        Data</button>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                    </form>
                    <form id="deleted-photo-form" action="{{ route('Product.deletePhoto', $product->id) }}"
                        method="POST" class="d-none">
                        <input type="hidden" name="photo_name" value="{{ $photo }}">
                        @csrf @method('DELETE')
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
