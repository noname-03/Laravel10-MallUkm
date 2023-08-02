@extends('layouts.app')
@section('title', 'Hasil')
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
                            <li class="breadcrumb-item active">Hasil</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Hasil</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Hasil</h4>

                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Rata Rata MIS</th>
                                    <th>Rata Rata MSS</th>
                                    <th>WF</th>
                                    <th>WS</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($results as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ round($item->averageMis, 2) }}</td>
                                        <td>{{ round($item->averageMss, 2) }}</td>
                                        <td>{{ round($item->wf, 2) }}</td>
                                        <td>{{ round($item->ws, 2) }}</td>
                                        <td>
                                            <form action="{{ route('result.destroy', $item->id) }}" method="POST">
                                                @method('DELETE') @csrf
                                                <div class="btn-group" role="group" aria-label="Basic example">
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
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <table id="basic-datatable1" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Total MIS</th>
                                    <th>WT</th>
                                    <th>CSI</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>{{ round($totalMis, 2) }}</td>
                                    <td>{{ round($totalWt, 2) }}</td>
                                    <td>{{ $csi }}</td>
                                    <td>
                                        @if ($csi >= 0 && $csi <= 20)
                                            <p>Tidak Puas</p>
                                        @elseif ($csi >= 21 && $csi <= 40)
                                            <p>Kurang Puas</p>
                                        @elseif ($csi >= 41 && $csi <= 60)
                                            <p>Puas</p>
                                        @elseif ($csi >= 61 && $csi <= 80)
                                            <p>Cukup Puas</p>
                                        @elseif ($csi >= 81 && $csi <= 100)
                                            <p>Sangat Puas
                                            </p>
                                        @else
                                            <p>Nilai tidak valid</p>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>

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
