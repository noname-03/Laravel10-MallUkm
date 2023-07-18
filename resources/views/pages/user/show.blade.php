@extends('layouts.app')
@section('title', 'Detail Produk')
@section('content')


<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('Product.index')}}">Produk</a></li>
                        <li class="breadcrumb-item active">Detail Produk</li>
                    </ol>
                </div>
                <h4 class="page-title">Product Detail</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5">

                            <div class="tab-content pt-0">
                                @foreach ($product->photo as $key=> $item)
                                <div class="tab-pane {{$key+1 === 1 ? 'active show' : ''}}"
                                    id="product-{{$key+1}}-item">
                                    <img src="{{asset('/images/product/' . $item)}}" alt=""
                                        class="img-fluid mx-auto d-block rounded">
                                </div>
                                @endforeach
                            </div>

                            <ul class="nav nav-pills nav-justified">

                                @foreach ($product->photo as $key=> $item)
                                <li class="nav-item">
                                    <a href="#product-{{$key+1}}-item" data-bs-toggle="tab" aria-expanded="false"
                                        class="nav-link product-thumb {{$key+1 === 1 ? 'active show' : ''}}">
                                        <img src="{{asset('/images/product/' . $item)}}" alt=""
                                            class="img-fluid mx-auto d-block rounded">
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div> <!-- end col -->
                        <div class="col-lg-7">
                            <div class="ps-xl-3 mt-3 mt-xl-0">
                                <h4 class="mb-3">{{$product->title}}</h4>
                                <h6 class="text-danger text-uppercase">{{$product->discount}} % Off</h6>
                                <h4 class="mb-4">Harga : <span class="text-muted me-2"><del>
                                            @currency($product->price_retail)</del></span> <b>
                                        @currency($product->price)</b></h4>
                                <h4><span class="badge bg-soft-success text-success mb-4">{{$product->status}}</span>
                                </h4>
                                <p class="text-muted mb-4">{{$product->description}}</p>
                                <form class="d-flex flex-wrap align-items-center mb-4">
                                    <label class="my-1 me-2" for="quantityinput">Stok</label>
                                    <div class="me-3 mt-2">
                                        <p>{{$product->qty}}</p>
                                    </div>

                                    <label class="my-1 me-2" for="sizeinput">{{$product->unit}}</label>
                                    <div class="me-sm-3">
                                        <select class="form-select my-1" id="sizeinput">
                                            @foreach ($product->unit_variant as $item)
                                            <option>{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>


                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->


                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->

</div> <!-- container -->

@endsection