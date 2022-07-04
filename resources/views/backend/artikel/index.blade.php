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

@section('dash-artikel-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Manajemen Artikel</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('quest.trash') }}">Manajemen Artikel</a> </li>
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
                        <div class="col-lg-6 col-md-12">
                            <form action="{{ route('artikel.index') }}">

                                <div class="input-group">
                                    <input name="keyword" type="text" value="{{ Request::get('keyword') }}"
                                        class="form-control" placeholder="Filter by title">
                                    <div class="input-group-append">
                                        <input type="submit" value="Filter" class="btn btn-primary">
                                    </div>
                                </div>
                                <br>
                            </form>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <ul class="nav nav-pills card-header-pills">
                                <li class="nav-item text-white mr-3">
                                    <a class="nav-link {{ Request::get('status') == null && Request::path() == 'artikel' ? 'active' : '' }}"
                                        href="{{ route('artikel.index') }}">All</a>
                                </li>
                                <li class="nav-item text-white mr-3">
                                    <a class="nav-link {{ Request::get('status') == 'publish' ? 'active' : '' }}"
                                        href="{{ route('artikel.index', ['status' => 'publish']) }}">Publish</a>
                                </li>
                                <li class="nav-item text-white mr-3">
                                    <a class="nav-link {{ Request::get('status') == 'draft' ? 'active' : '' }}"
                                        href="{{ route('artikel.index', ['status' => 'draft']) }}">Draft</a>
                                </li>
                                <li class="nav-item text-white mr-3">
                                    <a class="nav-link {{ Request::path() == 'quest/trash' ? 'active' : '' }}"
                                        href="{{ route('artikel.trash') }}">Trash</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-12 text-right">
                            <a href="{{ route('artikel.create') }}" class="btn btn-primary">Create Artikel</a>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped">
                            <thead>
                                <tr>
                                    <th scope="col"><b>#</b></th>
                                    <th scope="col"><b>Judul</b></th>
                                    <th scope="col"><b>Kategori</b></th>
                                    <th scope="col"><b>Status</b></th>
                                    <th scope="col"><b>Action</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($artikel as $index => $artikels)
                                    <!-- Modal -->
                                    <div id="myModal{{ $artikels->id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-lg">

                                            <!-- Modal view artikel-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id=""><small>View Artikel
                                                        </small></h3>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="mb-2">
                                                            <div class="card bg-white border-0 shadow-sm">
                                                                <div class="card-header bg-white border-light">
                                                                    <div class="media">
                                                                        <img style="width: 48px" class="mr-3 rounded-circle"
                                                                            src="{{ asset('storage/' . $artikels->user->avatar) }}"
                                                                            alt="#">
                                                                        <div class="media-body">
                                                                            <h6 class="text-indigo m-0">
                                                                                {{ $artikels->user->name }}</h6>
                                                                            <small class="text-muted">Posted at
                                                                                {{ $artikels->created_at }} |</small>
                                                                            <small>Tags :
                                                                                @foreach ($artikels->skill as $skills)
                                                                                    <a
                                                                                        href="{{ route('skill.show', $skills->id) }}">{{ $skills->judul }}</a>,
                                                                                @endforeach
                                                                            </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="text-center">
                                                                        <img class="img-thumbnail mb-2 "
                                                                            src="{{ asset('storage/' . $artikels->image) }}"
                                                                            alt="image post" width="720px"><br>
                                                                    </div>
                                                                    <p class="fs-smaller">
                                                                        {!! $artikels->konten !!}
                                                                    </p>
                                                                </div>

                                                                <div class="card-footer">
                                                                    <div>
                                                                        Download File Pendukung :
                                                                        <a class="btn btn-success btn-sm"
                                                                            href="{{ asset('storage/' . $artikels->file_pendukung) }}"
                                                                            download>Download</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $artikels->title }}</td>
                                        <td>
                                            @foreach ($artikels->skill as $skill)
                                                {{ $skill->judul }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($artikels->status == 'DRAFT')
                                                <span class="badge bg-dark text-white">{{ $artikels->status }}</span>
                                            @else
                                                <span class="badge badge-success">{{ $artikels->status }}</span>
                                            @endif
                                        </td>
                                        <td>

                                            <!-- Trigger the modal with a button -->
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#myModal{{ $artikels->id }}"><span class="fa fa-eye"></span>
                                            </button>
                                            <a href="{{ route('artikel.edit', [$artikels->id]) }}"
                                                class="btn btn-info btn-sm">
                                                <span class="fa fa-edit"></span>
                                            </a>
                                            <form method="POST" class="d-inline"
                                                onsubmit="return confirm('Move artikel to trash?')"
                                                action="{{ route('artikel.destroy', [$artikels->id]) }}">

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
                            {!! $artikel->links() !!}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
