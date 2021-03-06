@extends('layouts.global')

@section('title')
    Artikel
@endsection

@section('artikel-active')
    active
@endsection


@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Artikel</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Artikel</li>
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
                <h2>Artikel Update</h2>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <hr class="my-3">
                </div>
            </div>
            <div class="row-fluid">
                @foreach ($artikel as $artikels)
                    <div class="card mb-3" style="max-width: 1080px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' . $artikels->image) }}" class="card-img" alt="{{ $artikels->title }}">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="{{ route('artikel.lihatArtikel', [$artikels->slug]) }}">{{ $artikels->title }}</a></h5>
                                    <p class="card-text"><small class="text-muted">Published By {{ $artikels->user->name }}</small></p>
                                    {{-- <p class="card-text">{!! Str::words($artikels->konten, 30, '...') !!}</p> --}}
                                    <p class="card-text"><small class="text-muted">Posted at {{ $artikels->created_at }}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex justify-content-start">
                {!! $artikel->links() !!}
            </div>
        </div>
    </div>
@endsection
