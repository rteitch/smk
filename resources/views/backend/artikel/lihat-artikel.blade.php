@extends('layouts.global')

@section('title')
    Detail Artikel
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
                    <li class="breadcrumb-item"><a href="{{ route('artikel.published') }}"></a> Artikel</li>
                    <li class="breadcrumb-item active"><a href="{{ route('artikel.lihatArtikel', [$artikel->slug]) }}">{{ $artikel->title }}</a></li>
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
        {{-- <a class="btn btn-info mt-3" href="{{ route('artikel.published') }}">
            < Kembali</a>
                <br><br> --}}
                <div class="mb-2">
                    <div class="card bg-white border-0 shadow-sm">
                        <div class="card-header bg-white border-light">
                            <div class="media">
                                <img style="width: 48px" class="mr-3 rounded-circle"
                                    src="{{ asset('storage/' . $artikel->user->avatar) }}" alt="#">
                                <div class="media-body">
                                    <h6 class="text-indigo m-0">
                                        {{ $artikel->user->name }}</h6>
                                    <small class="text-muted">Posted at {{ $artikel->created_at }} |</small>
                                    <small>Tags :
                                        @foreach ($artikel->skill as $skills)
                                            <a href="{{ route('artikel.skill', $skills->slug) }}">{{ $skills->judul }}</a>,
                                        @endforeach
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <h2>{{ $artikel->title }}</h2>
                            </div>
                            <div class="text-center">
                                <img class="img-thumbnail mb-2 " src="{{ asset('storage/' . $artikel->image) }}"
                                    alt="image post" width="720px"><br>
                            </div>
                            <p class="fs-smaller">
                                {!! $artikel->konten !!}
                            </p>
                        </div>
                        <div class="card-footer">
                            @if ($artikel->file_pendukung == null)
                                <div>
                                    tidak ada file pendukung...
                                </div>
                            @else
                                <div>
                                    Download File Pendukung :
                                    <a class="btn btn-success btn-sm"
                                        href="{{ asset('storage/' . $artikel->file_pendukung) }}" download>Download</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
    </div>
@endsection
