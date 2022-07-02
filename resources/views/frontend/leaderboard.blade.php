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
                    <li class="breadcrumb-item">Leaderboard</li>
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
    <table id="table_id" class="display" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Skor</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection

@section('footer-scripts')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

    <script>
        $('#table_id').DataTable({
            responsive: true,
            "processing": true,
            "serverSide": true,
            dom: 'Blfrtip',
            buttons: [{
                    extend: 'excel',
                    text: 'Export to Excel',
                    exportOptions: {
                        modifier: {
                            page: "current"
                        }
                    },
                    className: 'btn btn-primary glyphicon glyphicon-list-alt mb-3'
                },
                {
                    extend: 'pdf',
                    customize: function(doc) {
                        doc.content[1].table.widths =
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    },
                    text: 'Export to PDF',
                    exportOptions: {
                        modifier: {
                            page: "current"
                        }
                    },
                    className: 'btn btn-primary glyphicon glyphicon-file mb-3'
                },
                {
                    extend: 'print',
                    text: 'Print',
                    exportOptions: {
                        modifier: {
                            page: "current"
                        }
                    },
                    className: 'btn btn-primary glyphicon glyphicon-print mb-3'
                },
            ],
            "ajax": '{{ url('get-leaderboard') }}',
            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'skor',
                    name: 'skor'
                }
            ]
        });
    </script>
@endsection
