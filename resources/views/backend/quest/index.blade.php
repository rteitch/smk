@extends('layouts.global')

@section('title')
    Quest List
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

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
                            <a class="nav-link {{ Request::get('status') == null && Request::path() == 'quest' ? 'active' : '' }}"
                                href="{{ route('quest.index') }}">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::get('status') == 'publish' ? 'active' : '' }}"
                                href="{{ route('quest.index', ['status' => 'publish']) }}">Publish</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::get('status') == 'draft' ? 'active' : '' }}"
                                href="{{ route('quest.index', ['status' => 'draft']) }}">Draft</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() == 'quest/trash' ? 'active' : '' }}"
                                href="{{ route('quest.trash') }}">Trash</a>
                        </li>


                    </ul>
                </div>
            </div>
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
                                <td>
                                    @if ($quest->kesulitan == 'kesulitan_Event')
                                        Event
                                    @elseif ($quest->kesulitan == 'kesulitan_SSSPlus')
                                        SSS+
                                    @elseif ($quest->kesulitan == 'kesulitan_SSS')
                                        SSS
                                    @elseif ($quest->kesulitan == 'kesulitan_SS')
                                        SS
                                    @elseif ($quest->kesulitan == 'kesulitan_S')
                                        S
                                    @elseif ($quest->kesulitan == 'kesulitan_A')
                                        A
                                    @elseif ($quest->kesulitan == 'kesulitan_B')
                                        B
                                    @elseif ($quest->kesulitan == 'kesulitan_C')
                                        C
                                    @elseif ($quest->kesulitan == 'kesulitan_D')
                                        D
                                    @elseif ($quest->kesulitan == 'kesulitan_E')
                                        E
                                    @endif
                                </td>
                                <td>
                                    @if ($quest->status == 'DRAFT')
                                        <span class="badge bg-dark text-white">{{ $quest->status }}</span>
                                    @else
                                        <span class="badge badge-success">{{ $quest->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('quest.edit', [$quest->id]) }}" class="btn btn-info btn-sm"> Edit
                                    </a>
                                    <form method="POST" class="d-inline"
                                        onsubmit="return confirm('Move quest to trash?')"
                                        action="{{ route('quest.destroy', [$quest->id]) }}">

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
                    {!! $quests->links() !!}
                </div>
            </div>

        </div>
    </div>
@endsection
