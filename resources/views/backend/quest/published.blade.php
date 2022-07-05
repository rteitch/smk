@extends('layouts.global')

@section('title')
    Quest
@endsection

@section('ga-active')
    active
@endsection

@section('ga-collapse-in')
    in
@endsection

@section('ga-quest')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Quest</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Guild Adventure</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('skill.published') }}">Quest</a> </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div>
            <div class="col-12 col-sm-12">
                <h2>Quest Available</h2>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <hr class="my-3">
                </div>
            </div>

            <div class="row">
                @foreach ($quest as $index => $quests)
                    @foreach ($quests->skill as $qskill)
                        @foreach ($user_login->skill as $uskill)
                            @if ($qskill->pivot->skill_id == $uskill->id)
                                <div class="col-md-12 col-lg-4 mb-2">
                                    <div class="card">
                                        <div class="card-header bg-info text-center text-light border-0"
                                            style="background-image: url(assets/matthieu-a-262686-unsplash.jpg); background-size: 100%">
                                            <div class="text-left w-100">
                                                <h5 class="m-0">{{ $index + 1 }}. {{ $quests->judul }}</h5>
                                                <small>Pembuat :
                                                    {{ $user->where('id', $quests->created_by)->first()->name }}
                                                </small>
                                            </div>
                                            <img class="w-25 h-25 clearfix rounded-circle border border-white"
                                                style="border-width: 3px !important;margin-bottom: -3rem;clear: both;"
                                                src="{{ asset('storage/' . $user->where('id', $quests->created_by)->first()->avatar) }}"
                                                alt="users">
                                        </div>
                                        <div
                                            class="card-body text-center d-flex flex-row justify-content-between pt-4 mt-4">
                                            <div class="col text-align border-right border-left">
                                                <h6 class="fw-bold m-0">{{ $quests->level }}</h6>
                                                <small>Level</small>
                                            </div>
                                            <div class="col text-align border-right border-left">
                                                <h6 class="fw-bold m-0">{{ $quests->skor }}</h6>
                                                <small>Bonus Skor</small>
                                            </div>
                                            <div class="col text-align border-right">
                                                <h6 class="fw-bold m-0">{{ $quests->exp }}</h6>
                                                <small>Bonus EXP</small>
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            <small>Tingkat Kesulitan :
                                                {{ $quests->kesulitan }}
                                            </small>
                                            <br>
                                            <small>Jenis Quest :
                                                @if ($quests->jenis_soal == 'PILGANDA')
                                                    Uji Pengetahuan
                                                @elseif ($quests->jenis_soal == 'LAPORAN')
                                                    Laporan Dokumentasi
                                                @endif
                                            </small>
                                            <br>
                                            <small>Quest akan berakhir : {{ $quests->batas_waktu }}</small>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-center">
                                                {{-- <a class="btn btn-success" href="#">Ambil Quest</a> --}}

                                                {{-- @if ($orderq->isHasQuest($quests->id))
                                            <small class="text-info">Quest sudah ditambahkan</small>
                                        @else --}}
                                                <form
                                                    onsubmit="return confirm('Tambah this id {{ $quests->id }} Quest {{ $quests->name }} ke user?')"
                                                    method="POST"
                                                    action="{{ route('orderq.tambahOrderQuest', [$quests->id]) }}"
                                                    class="d-inline">

                                                    @csrf

                                                    <input type="submit" value="Tambah" class="btn btn-primary" />
                                                </form>
                                                {{-- @endif --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                @endforeach
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex justify-content-start">
                {!! $quest->links() !!}
            </div>
        </div>
    </div>
@endsection
