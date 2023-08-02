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
    <link href="{{ asset('/') }}assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/') }}assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet"
        type="text/css" />
    <!-- third party css end -->
@endpush

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <!-- Bagian Judul Halaman -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Hasil</li>
                    </ol>
                    <h4 class="page-title">Hasil</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Month View</label>
                    <input type="text" class="form-control" id="bulan" data-provide="datepicker"
                        data-date-format="MM yyyy" data-date-min-view-mode="1">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mt-3 mb-3">
                    <button class="btn btn-primary" onclick="searchByMonthAndYear()">Search</button>
                </div>
            </div>
        </div>


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
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{ route('result.show', $item->id) }}"
                                                            class="btn btn-sm btn-outline-info">
                                                            Show
                                                        </a>
                                                        <button type="submit"
                                                            onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')"
                                                            class="btn btn-sm btn-outline-danger">
                                                            Delete
                                                        </button>
                                                    </div>
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

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-widgets">
                            <a href="javascript: void(0);" data-bs-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                            <a data-bs-toggle="collapse" href="#cardCollpase5" role="button" aria-expanded="false"
                                aria-controls="cardCollpase5"><i class="mdi mdi-minus"></i></a>
                            <a href="javascript: void(0);" data-bs-toggle="remove"><i class="mdi mdi-close"></i></a>
                        </div>
                        <h4 class="header-title mb-0">Basic Column Chart</h4>

                        <div id="cardCollpase5" class="collapse show" dir="ltr">
                            <div id="apex-column-2" class="apex-charts pt-3" data-colors="#6658dd,#1abc9c,#CED4DC"></div>
                        </div> <!-- collapsed end -->
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->
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



    <!-- Third Party js-->
    <script src="{{ asset('/') }}assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- init js -->
    {{-- <script src="{{ asset('/') }}assets/js/pages/apexcharts.init.js"></script> --}}

    {{-- datepicker --}}
    <script src="{{ asset('/') }}assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <!-- Datatables init -->
    <script src="{{ asset('/') }}assets/js/pages/datatables.init.js"></script>

    <script>
        var options = {
            series: [{
                name: 'MIS',
                data: {{ json_encode($rataRatamis) }}
            }, {
                name: 'MSS',
                data: {{ json_encode($rataRatamss) }}
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16'],
            },
            yaxis: {
                title: {
                    text: 'Nilai'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " nilai"
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#apex-column-2"), options);
        chart.render();
    </script>

    <script>
        function searchByMonthAndYear() {
            var bulan = document.getElementById('bulan').value;
            var bulanValue = new Date(bulan);
            var bulanNumber = bulanValue.getMonth() + 1; // Tambahkan 1 karena index bulan dimulai dari 0
            var tahun = bulanValue.getFullYear();
            var url = "{{ route('result.index') }}" + "?bulan=" + bulanNumber + "&tahun=" + tahun;
            window.location.href = url;
        }
    </script>
@endpush
