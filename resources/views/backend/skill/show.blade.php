@extends('layouts.global')

@section('title')
    Detail Skill
@endsection

@section('dashboard-active')
    active
@endsection

@section('da-collapse-in')
    in
@endsection

@section('dash-skill-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Manajemen Skill</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item"> <a href="{{ route('skill.index') }}">Manajemen Skill</a> </li>
                    <li class="breadcrumb-item"> <a href="{{ route('skill.show', [$skills->id]) }}">{{ $skills->judul }}</a> </li>
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
                </div>
            </div>
            <div class="card">
                <div class="m-3">
                    <h5>Informasi</h5>
                    <hr>

                    <div class="row m-2">
                        <div class="col-lg-4 col-md-12">
                            <a href="{{ route('skill.showQuestBySkill', $skills->id) }}" class="btn btn-block btn-danger" style="">Quest</a>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <a href="{{ route('skill.showSiswaBySkill', $skills->id) }}" class="btn btn-block btn-primary">Siswa</a>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <a href="{{ route('skill.showPengajarBySkill', $skills->id) }}" class="btn btn-block btn-info">Pengajar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
