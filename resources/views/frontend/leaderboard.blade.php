@extends('layouts.global')

@section('title')
    Leaderboard
@endsection

@section('leaderboard-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Leaderboard</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Guild Adventure</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('user.leaderboard') }}">Leaderboard</a> </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <style>
        td {
            word-break: break-all !important;
        }
    </style>
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.datatables.net/rowreorder/1.2.6/css/rowReorder.dataTables.css" rel="stylesheet"
        type="text/css" />
    <style>
        td {
            word-break: break-all !important;
        }
    </style> --}}
@endsection

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header text-center">
                <h3>LEADERBOARD</h3>
            </div>
            <div class="card-body">
                <div>
                    <table id="table_id_anggota" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Avatar</th>
                                <th>Nama</th>
                                <th>Level</th>
                                <th>Skor</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if ($user->avatar)
                                            <img src="{{ asset('storage/' . $user->avatar) }}"
                                                alt="avatar_{{ $user->name }}" width="40px" height="40px"
                                                class="rounded-circle">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->level }}</td>
                                    <td>{{ $user->skor }}</td>
                                    <td>
                                        @if ($user->status == 'on')
                                            <span class="badge badge-success p-2">
                                                {{ $user->status }}
                                            </span>
                                        @else
                                            <span class="badge badge-danger p-2">
                                                {{ $user->status }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    {{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script> --}}

    {{-- <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.6/js/dataTables.rowReorder.js"></script> --}}

    <script>
        $(document).ready(function() {
            $('#table_id_anggota').DataTable({
                // searching: false,
                ordering: false,
            });
        });

        // $('#table_id_anggota').DataTable({
        //     searching: false,
        //     responsive: true,
        //     rowReorder: {
        //         dataSrc: 0,
        //         snapX: true,
        //         enable: true
        //     },
        //     // processing: true,
        //     serverSide: true,
        //     ajax: '{{ url('get-leaderboard') }}',
        //     columns: [{
        //             data: 'DT_RowIndex',
        //             name: 'DT_RowIndex',
        //             "searchable": false
        //         },
        //         {
        //             data: 'avatar_url',
        //             name: 'avatar_url',
        //             "searchable": false
        //         },
        //         {
        //             data: 'name',
        //             name: 'name',
        //         },
        //         {
        //             data: 'skor',
        //             name: 'skor',
        //         },
        //         {
        //             data: 'level',
        //             name: 'level',
        //         }
        //     ]
        // });
    </script>
@endsection
