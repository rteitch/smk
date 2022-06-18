@extends('layouts.global')

@section('title')
    Trashed Quests
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
                    <form action="{{ route('quest.index') }}">

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
                            <a class="nav-link" href="{{ route('quest.index') }}">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('quest.index', ['status' => 'publish']) }}">Publish</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('quest.index', ['status' => 'draft']) }}">Draft</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() == 'quest/trash' ? 'active' : '' }}"
                                href="{{ route('quest.trash') }}">Trash</a>
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="my-3">
            <div class="row mb-3">
                <div class="col-md-12 text-right">
                    <a href="{{ route('quest.create') }}" class="btn btn-primary">Create Quest</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-stripped">
                    <thead>
                        <tr>
                            <th scope="col"><b>Image</b></th>
                            <th scope="col"><b>Judul</b></th>
                            <th scope="col"><b>Pembuat</b></th>
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
                                    <form method="POST" action="{{ route('quest.restore', [$quest->id]) }}"
                                        class="d-inline">

                                        @csrf

                                        <input type="submit" value="Restore" class="btn btn-success" />
                                    </form>
                                    <form method="POST" action="{{ route('quest.delete-permanent', [$quest->id]) }}"
                                        class="d-inline" onsubmit="return confirm('Delete this quest permanently?')">

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
                    {!! $quests->links() !!}
                </div>
            </div>

        </div>
    </div>
@endsection
