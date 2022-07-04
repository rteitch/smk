@extends('layouts.global')

@section('title')
    Trashed Job Class
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
                    <li class="breadcrumb-item active"> <a href="{{ route('jobclass.trash') }}">Trash </a> </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
    </div>
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
                <div class="col-md-6">
                    <form action="{{ route('jobclass.trash') }}">

                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Masukkan kata untuk mencari Job Class"
                                value="{{ Request::get('name') }}" name="name">

                            <div class="input-group-append">
                                <input type="submit" value="Filter" class="btn btn-primary">
                            </div>
                        </div>

                    </form>
                </div>

                <div class="col-md-6">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link text-white mr-2" href="{{ route('jobclass.index') }}">Published</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('jobclass.trash') }}">Trash</a>
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
                                <th>Nama</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobclass as $jobc)
                                <tr>
                                    <td>{{ $jobc->name }}</td>
                                    <td>
                                        @if ($jobc->image)
                                            <img src="{{ asset('storage/' . $jobc->image) }}" width="48px" />
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('jobclass.restore', [$jobc->id]) }}"
                                            class="btn btn-success">Restore</a>
                                        <form class="d-inline"
                                            action="{{ route('jobclass.delete-permanent', [$jobc->id]) }}" method="POST"
                                            onsubmit="return confirm('Delete this jobclass {{ $jobc->name }} permanently?')">

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
                                    {{ $jobclass->appends(Request::all())->links() }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
