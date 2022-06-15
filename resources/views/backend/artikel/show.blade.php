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
        <a class="btn btn-info" href="{{ route('artikel.index') }}">
            < Kembali</a>
                <br><br>
                <div class="row">
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
                                                <a
                                                    href="{{ route('skill.show', $skills->id) }}">{{ $skills->judul }}</a>,
                                            @endforeach
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <img class="img-fluid mb-2 " src="{{ asset('storage/' . $artikel->image) }}"
                                        alt="image post" width="90%"><br>
                                </div>
                                <p class="fs-smaller">
                                    {!! $artikel->konten !!}
                                </p>
                            </div>

                            <div class="card-footer">
                                <div>
                                    Download File Pendukung :
                                    <a class="btn btn-success btn-sm" href="{{ asset('storage/' . $artikel->file_pendukung) }}" download>Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
@endsection
