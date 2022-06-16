@extends('layouts.global')

@section('title')
    Detail Skill
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
                @foreach ($skill as $skills)
                    <h2>Artikel Skill : {{ $skills->judul }}</h2>
                @endforeach
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <hr class="my-3">
                </div>
            </div>

            <div class="row-fluid">
                @foreach ($skill as $skills)
                    @foreach ($skills->artikel as $artikels)
                        <div class="card mb-3" style="max-width: 1080px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{ asset('storage/' . $artikels->image) }}" class="card-img"
                                        alt="{{ $artikels->image }}">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><a
                                                href="{{ route('artikel.lihatArtikel', [$artikels->slug]) }}">{{ $artikels->title }}</a>
                                        </h5>
                                        <p class="card-text"><small class="text-muted">Published By {{ $artikels->user->name }}</small></p>
                                        <p class="card-text">{!! Str::words($artikels->konten, 30, '...') !!}</p>
                                        <p class="card-text"><small class="text-muted">Posted at
                                                {{ $artikels->created_at }}</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex justify-content-start">
                {!! $skill->links() !!}
            </div>
        </div>
    </div>
@endsection
