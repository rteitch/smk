@extends('layouts.global')

@section('title')
    Edit order Quest
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

                <label for="">Siswa</label><br>
                <input disabled class="form-control" type="text" value="{{ $order_q_s->user->name }}">
                <br>
                <label for="created_at">Batas Waktu</label><br>
                <input type="text" class="form-control"
                    value="@foreach ($order_q_s->quest as $quests) {{ $quests->batas_waktu }} @endforeach " disabled>
                <br>
                <!-- Trigger the modal with a button -->

                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><span
                        class="oi oi-eye"></span> Lihat File Jawaban
                </button>

                <small class="text-muted" id="judul_file2"></small>
                <br>
                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="judul_file">{{ $order_q_s->file_jawaban }}</h3>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <iframe src="{{ asset('storage/' . $order_q_s->file_jawaban) }}" frameborder="0"
                                    width="100%" height="400px" type="application/pdf"></iframe>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <br>

                <label for="">File Jawaban</label><br>
                <input class="form-control" type="text" value="{{ $order_q_s->file_jawaban }}" disabled>
                <br>

                <label for="">Jawaban Pilgan</label><br>
                <input class="form-control" type="text" value="{{ $order_q_s->jawaban_pilgan }}" disabled>
                <br>

                <label for="status">Status</label><br>
                <select class="form-control" name="status" id="status">
                    <option {{ $order_q_s->status == 'SUBMIT' ? 'selected' : '' }} value="SUBMIT">SUBMIT</option>
                    <option {{ $order_q_s->status == 'PROCESS' ? 'selected' : '' }} value="PROCESS">PROCESS</option>
                    <option {{ $order_q_s->status == 'FINISH' ? 'selected' : '' }} value="FINISH">FINISH</option>
                    <option {{ $order_q_s->status == 'CANCEL' ? 'selected' : '' }} value="CANCEL">CANCEL</option>
                </select>
                <br>

                <input type="submit" class="btn btn-primary" value="Update">

            </form>
        </div>
    </div>
@endsection
