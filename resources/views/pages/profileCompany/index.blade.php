@extends('layouts.app')
@section('title', 'Perusahaan Profil')
@push('styles')
    <!-- third party css -->
    <link href="{{ asset('/') }}assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/') }}assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/') }}assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <!-- third party css end -->
@endpush

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Perusahaan Profil</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Perusahaan Profil</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4>Perusahaan Profil</h4>
                            </div>
                            <div class="col-lg-6">
                                @if ($profileCompanyCount === 0)
                                    <p class="text-muted font-13 mb-2 mt-2">
                                        <a href="{{ route('profileCompany.create') }}" class="btn btn-sm btn-success">Tambah
                                            Data</a>
                                    </p>
                                @else
                                    <p class="text-muted font-13 mb-2 mt-2">
                                        <a href="{{ route('profileCompany.edit', $profileCompany->id) }}"
                                            class="btn btn-sm btn-success">Edit
                                            Profil Perusahaan</a>
                                    </p>
                                @endif
                            </div>
                        </div>

                        @if ($profileCompanyCount > 0)
                            <div class="row">
                                <div class="col-lg-6 mt-4">
                                    <p><b>Latitude</p></b>
                                    <p>{{ $profileCompany->latitude }}</p>
                                    <p><b>Longitude</b></p>
                                    <p>{{ $profileCompany->longitude }}</p>
                                </div>
                                <div class="col-lg-6 mt-4">
                                    <p><b>Phone</b></p>
                                    <p>{{ $profileCompany->phone }}</p>
                                    <p><b>Radius</b></p>
                                    <p>{{ $profileCompany->radius }} Meter</p>
                                </div>
                            </div>
                            <h5 class="mt-3">Syarat :</h5>

                            <p class="text-muted mb-4">
                                {{ $profileCompany->terms }}
                            </p>

                            <h5 class="mt-3">Ketentuan :</h5>

                            <p class="text-muted mb-4">
                                {{ $profileCompany->provision }}
                            </p>
                        @endif
                        {{-- <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Hp</th>
                                <th>Syarat</th>
                                <th>Ketentuan</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($profileCompany as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->terms}}</td>
                                <td>{{$item->provision}}</td>
                                <td>{{$item->latitude}}</td>
                                <td>{{$item->longitude}}</td>
                                <td>
                                    <form action="{{ route('profileCompany.destroy', $item->id) }}" method="POST">
                                        @method('DELETE') @csrf
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('profileCompany.edit', $item->id) }}"
                                                class="btn btn-sm btn-outline-secondary">
                                                Edit
                                            </a>
                                            <button type="submit"
                                                onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')"
                                                class="btn btn-sm btn-outline-danger">
                                                Delete
                                            </button>
                                        </div>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table> --}}

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->
    </div>
@endsection
@push('scripts')
    <!-- third party js -->
    <script src="{{ asset('/') }}assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script src="{{ asset('/') }}assets/js/pages/datatables.init.js"></script>
@endpush
