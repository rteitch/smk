@extends('layouts.global')

@section('title')
    Quest List
@endsection

@section('dashboard-active')
    active
@endsection

@section('da-collapse-in')
    in
@endsection

@section('dash-quest-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Manajemen Quest</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('quest.index') }}">Manajemen Quest</a> </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('quest.index') }}">

                                <div class="input-group">
                                    <input name="keyword" type="text" value="{{ Request::get('keyword') }}"
                                        class="form-control" placeholder="Filter by title">
                                    <div class="input-group-append">
                                        <input type="submit" value="Filter" class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
                            <br>
                        </div>
                        <div class="col-md-4">
                            <ul class="nav nav-pills card-header-pills">
                                <li class="nav-item mr-2 text-white">
                                    <a class="nav-link {{ Request::get('status') == null && Request::path() == 'quest' ? 'active' : '' }}"
                                        href="{{ route('quest.index') }}">All</a>
                                </li>
                                <li class="nav-item mr-2 text-white">
                                    <a class="nav-link {{ Request::get('status') == 'publish' ? 'active' : '' }}"
                                        href="{{ route('quest.index', ['status' => 'publish']) }}">Publish</a>
                                </li>
                                <li class="nav-item mr-2 text-white">
                                    <a class="nav-link {{ Request::get('status') == 'draft' ? 'active' : '' }}"
                                        href="{{ route('quest.index', ['status' => 'draft']) }}">Draft</a>
                                </li>
                                <li class="nav-item text-white">
                                    <a class="nav-link {{ Request::path() == 'quest/trash' ? 'active' : '' }}"
                                        href="{{ route('quest.trash') }}">Trash</a>
                                </li>
                            </ul>
                            <br>
                        </div>
                    </div>

                    <hr class="my-3">
                    <div class="row mb-3">
                        <div class="col-md-12 text-right">
                            <a href="{{ route('quest.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                                Tambah Quest</a>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped">
                            <thead>
                                <tr>
                                    <th scope="col"><b>Image</b></th>
                                    <th scope="col"><b>Judul</b></th>
                                    <th scope="col"><b>Pembuat</b></th>
                                    <th scope="col"><b>Batas Waktu</b></th>
                                    <th scope="col"><b>Skill</b></th>
                                    <th scope="col"><b>Jenis Soal</b></th>
                                    <th scope="col"><b>Kesulitan</b></th>
                                    <th scope="col"><b>Status</b></th>
                                    <th scope="col"><b>Action</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quests as $quest)
                                    <tr>
                                        <td>
                                            @if ($quest->image)
                                                <img src="{{ asset('storage/' . $quest->image) }}" width="96px" />
                                            @endif
                                        </td>
                                        <td>{{ $quest->judul }}</td>
                                        <td>{{ $quest->pembuat }}</td>
                                        <td>{{ $quest->batas_waktu }}</td>
                                        <td>
                                            <ul class="pl-3">
                                                @foreach ($quest->skill as $skill)
                                                    <li>{{ $skill->judul }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{ $quest->jenis_soal }}</td>
                                        <td>{{ $quest->kesulitan }}
                                        </td>
                                        <td>
                                            @if ($quest->status == 'DRAFT')
                                                <span class="badge bg-dark text-white">{{ $quest->status }}</span>
                                            @else
                                                <span class="badge badge-success">{{ $quest->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('quest.edit', [$quest->id]) }}"
                                                class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                            </a>
                                            <form method="POST" class="d-inline"
                                                onsubmit="return confirm('Move quest to trash?')"
                                                action="{{ route('quest.destroy', [$quest->id]) }}">

                                                @csrf
                                                <input type="hidden" value="DELETE" name="_method">

                                                <button type="submit" class="btn btn-danger btn-sm"><span
                                                    class="fa fa-trash-o"></span></button>

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <div class="d-flex justify-content-start">
                            {!! $quests->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
