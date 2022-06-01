@extends('layouts.global')

@section('title')
    Trashed Job Class
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('jobclass.index') }}">

                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Filter by Job Class name"
                        value="{{ Request::get('name') }}" name="name">

                    <div class="input-group-append">
                        <input type="submit" value="Filter" class="btn btn-primary">
                    </div>
                </div>

            </form>
        </div>

        <div class="col-md-6">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('jobclass.index') }}">Published</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('jobclass.trash') }}">Trash</a>
                </li>
            </ul>
        </div>

    </div>

    <hr class="my-3">

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobclass as $jobc)
                        <tr>
                            <td>{{ $jobc->name }}</td>
                            <td>{{ $jobc->slug }}</td>
                            <td>
                                @if ($jobc->image)
                                    <img src="{{ asset('storage/' . $jobc->image) }}" width="48px" />
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('jobclass.restore', [$jobc->id]) }}" class="btn btn-success">Restore</a>
                                <form class="d-inline"
                                    action="{{ route('jobclass.delete-permanent', [$jobc->id]) }}" method="POST"
                                    onsubmit="return confirm('Delete this jobclass {{ $jobc->name }} permanently?')">

                                    @csrf

                                    <input type="hidden" name="_method" value="DELETE" />

                                    <input type="submit" class="btn btn-danger btn-sm" value="Delete" />

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colSpan="10">
                            {{ $jobclass->appends(Request::all())->links() }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
