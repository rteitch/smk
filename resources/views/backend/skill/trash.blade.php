@extends('layouts.global')

@section('title')
    Trashed Skill
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
                    <li class="breadcrumb-item active"> <a href="{{ route('skill.trash') }}">Trash</a> </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
    </div>

    <style>
        .select2 {
            width: 100% !important;
        }
    </style>
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mt-3">
                    <form action="{{ route('skill.trash') }}">

                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Masukkan kata untuk mencari Skill"
                                name="judul">

                            <div class="input-group-append">
                                <input type="submit" value="Filter" class="btn btn-primary">
                            </div>
                        </div>

                    </form>
                </div>
                <br>
                <div class="col-md-6 mt-3">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item text-white mr-2">
                            <a class="nav-link" href="{{ route('skill.index') }}">Published</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('skill.trash') }}">Trash</a>
                        </li>
                    </ul>
                </div>

            </div>

            <hr class="my-3">

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($skills as $skill)
                                <tr>
                                    <td>{{ $skill->judul }}</td>
                                    <td>
                                        @if ($skill->image)
                                            <img src="{{ asset('storage/' . $skill->image) }}" width="48px" />
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('skill.restore', [$skill->id]) }}"
                                            class="btn btn-success">Restore</a>
                                        <form class="d-inline"
                                            action="{{ route('skill.delete-permanent', [$skill->id]) }}" method="POST"
                                            onsubmit="return confirm('Delete this skill {{ $skill->judul }} permanently?')">

                                            @csrf

                                            <input type="hidden" name="_method" value="DELETE" />

                                            <input type="submit" class="btn btn-danger btn-sm" value="Delete" />

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colSpan="10">
                                    {{ $skills->appends(Request::all())->links() }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
