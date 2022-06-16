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
                @foreach ($skill_jobclass as $skills)
                    <h2>Judul Skill : {{ $skills->judul }}</h2>
                @endforeach
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <hr class="my-3">
                </div>
            </div>

            <div class="row-fluid">
                @foreach ($skill_jobclass as $skills)
                    <div class="card mb-3" style="max-width: 1080px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' . $skills->image) }}" class="card-img"
                                    alt="{{ $skills->image }}">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">
                                    {{ $skills->judul }}
                                    </h5>
                                    <p class="card-text">
                                        {{ $skills->deskripsi }}
                                    </p>
                                    <p class="card-text"><small class="text-muted">Published By
                                            {{ $skills->pembuat }}</small></p>
                                    <p class="card-text">{!! Str::words($skills->konten, 30, '...') !!}</p>
                                    <p class="card-text"><small class="text-muted">Diresmikan pada :
                                            {{ $skills->created_at }}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        {{-- <div class="col-md-12">
            <div class="d-flex justify-content-start">
                {!! $skill_jobclass->links() !!}
            </div>
        </div> --}}
    </div>
@endsection
