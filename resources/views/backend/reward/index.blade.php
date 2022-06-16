@extends('layouts.global')

@section('title')
    Reward List
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('reward.index') }}">

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
                            <a class="nav-link {{ Request::get('status') == null && Request::path() == 'reward' ? 'active' : '' }}"
                                href="{{ route('reward.index') }}">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::get('status') == 'publish' ? 'active' : '' }}"
                                href="{{ route('reward.index', ['status' => 'publish']) }}">Publish</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::get('status') == 'draft' ? 'active' : '' }}"
                                href="{{ route('reward.index', ['status' => 'draft']) }}">Draft</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() == 'quest/trash' ? 'active' : '' }}"
                                href="{{ route('reward.trash') }}">Trash</a>
                        </li>


                    </ul>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12 text-right">
                    <a href="{{ route('reward.create') }}" class="btn btn-primary">Create Reward</a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-stripped">
                    <thead>
                        <tr>
                            <th scope="col"><b>#</b></th>
                            <th scope="col"><b>Image</b></th>
                            <th scope="col"><b>Judul</b></th>
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
                                <td>
                                    @if ($rewards->image)
                                        <img src="{{ asset('storage/' . $rewards->image) }}" width="96px" />
                                    @endif
                                </td>
                                <td>{{ $rewards->title }}</td>
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
                                    <a href="{{ route('reward.edit', [$rewards->id]) }}" class="btn btn-info btn-sm"> Edit
                                    </a>
                                    <form method="POST" class="d-inline"
                                        onsubmit="return confirm('Move quest to trash?')"
                                        action="{{ route('reward.destroy', [$rewards->id]) }}">

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
                    {!! $reward->links() !!}
                </div>
            </div>

        </div>
    </div>
@endsection
