@extends('layouts.global')

@section('title')
    Anggota
@endsection

@section('ga-active')
    active
@endsection

@section('ga-collapse-in')
    in
@endsection

@section('ga-anggota-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Angota</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Guild Adventure</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('frontend.anggota') }}">Anggota</a> </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
    </div>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <style>
        td {
            word-break: break-all !important;
        }
    </style>
@endsection

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item mr-2 text-white">
                                <a class="nav-link {{ Request::get('status') == 'PENGAJAR' ? 'active' : '' }}"
                                    href="{{ route('frontend.anggota', ['status' => 'PENGAJAR']) }}">PENGAJAR</a>
                            </li>
                            <li class="nav-item mr-2 text-white">
                                <a class="nav-link {{ Request::get('status') == 'SISWA' ? 'active' : '' }}"
                                    href="{{ route('frontend.anggota', ['status' => 'SISWA']) }}">SISWA</a>
                            </li>
                        </ul>
                        <br>
                    </div>
                </div>
                <div>

                    <table id="table_id_anggota" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Avatar</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Level</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-scripts')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.css" rel="stylesheet"
        type="text/css" />
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>
    <link href="https://cdn.datatables.net/rowreorder/1.2.6/css/rowReorder.dataTables.css" rel="stylesheet"
        type="text/css" />
    <script src="https://cdn.datatables.net/rowreorder/1.2.6/js/dataTables.rowReorder.js"></script>


    <script>
        let currentLocation = window.location.search;
        $('#table_id_anggota').DataTable({
            responsive: true,
            rowReorder: {
                dataSrc: 0,
                snapX: true,
                enable: true
            },
            "processing": true,
            "serverSide": true,
            "ajax": '{{ url('get-anggota') }}' + currentLocation,
            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'avatar_url',
                    name: 'avatar_url',
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'level',
                    name: 'level',
                }
            ]
        });
    </script>
@endsection
