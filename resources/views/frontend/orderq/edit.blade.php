@extends('layouts.global')

@section('title')
    Ubah Status Quest Siswa
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
                <h2>Ubah Status Quest Siswa</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item"> <a href="{{ route('orderq.index') }}">Manajemen Quest Siswa</a>
                    <li class="breadcrumb-item active"> <a href="{{ route('orderq.edit', [$order_q_s->id]) }}">Ubah Status Quest Siswa</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form class="shadow-sm bg-white p-3" action="{{ route('orderq.update', [$order_q_s->id]) }}" method="POST">

                @csrf

                <input type="hidden" name="_method" value="PUT">

                <label for="quest_code">Quest Code</label><br>
                <input type="text" class="form-control" value="{{ $order_q_s->quest_code }}" disabled>
                <br>

                <label for="">Nama Siswa</label><br>
                <input disabled class="form-control" type="text" value="{{ $order_q_s->user->name }}">
                <br>

                <label for="">Job Class</label><br>
                <input disabled class="form-control" type="text"
                    value="@foreach ($order_q_s->user->jobclass as $jobclass) {{ $jobclass->name }}, @endforeach
                ">
                <br>
                <label for="created_at">Batas Waktu</label><br>
                <input type="text" class="form-control"
                    value="@foreach ($order_q_s->quest as $quests) {{ $quests->batas_waktu }} @endforeach " disabled>
                <br>
                <!-- Trigger the modal with a button -->

                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="judul_file">{{ $order_q_s->file_jawab }}</h3>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <iframe src="{{ asset('storage/' . $order_q_s->file_jawab) }}" frameborder="0"
                                    width="100%" height="400px" type="application/pdf"></iframe>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @foreach ($order_q_s->quest as $quests)
                    @if ($quests->where('id', $quests->pivot->quest_id)->first()->jenis_soal == 'LAPORAN')
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><span
                                class="oi oi-eye"></span> Lihat File Jawaban
                        </button>

                        <br>
                        <small class="text-muted" id="judul_file2">{{ $order_q_s->file_jawab }}</small>
                        <br><br>
                    @elseif ($quests->where('id', $quests->pivot->quest_id)->first()->jenis_soal == 'PILGANDA')
                        <label for="">Jawaban Pilgan</label><br>
                        <input class="form-control" type="text" value="{{ $order_q_s->jawaban_pilgan }}" disabled>
                        <br>
                    @endif
                @endforeach

                <label for="status">Status</label><br>
                <select class="form-control" name="status" id="status">
                    <option {{ $order_q_s->status == 'SUBMIT' ? 'selected' : '' }} value="SUBMIT">SUBMIT</option>
                    <option {{ $order_q_s->status == 'PROSES' ? 'selected' : '' }} value="PROSES">PROSES</option>
                    <option {{ $order_q_s->status == 'SELESAI' ? 'selected' : '' }} value="SELESAI">SELESAI</option>
                    <option {{ $order_q_s->status == 'GAGAL' ? 'selected' : '' }} value="GAGAL">GAGAL</option>
                </select>
                <br>

                <input type="submit" class="btn btn-primary" value="Update">

            </form>
        </div>
    </div>
@endsection
