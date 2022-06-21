@extends('layouts.global')

@section('title')
    Detail Reward
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
                <h2>Reward Available</h2>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <hr class="my-3">
                </div>
            </div>

            <div class="row">
                @foreach ($reward as $index => $rewards)
                    <div class="col-md-12 col-lg-4 mb-2 d-flex align-items-stretch">
                        <div class="card">
                            <div class="card-header bg-info text-center text-light border-0"
                                style="background-image: url(assets/matthieu-a-262686-unsplash.jpg); background-size: 100%">
                                <div class="text-left w-100">
                                    <h5 class="m-0">{{ $index + 1 }}. {{ $rewards->title }}</h5>
                                    <small>Pembuat :
                                        {{ $user->where('id', $rewards->created_by)->first()->name }}
                                    </small>
                                </div>
                                <img class="clearfix rounded-circle border border-white w-25"
                                    style="border-width: 3px !important;margin-bottom: -3rem;clear: both;"
                                    src="{{ asset('storage/' . $rewards->image) }}" alt="users">
                            </div>
                            <div class="card-body text-center d-flex flex-row justify-content-between pt-4 mt-4">
                                <div class="col text-align border-right border-left">
                                    <h6 class="fw-bold m-0">{{ $rewards->syarat_skor }}</h6>
                                    <small>Syarat Skor</small>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-center">
                                    {{-- <a class="btn btn-success" href="#">Ambil Quest</a> --}}

                                    {{-- @if ($orderq->isHasQuest($rewards->id))
                                        <small class="text-info">Quest sudah ditambahkan</small>
                                    @else --}}
                                    <form
                                        onsubmit="return confirm('Tukar this id {{ $rewards->id }} reward  {{ $rewards->name }}?')"
                                        method="POST" action="{{ route('orderr.tukarOrderReward', [$rewards->id]) }}"
                                        class="d-inline">

                                        @csrf

                                        <input type="submit" value="Tukar" class="btn btn-primary" />
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
                {!! $reward->links() !!}
            </div>
        </div>
    </div>
@endsection
