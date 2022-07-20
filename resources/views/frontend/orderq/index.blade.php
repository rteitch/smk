@extends('layouts.global')

@section('title')
    Manajemen Quest Siswa
@endsection

@section('dashboard-active')
    active
@endsection

@section('da-collapse-in')
    in
@endsection

@section('dash-quest-siswa-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Manajemen Quest Siswa</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('orderq.index') }}">Manajemen Quest Siswa</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">

            <form action="{{ route('orderq.index') }}">
                <div class="row">
                    <div class="col-md-5">
                        <input value="{{ Request::get('name') }}" name="name" type="text" class="form-control"
                            placeholder="Cari nama siswa">
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-control" id="status">
                            <option value="">ANY</option>
                            <option {{ Request::get('status') == 'SUBMIT' ? 'selected' : '' }} value="SUBMIT">SUBMIT
                            </option>
                            <option {{ Request::get('status') == 'PROSES' ? 'selected' : '' }} value="PROSES">PROSES
                            </option>
                            <option {{ Request::get('status') == 'SELESAI' ? 'selected' : '' }} value="SELESAI">SELESAI
                            </option>
                            <option {{ Request::get('status') == 'GAGAL' ? 'selected' : '' }} value="GAGAL">GAGAL
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" value="Filter" class="btn btn-primary">
                    </div>
            </form>
        </div>
        <hr class="my-3">

        <div class="row">

        </div>
        <div class="table-responsive">
            <table class="table table-stripped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Quest Code</th>
                        <th scope="col"><b>Status</b></th>
                        <th scope="col"><b>Siswa</b></th>
                        <th scope="col"><b>Jenis Soal</b></th>
                        <th scope="col"><b>Batas Waktu</b></th>
                        <th scope="col"><b>Actions</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderq as $order)
                        @foreach ($order->quest as $quests)
                            <small class="text-muted" id="judul_file2"></small>
                            <!-- Modal -->
                            <div id="myModal{{ $order->id }}" class="modal fade" role="dialog">
                                <br>
                                <div class="modal-dialog modal-lg">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="judul_file"><small>{{ $order->quest_code }} -
                                                    {{ $quests->where('id', $quests->pivot->quest_id)->first()->jenis_soal }}
                                                    @if ($order->status == 'SUBMIT')
                                                        <span
                                                            class="badge bg-warning text-light">{{ $order->status }}</span>
                                                    @elseif($order->status == 'PROSES')
                                                        <span
                                                            class="badge bg-info text-light">{{ $order->status }}</span>
                                                    @elseif($order->status == 'SELESAI')
                                                        <span
                                                            class="badge bg-success text-light">{{ $order->status }}</span>
                                                    @elseif($order->status == 'GAGAL')
                                                        <span
                                                            class="badge bg-dark text-light">{{ $order->status }}</span>
                                                    @endif
                                                </small></h3>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe src="{{ asset('storage/' . $order->file_jawab) }}" frameborder="0"
                                                width="100%" height="400px" type="application/pdf"></iframe>

                                            <div class="modal-footer">

                                                <a href="{{ route('orderq.edit', [$order->id]) }}"
                                                    class="btn btn-info btn-sm"> Edit Status</a>
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <tr>
                                <td>{{ $order->quest_code }}</td>
                                <td>
                                    @if ($order->status == 'SUBMIT')
                                        <span class="badge bg-warning text-light">{{ $order->status }}</span>
                                    @elseif($order->status == 'PROSES')
                                        <span class="badge bg-info text-light">{{ $order->status }}</span>
                                    @elseif($order->status == 'SELESAI')
                                        <span class="badge bg-success text-light">{{ $order->status }}</span>
                                    @elseif($order->status == 'GAGAL')
                                        <span class="badge bg-dark text-light">{{ $order->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $order->user->name }} <br>
                                    <small>{{ $order->user->email }}</small>
                                </td>
                                <td>{{ $quests->where('id', $quests->pivot->quest_id)->first()->jenis_soal }}</td>
                                <td>

                                    <span class="btn" data-countdown="{{ $quests->batas_waktu }}"></span>
                                </td>
                                <td>

                                    <a href="{{ route('orderq.edit', [$order->id]) }}" class="btn btn-info btn-sm"> Edit
                                        Status</a>
                                    <!-- Trigger the modal with a button -->
                                    @if ($quests->where('id', $quests->pivot->quest_id)->first()->jenis_soal == 'LAPORAN')
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#myModal{{ $order->id }}"><span class="oi oi-eye"></span> Lihat
                                            Laporan
                                        </button>
                                    @else
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="10">
                            <div class="d-flex justify-content-start">
                                {!! $orderq->links() !!}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    </div>
@endsection
@section('footer-scripts')
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script>
        $('[data-countdown]').each(function() {
            var $this = $(this),
                finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
                if (event.strftime('%D days %H:%M:%S') == event.strftime('00 days 00:00:00')) {
                    $this.html('<span class="badge bg-danger text-light">Quest telah berakhir!</span>');
                } else {
                    $this.html(event.strftime(
                        '<p class="badge bg-success text-light">Waktu Quest Masih Tersedia</p><br><span >%D days %H:%M:%S</span>'
                    ));
                }
            });
        });
    </script>
@endsection
