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
        <a class="btn btn-info" href="{{ route('jobclass.published') }}">
            < Kembali</a>
                <br><br>
                <div class="mb-2">
                    <div class="card bg-white border-0 shadow-sm">
                        <div class="card-header bg-white border-light">

                            @foreach ($jobclasses->user as $users)
                                <div class="media">

                                    @if ($jobclasses->created_by == $users->id)
                                        <img style="width: 48px" class="mr-3 rounded-circle"
                                            src="{{ asset('storage/' . $users->avatar) }}" alt="#">
                                        {{-- {{ $jobclass->user->name }} --}}

                                        <div class="media-body">
                                            <h6 class="text-indigo m-0">
                                                {{ $users->name }}
                                            </h6>
                                            <small class="text-muted">Diresmikan pada {{ $jobclasses->created_at }}
                                            </small>
                                        </div>
                                </div>
                            @endif
                            @endforeach
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                            </div>
                            <div class="text-center">
                                <img class="img-thumbnail mb-2 " src="{{ asset('storage/' . $jobclasses->image) }}"
                                    alt="image post" width="360px"><br>
                            </div>
                            <p class="fs-smaller">
                                {!! $jobclasses->deskripsi !!}
                            </p>
                            <div class="card-footer">
                                Skill Tersedia :
                                    @foreach ($jobclasses->skill as $skills)
                                        <a
                                            href="{{ route('jobclass.skillJobClass', $skills->slug) }}">{{ $skills->judul }}</a>,
                                    @endforeach

                            </div>
                        </div>
                    </div>
                </div>
    </div>
@endsection
