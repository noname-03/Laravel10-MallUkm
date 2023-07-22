@extends('layouts.app')
@section('title', 'Produk')
@push('styles')
@endpush

@section('content')

<!-- Mulai Konten -->
<div class="container-fluid">

    <!-- judul halaman -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Beranda</a></li>
                        <li class="breadcrumb-item active">Produk</li>
                    </ol>
                </div>
                <h4 class="page-title">Produk</h4>
            </div>
        </div>
    </div>
    <!-- akhir judul halaman -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <form id="search-form" class="d-flex flex-wrap align-items-center">
                                <label for="inputPassword2" class="visually-hidden">Cari</label>
                                <div class="me-3">
                                    <input type="search" class="form-control my-1 my-lg-0" id="search-input"
                                        placeholder="Cari...">
                                </div>
                                <label for="status-select" class="me-2">Urutkan</label>
                                <div class="me-sm-3">
                                    <select class="form-select my-1 my-lg-0" id="sort-select">
                                        <option value="0">Semua</option>
                                        <option value="1">Produk Terbaru</option>
                                        <option value="2">Harga Rendah</option>
                                        <option value="3">Harga Tinggi</option>
                                        <option value="4">Stok Habis</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-auto">
                            <div class="text-lg-end my-1 my-lg-0">
                                <button type="button" class="btn btn-success waves-effect waves-light me-1"><i
                                        class="mdi mdi-cog"></i></button>
                                <a href="{{route('Product.create')}}" class="btn btn-danger waves-effect waves-light"><i
                                        class="mdi mdi-plus-circle me-1"></i> Tambah Baru</a>
                            </div>
                        </div><!-- end col-->
                    </div> <!-- end row -->
                </div>
            </div> <!-- end card -->
        </div> <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row" id="product-list">
        <!-- Daftar produk akan ditempatkan di sini -->
        <!-- Konten daftar produk akan diisi melalui AJAX -->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-12">
            <ul class="pagination pagination-rounded justify-content-end mb-3">
                {{ $products->links() }}
            </ul>


        </div> <!-- end col-->
    </div>
    <!-- end row-->

</div> <!-- container -->

@endsection

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        // Function to fetch products using AJAX
    function formatCurrency(price) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(price);
    }
    function fetchProducts(search, sortBy, page) {
        $.ajax({
            url: "{{ route('Product.index') }}",
            type: "GET",
            data: {
                search: search,
                sortBy: sortBy,
                page: page // Tambahkan parameter page untuk pagination
            },
            dataType: "json",
            success: function(data) {
                var productsHtml = '';
                // Loop through the products and build the HTML
                $.each(data, function(index, product) {
                    // console.log(product.photo);
                        productsHtml += '<div class="col-md-6 col-lg-4 col-xl-3">';
                        productsHtml += '<div class="card product-box">';
                        productsHtml += '<div class="card-body">';
                        productsHtml += '<div class="product-action">';
                        productsHtml += '<a href="{{ route('Product.index') }}/' + product.id + '/edit" class="btn btn-success btn-xs waves-effect waves-light"><i class="mdi mdi-pencil"></i></a>';

                        productsHtml += '<form action="{{ route('Product.destroy', '') }}/' + product.id + '" method="post">';
                        productsHtml += '@method("DELETE") @csrf';
                        productsHtml += '<button type="submit" onclick="return confirm(\'Apakah Anda Yakin Ingin Menghapus Data Ini?\')" class="btn btn-danger btn-xs waves-effect waves-light"><i class="mdi mdi-close"></i></button>';
                        productsHtml += '</form>';
                        productsHtml += '</div>';
                        productsHtml += '<div class="bg-light">';
                        productsHtml += '<img src="{{asset('images/product/')}}/' + product.photo +
                            '" alt="product-pic" class="img-fluid" />';
                        productsHtml += '</div>';
                        productsHtml += '<div class="product-info">';
                        productsHtml += '<div class="row align-items-center">';
                        productsHtml += '<div class="col">';
                        productsHtml += '<h5 class="font-16 mt-0 sp-line-1"><a href="{{route('Product.show', '')}}/' + product.id +
                            '" class="text-dark">' + product.title + '</a></h5>';
                        productsHtml += '<h5 class="m-0"> <span class="text-muted"> Stocks : ' + product.qty +
                            ' pcs</span></h5>';
                        productsHtml += '</div>';
                        productsHtml += '<div class="col-auto">';
                        productsHtml += '<div class="product-price-tag">';
                        productsHtml += formatCurrency(product.price);
                        productsHtml += '</div>';
                        productsHtml += '</div>';
                        productsHtml += '</div>'; // end row
                        productsHtml += '</div>'; // end product info
                        productsHtml += '</div>'; // end card body
                        productsHtml += '</div>'; // end card
                        productsHtml += '</div>'; // end col
                    });

                // Update the product listing
                $('#product-list').html(productsHtml);
            }
        });
    }

        // Function to handle search and sort updates
        function updateProducts(page = 1) { // Tambahkan parameter page dengan nilai default 1
            var searchInput = $('#search-input').val();
            var sortByInput = $('#sort-select').val();
            fetchProducts(searchInput, sortByInput, page);
        }

        // Initial load of products
        updateProducts();

        // Handle form submission
        $('#search-form').on('submit', function(e) {
            e.preventDefault();
            updateProducts();
        });

        // Handle sort select change
        $('#sort-select').on('change', function() {
            updateProducts();
        });

        // Handle search input change
        $('#search-input').on('input', function() {
            updateProducts();
        });
    });
</script>
@endpush