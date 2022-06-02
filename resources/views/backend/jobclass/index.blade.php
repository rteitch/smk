@extends('layouts.global')

@section('title')
    Job Class list
@endsection

@section('content')
    <div class="container col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <b>List Job Class</b>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('jobclass.index') }}">

                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Filter by Job Class name" name="name">
                                <div class="input-group-append">
                                    <input type="submit" value="Filter" class="btn btn-primary">
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="col-md-6">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('jobclass.index') }}">Published</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('jobclass.trash') }}">Trash</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr class="my-3">

                <div class="col-md-12 text-right">
                    <a href="{{ route('jobclass.create') }}" class="btn btn-primary">Create Job Class</a>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <div class="d-flex justify-content-end">
                            {!! $jobclass->appends(Request::all())->links() !!}
                        </div>
                        @if (session('status'))
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-warning">
                                        {{ session('status') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-start">
                                    {!! $jobclass->appends(Request::all())->links() !!}
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col"><b>Name</b></th>
                                        {{-- <th scope="col"><b>Slug</b></th>
                                        <th scope="col"><b>Deskripsi</b></th> --}}
                                        <th scope="col"><b>Image</b></th>
                                        <th scope="col"><b>Actions</b></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($jobclass as $jobc)
                                        <tr>
                                            <td>{{ $jobc->name }}</td>
                                            {{-- <td>{{ $jobc->slug }}</td>
                                            <td>{{ Str::limit($jobc->deskripsi, 100) }}</td> --}}
                                            <td>
                                                @if ($jobc->image)
                                                    <img src="{{ asset('storage/' . $jobc->image) }}" width="48px" />
                                                @else
                                                    No image
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('jobclass.edit', [$jobc->id]) }}"
                                                    class="btn btn-info btn-sm"><span class="oi oi-pencil"></span></a>
                                                <a href="{{ route('jobclass.show', [$jobc->id]) }}"
                                                    class="btn btn-primary btn-sm"> <span class="oi oi-eye"></span></a>
                                                <form class="d-inline"
                                                    action="{{ route('jobclass.destroy', [$jobc->id]) }}" method="POST"
                                                    onsubmit="return confirm('Move Job Class {{ $jobc->name }} to trash?')">

                                                    @csrf

                                                    <input type="hidden" value="DELETE" name="_method">
                                                    <button type="submit" class="btn- btn-danger btn-sm"><span class="oi oi-trash"></span></button>
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
                                                {!! $jobclass->appends(Request::all())->links() !!}
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
