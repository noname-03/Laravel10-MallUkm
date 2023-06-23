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
                                <h3 class="text-dark mt-1">$<span data-plugin="counterup">58,947</span></h3>
                                <p class="text-muted mb-1 text-truncate">Total Revenue</p>
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
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">1,845</span></h3>
                                <p class="text-muted mb-1 text-truncate">Orders</p>
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
                                <i class="dripicons-store font-24 avatar-title text-info"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">825</span></h3>
                                <p class="text-muted mb-1 text-truncate">Stores</p>
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
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">2,430</span></h3>
                                <p class="text-muted mb-1 text-truncate">Sellers</p>
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
                                    <th class="border-top-0">Name</th>
                                    <th class="border-top-0">Card</th>
                                    <th class="border-top-0">Date</th>
                                    <th class="border-top-0">Amount</th>
                                    <th class="border-top-0">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="assets/images/users/user-2.jpg" alt="user-pic"
                                            class="rounded-circle avatar-sm bx-shadow-lg" />
                                        <span class="ms-2">Imelda J. Stanberry</span>
                                    </td>
                                    <td>
                                        <img src="assets/images/cards/visa.png" alt="user-card" height="24" />
                                        <span class="ms-2">**** 3256</span>
                                    </td>
                                    <td>27.03.2018</td>
                                    <td>$345.98</td>
                                    <td><span class="badge rounded-pill bg-danger">Failed</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="assets/images/users/user-3.jpg" alt="user-pic"
                                            class="rounded-circle avatar-sm bx-shadow-lg" />
                                        <span class="ms-2">Francisca S. Lobb</span>
                                    </td>
                                    <td>
                                        <img src="assets/images/cards/master.png" alt="user-card" height="24" />
                                        <span class="ms-2">**** 8451</span>
                                    </td>
                                    <td>28.03.2018</td>
                                    <td>$1,250</td>
                                    <td><span class="badge rounded-pill bg-success">Paid</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="assets/images/users/user-1.jpg" alt="user-pic"
                                            class="rounded-circle avatar-sm bx-shadow-lg" />
                                        <span class="ms-2">James A. Wert</span>
                                    </td>
                                    <td>
                                        <img src="assets/images/cards/amazon.png" alt="user-card" height="24" />
                                        <span class="ms-2">**** 2258</span>
                                    </td>
                                    <td>28.03.2018</td>
                                    <td>$145</td>
                                    <td><span class="badge rounded-pill bg-success">Paid</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="assets/images/users/user-4.jpg" alt="user-pic"
                                            class="rounded-circle avatar-sm bx-shadow-lg" />
                                        <span class="ms-2">Dolores J. Pooley</span>
                                    </td>
                                    <td>
                                        <img src="assets/images/cards/american-express.png" alt="user-card"
                                            height="24" />
                                        <span class="ms-2">**** 6950</span>
                                    </td>
                                    <td>29.03.2018</td>
                                    <td>$2,005.89</td>
                                    <td><span class="badge rounded-pill bg-danger">Failed</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="assets/images/users/user-5.jpg" alt="user-pic"
                                            class="rounded-circle avatar-sm bx-shadow-lg" />
                                        <span class="ms-2">Karen I. McCluskey</span>
                                    </td>
                                    <td>
                                        <img src="assets/images/cards/discover.png" alt="user-card" height="24" />
                                        <span class="ms-2">**** 0021</span>
                                    </td>
                                    <td>31.03.2018</td>
                                    <td>$24.95</td>
                                    <td><span class="badge rounded-pill bg-success">Paid</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive -->
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Recent Products</h4>

                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Product</th>
                                    <th class="border-top-0">Category</th>
                                    <th class="border-top-0">Added Date</th>
                                    <th class="border-top-0">Amount</th>
                                    <th class="border-top-0">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="assets/images/products/product-1.png" alt="product-pic" height="36" />
                                        <span class="ms-2">Adirondack Chair</span>
                                    </td>
                                    <td>
                                        Dining Chairs
                                    </td>
                                    <td>27.03.2018</td>
                                    <td>$345.98</td>
                                    <td><span class="badge bg-soft-success text-success">Active</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="assets/images/products/product-2.png" alt="product-pic" height="36" />
                                        <span class="ms-2">Biblio Plastic Armchair</span>
                                    </td>
                                    <td>
                                        Baby Chairs
                                    </td>
                                    <td>28.03.2018</td>
                                    <td>$1,250</td>
                                    <td><span class="badge bg-soft-success text-success">Active</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="assets/images/products/product-3.png" alt="product-pic" height="36" />
                                        <span class="ms-2">Amazing Modern Chair</span>
                                    </td>
                                    <td>
                                        Plastic Armchair
                                    </td>
                                    <td>28.03.2018</td>
                                    <td>$145</td>
                                    <td><span class="badge bg-soft-danger text-danger">Deactive</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="assets/images/products/product-4.png" alt="product-pic" height="36" />
                                        <span class="ms-2">Designer Awesome Chair</span>
                                    </td>
                                    <td>
                                        Wing Chairs
                                    </td>
                                    <td>29.03.2018</td>
                                    <td>$2,005.89</td>
                                    <td><span class="badge bg-soft-success text-success">Active</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="assets/images/products/product-5.png" alt="product-pic" height="36" />
                                        <span class="ms-2">The butterfly chair</span>
                                    </td>
                                    <td>
                                        Plastic Armchair
                                    </td>
                                    <td>31.03.2018</td>
                                    <td>$24.95</td>
                                    <td><span class="badge bg-soft-success text-success">Active</span></td>
                                </tr>

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