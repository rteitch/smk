@extends('layouts.global')

@section('title')
    Skill list
@endsection

@section('content')
    <div class="container col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-0">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <b>List Skill</b>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <form action="{{ route('skill.index') }}">

                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Filter by Skill judul" name="judul">
                                <div class="input-group-append">
                                    <input type="submit" value="Filter" class="btn btn-primary">
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="col-md-6 mt-3">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('skill.index') }}">Published</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('skill.trash') }}">Trash</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr class="my-3">

                <div class="col-md-12 text-right">
                    <a href="{{ route('skill.create') }}" class="btn btn-primary"><span class="oi oi-plus"> Tambah
                            Skill</a>
                </div>

                <div class="row text-center">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-start">
                            {!! $skill->appends(Request::all())->links() !!}
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col"><b>Judul</b></th>
                                {{-- <th scope="col"><b>Slug</b></th>
                                <th scope="col"><b>Deskripsi</b></th> --}}
                                <th scope="col"><b>Image</b></th>
                                <th scope="col"><b>Actions</b></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($skill as $skills)
                                <tr>
                                    <td>{{ $skills->judul }}</td>
                                    {{-- <td>{{ $skills->slug }}</td>
                                    <td>{{ Str::limit($skills->deskripsi, 100) }}</td> --}}
                                    <td>
                                        @if ($skills->image)
                                            <img src="{{ asset('storage/' . $skills->image) }}" width="48px" />
                                        @else
                                            No image
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('skill.edit', [$skills->id]) }}"
                                            class="btn btn-info btn-sm"><span class="oi oi-pencil"></span></a>
                                        <a href="{{ route('skill.show', [$skills->id]) }}"
                                            class="btn btn-primary btn-sm"> <span class="oi oi-eye"></span></a>
                                        <form class="d-inline"
                                            action="{{ route('skill.destroy', [$skills->id]) }}" method="POST"
                                            onsubmit="return confirm('Move Skill dengan nama {{ $skills->judul }} to trash?')">

                                            @csrf

                                            <input type="hidden" value="DELETE" name="_method">
                                            <button type="submit" class="btn btn-danger btn-sm"><span class="oi oi-trash"></span></button>
                                            {{-- <input type="submit" class="btn btn-danger btn-sm" value="Trash"> --}}

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colSpan="10">
                                    <div class="d-flex justify-content-start">
                                        {!! $skill->appends(Request::all())->links() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
