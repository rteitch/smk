@extends('layouts.global')

@section('title')
    Trashed Reward
@endsection

@section('dashboard-active')
    active
@endsection

@section('da-collapse-in')
    in
@endsection

@section('dash-reward-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Manajemen Reward</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item"> <a href="{{ route('reward.index') }}">Manajemen Reward</a> </li>
                    <li class="breadcrumb-item active"> <a href="{{ route('reward.trash') }}">Trash</a> </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <form action="{{ route('reward.index') }}">

                                <div class="input-group">
                                    <input name="keyword" type="text" value="{{ Request::get('keyword') }}"
                                        class="form-control" placeholder="Masukkan kata untuk mencari Reward">
                                    <div class="input-group-append">
                                        <input type="submit" value="Filter" class="btn btn-primary">
                                    </div>
                                </div>

                            </form>
                            <br>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <ul class="nav nav-pills card-header-pills">
                                <li class="nav-item text-white mr-2">
                                    <a class="nav-link" href="{{ route('reward.index') }}">All</a>
                                </li>
                                <li class="nav-item text-white mr-2">
                                    <a class="nav-link"
                                        href="{{ route('reward.index', ['status' => 'publish']) }}">Publish</a>
                                </li>
                                <li class="nav-item text-white mr-2">
                                    <a class="nav-link"
                                        href="{{ route('reward.index', ['status' => 'draft']) }}">Draft</a>
                                </li>
                                <li class="nav-item text-white mr-2">
                                    <a class="nav-link {{ Request::path() == 'reward/trash' ? 'active' : '' }}"
                                        href="{{ route('reward.trash') }}">Trash</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <hr class="my-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped">
                            <thead>
                                <tr>
                                    <th scope="col"><b>#</b></th>
                                    <th scope="col"><b>Judul</b></th>
                                    <th scope="col"><b>Image</b></th>
                                    <th scope="col"><b>Pembuat</b></th>
                                    <th scope="col"><b>Syarat Skor</b></th>
                                    <th scope="col"><b>Status</b></th>
                                    <th scope="col"><b>Action</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reward as $index => $rewards)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $rewards->title }}</td>
                                        <td>
                                            @if ($rewards->image)
                                                <img src="{{ asset('storage/' . $rewards->image) }}" width="96px" />
                                            @endif
                                        </td>
                                        <td>{{ $rewards->pembuat }}</td>
                                        <td>{{ $rewards->syarat_skor }}</td>
                                        <td>
                                            @if ($rewards->status == 'DRAFT')
                                                <span class="badge bg-dark text-white">{{ $rewards->status }}</span>
                                            @else
                                                <span class="badge badge-success">{{ $rewards->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('reward.restore', [$rewards->id]) }}"
                                                class="d-inline">

                                                @csrf

                                                <input type="submit" value="Restore" class="btn btn-success" />
                                            </form>
                                            <form method="POST"
                                                action="{{ route('reward.delete-permanent', [$rewards->id]) }}"
                                                class="d-inline"
                                                onsubmit="return confirm('Delete this reward permanently?')">

                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">

                                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="d-flex justify-content-start">
                            {!! $reward->links() !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
