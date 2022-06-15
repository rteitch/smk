@extends('layouts.global')

@section('title')
    Trashed notifikasi
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
                    <form action="{{ route('notifikasi.index') }}">

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
                            <a class="nav-link" href="{{ route('notifikasi.index') }}">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('notifikasi.index', ['status' => 'publish']) }}">Publish</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('notifikasi.index', ['status' => 'draft']) }}">Draft</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() == 'notifikasi/trash' ? 'active' : '' }}"
                                href="{{ route('notifikasi.trash') }}">Trash</a>
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="my-3">
            <div class="row mb-3">
                <div class="col-md-12 text-right">
                    <a href="{{ route('notifikasi.create') }}" class="btn btn-primary">Create notifikasi</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-stripped">
                    <thead>
                        <tr>
                            <th scope="col"><b>#</b></th>
                            <th scope="col"><b>Title</b></th>
                            <th scope="col"><b>Pesan</b></th>
                            <th scope="col"><b>Dikirim ke</b></th>
                            <th scope="col"><b>Jenis Notifikasi</b></th>
                            <th scope="col"><b>Status</b></th>
                            <th scope="col"><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifikasi as $index => $notif)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $notif->title }}</td>
                                <td>{{ $notif->pesan }}</td>
                                <td>{{ $notif->jenis_roles }}</td>
                                <td>{{ $notif->jenis_notifikasi }}</td>
                                <td>
                                    @if ($notif->status == 'DRAFT')
                                        <span class="badge bg-dark text-white">{{ $notif->status }}</span>
                                    @else
                                        <span class="badge badge-success">{{ $notif->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('notifikasi.restore', [$notif->id]) }}"
                                        class="d-inline">

                                        @csrf

                                        <input type="submit" value="Restore" class="btn btn-success" />
                                    </form>
                                    <form method="POST" action="{{ route('notifikasi.delete-permanent', [$notif->id]) }}"
                                        class="d-inline"
                                        onsubmit="return confirm('Delete this notifikasi permanently?')">

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
                    {!! $notifikasi->links() !!}
                </div>
            </div>

        </div>
    </div>
@endsection
