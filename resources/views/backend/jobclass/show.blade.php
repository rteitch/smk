@extends('layouts.global')

@section('title')
    Detail Job Class
@endsection

@section('dashboard-active')
    active
@endsection

@section('da-collapse-in')
    in
@endsection

@section('dash-jobclass-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Manajemen Jobclass</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item"> <a href="{{ route('jobclass.index') }}">Manajemen Jobclass</a> </li>
                    <li class="breadcrumb-item active"> <a href="{{ route('jobclass.show', [$jobclass->id]) }}"> {{ $jobclass->name }}</a> </li>
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
        <div class="row no-gutters">
            <div class="card col-md-4">
                <img src="{{ asset('storage/' . $jobclass->image) }}" class="card-img p-2" alt="...">
            </div>
            <div class="card col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $jobclass->name }}</h5>
                    <p class="card-text">{{ $jobclass->deskripsi }}</p>
                    <p class="card-text"><small class="text-muted">{{ $jobclass->slug }}</small></p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <span>Jumlah Skill</span>
                            <a href="#" class="mt-1 float-right badge badge-primary">{{ $jobclass->skill->count() }}</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="m-3">
                    <h5>Informasi</h5>
                    <hr>

                    <div class="row m-2">
                        <div class="col-lg-3 col-md-12">
                            <a href="{{ route('skill.index') }}" class="btn btn-block btn-danger" style="">Kumpulan Skill</a>
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <a href="#" class="btn btn-block btn-primary">Quest</a>
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <a href="#" class="btn btn-block btn-info">Pengajar</a>
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <a href="#" class="btn btn-block btn-warning">Siswa</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
