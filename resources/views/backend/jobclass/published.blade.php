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
                <h2>Jobclass Update</h2>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <hr class="my-3">
                </div>
            </div>
            <div class="row-fluid">
                @foreach ($jobclass as $jobclasses)
                    <div class="card mb-3" style="max-width: 1080px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' . $jobclasses->image) }}" class="card-img"
                                    alt="{{ $jobclasses->name }}">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><a
                                            href="{{ route('jobclass.lihatJobClass', [$jobclasses->slug]) }}">{{ $jobclasses->name }}</a>
                                    </h5>
                                    <p class="card-text"><small class="text-muted">Published By : -
                                    </small></p>
                                    <p class="card-text">{!! Str::words($jobclasses->deskripsi, 30, '...') !!}</p>
                                    <p class="card-text"><small class="text-muted">Posted at
                                            {{ $jobclasses->created_at }}</small>
                                    </p>
                                </div>
                                <div class="card-footer">
                                    {{-- <form class="d-inline" action="{{ route('jobclass.tambahJobClass', [$jobclasses->id]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah yakin ingin mendaftar jobclass {{ $jobclasses->name }} to identitas pemain?')">

                                        @csrf

                                        <input type="hidden" value="GET" name="_method">
                                        <button type="submit" class="btn btn-success btn-sm"><span
                                                class="oi oi-plus"></span> Mendaftarkan Job
                                                Class</button>
                                        <input type="submit" class="btn btn-danger btn-sm" value="Trash">

                                    </form> --}}
                                    <a class="btn btn-primary"
                                        href="{{ route('jobclass.tambahJobClass', [$jobclasses->id]) }}">Mendaftar Job
                                        Class</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex justify-content-start">
                {!! $jobclass->links() !!}
            </div>
        </div>
    </div>
@endsection
