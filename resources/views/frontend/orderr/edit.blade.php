@extends('layouts.global')

@section('title')
    Edit order Reward
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="shadow-sm bg-white p-3" action="{{ route('orderr.update', [$order_r_s->id]) }}" method="POST">

                @csrf

                <input type="hidden" name="_method" value="PUT">

                <label for="reward_code">Reward Code</label><br>
                <input type="text" class="form-control" value="{{ $order_r_s->reward_code }}" disabled>
                <br>

                <label for="title">Nama Reward</label><br>
                <input type="text" class="form-control" value="{{ $order_r_s->reward->title }}" disabled>
                <br>
                <label for="syarat_skor">Syarat Skor</label><br>
                <input type="text" class="form-control" value="{{ $order_r_s->reward->syarat_skor }}" disabled>
                <br>

                <label for="">Nama Siswa</label><br>
                <input disabled class="form-control" type="text" value="{{ $order_r_s->user->name }}">
                <br>

                <label for="">Nomor HP Siswa</label><br>
                <input disabled class="form-control" type="text" value="{{ $order_r_s->user->phone }}">
                <br>

                <label for="status">Status</label><br>
                <select class="form-control" name="status" id="status">
                    <option {{ $order_r_s->status == 'SUBMIT' ? 'selected' : '' }} value="SUBMIT">SUBMIT</option>
                    <option {{ $order_r_s->status == 'PROCESS' ? 'selected' : '' }} value="PROCESS">PROCESS</option>
                    <option {{ $order_r_s->status == 'FINISH' ? 'selected' : '' }} value="FINISH">FINISH</option>
                    <option {{ $order_r_s->status == 'CANCEL' ? 'selected' : '' }} value="CANCEL">CANCEL</option>
                </select>
                <br>

                <input type="submit" class="btn btn-primary" value="Update">

            </form>
        </div>
    </div>
@endsection
