@extends('layouts.global')

@section('title')
    Leaderboard
@endsection

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="text-center">
        <h1>LEADERBOARD</h1>
    </div>
    <div style="margin-top: 50px">
        <div class="card">
            <div class="card-body">
                <table id="table-leaderboard" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Skor</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-leaderboard').DataTable({
                processing: true,
                serverSide: true,
                dom: 'Blfrtip',
                buttons: [{
                        extend: 'excel',
                        text: 'Export to Excel',
                        exportOptions: {
                            modifier: {
                                page: "current"
                            }
                        },
                        className: 'btn btn-primary glyphicon glyphicon-list-alt'
                    },
                    {
                        extend: 'pdf',
                        text: 'Export to PDF',
                        exportOptions: {
                            modifier: {
                                page: "current"
                            }
                        },
                        className: 'btn btn-primary glyphicon glyphicon-file'
                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        exportOptions: {
                            modifier: {
                                page: "current"
                            }
                        },
                        className: 'btn btn-primary glyphicon glyphicon-print'
                    },
                ],
                ajax: '{{ url('get-leaderboard') }}',
                columns: [{
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'username'
                    },
                    {
                        data: 'skor'
                    }
                ],
            });
        });
    </script>
@endsection
