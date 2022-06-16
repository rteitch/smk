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
                                            {{ $jobclasses->pembuat }}
                                        </small></p>
                                    <p class="card-text">{!! Str::words($jobclasses->deskripsi, 30, '...') !!}</p>
                                    <p class="card-text"><small class="text-muted">Posted at
                                            {{ $jobclasses->created_at }}</small>
                                    </p>
                                </div>
                                <div class="card-footer">
                                    @foreach (\Auth::user()->jobclass as $job)
                                        <form
                                            onsubmit="return confirm('Tambah this jobclass  {{ $jobclasses->name }} ke user?')"
                                            method="POST" action="{{ route('user.tambahJobClass', [$jobclasses->id]) }}"
                                            class="d-inline">

                                            @csrf

                                            <input
                                                type="{{ $job->pivot->job_class_id !== $jobclasses->id ? 'submit' : 'hidden' }}"
                                                value="Tambah" class="btn btn-primary" />
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div>
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
