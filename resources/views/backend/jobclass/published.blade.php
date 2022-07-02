@extends('layouts.global')

@section('title')
    Detail Skill
@endsection

@section('ga-active')
    active
@endsection

@section('ga-collapse-in')
    in
@endsection

@section('ga-jobclass')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Job Class</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Guild Adventure</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('jobclass.published') }}">Job Class</a> </li>
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
        @elseif (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
        <div>
            <div class="col-12 col-sm-12">
                <h2>Jobclass Ready</h2>
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
                                    @if ($user->isHasJobclass($jobclasses->id))
                                        <small class="text-info">Job Class sudah ditambahkan</small>
                                        <form
                                            onsubmit="return confirm('Membatalkan quest kode {{ $jobclasses->name }}?')"
                                            class="d-inline" action="{{ route('user.hapusUserJobClass', [$jobclasses->id]) }}"
                                            method="POST">

                                            @csrf

                                            <button type="submit" class="btn btn-danger btn-sm"><span
                                                    class="fa fa-trash"></span></button>
                                            {{-- <input type="submit" value="Delete" class="btn btn-danger btn-sm"> --}}

                                        </form>
                                    @else
                                        <form
                                            onsubmit="return confirm('Tambah this id {{ $jobclasses->id }} jobclass  {{ $jobclasses->name }} ke user?')"
                                            method="POST" action="{{ route('user.tambahJobClass', [$jobclasses->id]) }}"
                                            class="d-inline">

                                            @csrf

                                            <input type="submit" value="Tambah" class="btn btn-primary" />
                                        </form>
                                    @endif

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
