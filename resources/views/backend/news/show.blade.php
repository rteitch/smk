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
        <div class="row no-gutters">
            <div class="card col-md-4">
                <img src="{{ asset('storage/' . $skills->image) }}" class="card-img p-2" alt="...">
            </div>
            <div class="card col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $skills->judul }}</h5>
                    <p><strong>Job Class : </strong>
                        @foreach ($skills->jobclass as $jobclass)
                            <a
                                href="{{ route('jobclass.show', $jobclass->id) }}">{{ $jobclass->name }}</a>,
                        @endforeach
                    </p>
                    <p class="card-text">{{ $skills->deskripsi }}</p>
                    <p class="card-text"><small class="text-muted">{{ $skills->slug }}</small></p>
                    <b>Pergi Ke :</b>
                    <div class="row m-2">
                        <div class="col-6 mb-2">
                            <a href="#" class="btn btn-block btn-danger" style="">Quest</a>
                        </div>
                        <div class="col-6 mb-2">
                            <a href="#" class="btn btn-block btn-primary">Siswa</a>
                        </div>
                        <div class="col-6 mb-2">
                            <a href="#" class="btn btn-block btn-info">Pengajar</a>
                        </div>
                        <div class="col-6 mb-2">
                            <a href="#" class="btn btn-block btn-warning">News</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
