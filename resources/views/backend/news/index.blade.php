@extends('layouts.global')

@section('title')
    Quest List
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('news.index') }}">

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
                            <a class="nav-link {{ Request::get('status') == null && Request::path() == 'news' ? 'active' : '' }}"
                                href="{{ route('news.index') }}">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::get('status') == 'publish' ? 'active' : '' }}"
                                href="{{ route('news.index', ['status' => 'publish']) }}">Publish</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::get('status') == 'draft' ? 'active' : '' }}"
                                href="{{ route('news.index', ['status' => 'draft']) }}">Draft</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() == 'news/trash' ? 'active' : '' }}"
                                href="{{ route('news.trash') }}">Trash</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12 text-right">
                    <a href="{{ route('news.create') }}" class="btn btn-primary">Create Quest</a>
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
                        @foreach ($news as $index => $berita)
                            <tr>
                                <td>{{ $index +1 }}</td>
                                <td>{{ $berita->title }}</td>
                                <td>
                                    @foreach ($berita->skill as $skills)
                                        {{ $skills->judul }}
                                    @endforeach
                                </td>
                                <td>{!! $berita->konten !!}</td>
                                <td>
                                    @if ($berita->status == 'DRAFT')
                                        <span class="badge bg-dark text-white">{{ $berita->status }}</span>
                                    @else
                                        <span class="badge badge-success">{{ $berita->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('news.edit', [$berita->id]) }}" class="btn btn-info btn-sm"> Edit
                                    </a>
                                    <a href="{{ route('news.show', [$skills->id]) }}"
                                        class="btn btn-primary btn-sm"> <span class="oi oi-eye"></span></a>
                                    <form method="POST" class="d-inline"
                                        onsubmit="return confirm('Move quest to trash?')"
                                        action="{{ route('news.destroy', [$berita->id]) }}">

                                        @csrf
                                        <input type="hidden" value="DELETE" name="_method">

                                        <input type="submit" value="Trash" class="btn btn-danger btn-sm">

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-12">
                <div class="d-flex justify-content-start">
                    {!! $news->links() !!}
                </div>
            </div>

        </div>
    </div>
@endsection
