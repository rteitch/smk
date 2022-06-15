@extends('layouts.global')

@section('title')
    Trashed Artikel
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('artikel.index') }}">

                        <div class="input-group">
                            <input name="keyword" type="text" value="{{ Request::get('keyword') }}" class="form-control"
                                placeholder="Filter by title">
                            <div class="input-group-append">
                                <input type="submit" value="Filter" class="btn btn-primary">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="col-md-6">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('artikel.index') }}">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('artikel.index', ['status' => 'publish']) }}">Publish</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('artikel.index', ['status' => 'draft']) }}">Draft</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() == 'artikel/trash' ? 'active' : '' }}" href="{{ route('artikel.trash') }}">Trash</a>
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="my-3">
            <div class="row mb-3">
                <div class="col-md-12 text-right">
                    <a href="{{ route('artikel.create') }}" class="btn btn-primary">Create Artikel</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-stripped">
                    <thead>
                        <tr>
                            <th scope="col"><b>#</b></th>
                            <th scope="col"><b>Judul</b></th>
                            <th scope="col"><b>Kategori Skill</b></th>
                            <th scope="col"><b>Konten</b></th>
                            <th scope="col"><b>Status</b></th>
                            <th scope="col"><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($artikel as $index => $artikels)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $artikels->title }}</td>
                                <td>
                                    @foreach ($artikels->skill as $skill)
                                        {{ $skill->judul }}
                                    @endforeach
                                </td>
                                <td>
                                    {!! Str::words($artikels->konten, 30, '...') !!}
                                </td>
                                <td>
                                    @if ($artikels->status == 'DRAFT')
                                        <span class="badge bg-dark text-white">{{ $artikels->status }}</span>
                                    @else
                                        <span class="badge badge-success">{{ $artikels->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('artikel.restore', [$artikels->id]) }}"
                                        class="d-inline">

                                        @csrf

                                        <input type="submit" value="Restore" class="btn btn-success" />
                                    </form>
                                    <form method="POST" action="{{ route('artikel.delete-permanent', [$artikels->id]) }}"
                                        class="d-inline" onsubmit="return confirm('Delete this artikel permanently?')">

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
                    {!! $artikel->links() !!}
                </div>
            </div>

        </div>
    </div>
@endsection
