@extends('layouts.global')

@section('title')
    Detail Job Class
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
                <img src="{{ asset('storage/' . $jobclass->image) }}" class="card-img p-2" alt="...">
            </div>
            <div class="card col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $jobclass->name }}</h5>
                    <p class="card-text">{{ $jobclass->deskripsi }}</p>
                    <p class="card-text"><small class="text-muted">{{ $jobclass->slug }}</small></p>
                    <b>Pergi Ke :</b>
                    <div class="row m-2">
                        <div class="col-6 mb-2">
                            <a href="#" class="btn btn-block btn-danger" style="">Kumpulan Skill</a>
                        </div>
                        <div class="col-6 mb-2">
                            <a href="#" class="btn btn-block btn-primary">Quest</a>
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
