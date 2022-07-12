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
                    <li class="breadcrumb-item"> <a
                            href="{{ route('skill.show', [$skills->id]) }}">{{ $skills->judul }}</a> </li>
                    <li class="breadcrumb-item"> <a href="{{ route('skill.showSiswaBySkill', [$skills->id]) }}">Siswa</a>
                    </li>
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
            <div class="card">
                <div class="m-3">
                    <h5>Informasi Siswa</h5>
                    <hr>

                    <div class="row m-2">
                        {{-- <div class="col-lg-4 col-md-12">
                            <a href="{{ route('skill.showQuestBySkill', $skills->id) }}" class="btn btn-block btn-danger" style="">Quest</a>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <a href="#" class="btn btn-block btn-primary">Siswa</a>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <a href="#" class="btn btn-block btn-info">Pengajar</a>
                        </div> --}}

                        <div class="container">
                            <div class="row bg-white p-3 border-">
                                <div class="col-lg-12 col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-stripped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th class="scope">Foto</th>
                                                    <th class="scope">Nama</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user as $index => $users)
                                                        @if ($users->isHasSkill($skills->id))
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>
                                                                    @if ($users->avatar)
                                                                        <img src="{{ asset('storage/' . $users->avatar) }}"
                                                                            alt="avatar_{{ $users->name }}"
                                                                            width="70px">
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </td>
                                                                <td>{{ $users->name }}
                                                                </td>
                                                            </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
