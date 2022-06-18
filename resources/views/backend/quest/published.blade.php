@extends('layouts.global')

@section('title')
    Detail Quest
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
                    <div class="col-md-12 col-lg-4 mb-2">
                        <div class="card">
                            <div class="card-header bg-info text-center text-light border-0"
                                style="background-image: url(assets/matthieu-a-262686-unsplash.jpg); background-size: 100%">
                                <div class="text-left w-100">
                                    <h5 class="m-0">{{ $index + 1 }}. Kesulitan : {{ $quests->kesulitan }}</h5>
                                    <small>Pembuat :
                                        @foreach ($user as $users)
                                            @if ($users->id == $quests->created_by)
                                                {{ $users->name }}
                                            @endif
                                        @endforeach
                                    </small>
                                </div>
                                <img class="w-25 h-25 clearfix rounded-circle border border-white"
                                    style="border-width: 3px !important;margin-bottom: -3rem;clear: both;"
                                    src="{{ asset('storage/' . $quests->image) }}" alt="users">
                            </div>
                            <div class="card-body text-center d-flex flex-row justify-content-between pt-4 mt-4">
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
                                <small>Quest akan berakhir : {{ $quests->batas_waktu }}</small>
                            </div>
                            <div class="card-footer">
                                <small></small>
                                <br>
                                <div class="text-center">
                                    {{-- <a class="btn btn-success" href="#">Ambil Quest</a> --}}

                                    {{-- @if ($orderq->isHasOrderQuest($quests->id))
                                        <small class="text-info">Quest sudah ditambahkan</small>
                                    @else --}}
                                        <form
                                            onsubmit="return confirm('Tambah this id {{ $quests->id }} Skill  {{ $quests->name }} ke user?')"
                                            method="POST" action="{{ route('orderq.tambahOrderQuest', [$quests->id]) }}"
                                            class="d-inline">

                                            @csrf

                                            <input type="submit" value="Tambah" class="btn btn-primary" />
                                        </form>
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
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
