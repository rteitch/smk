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
                <input type="text" class="form-control" value="{{ $order_q_s->quest->batas_waktu }}" disabled>
                <br>

                <label for="">Lihat File</label>
                <a class="btn btn-success" href="#">Lihat File</a>

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
