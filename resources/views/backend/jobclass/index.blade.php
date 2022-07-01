@extends('layouts.global')

@section('title')
    Job Class list
@endsection

@section('dashboard-active')
    active
@endsection

@section('da-collapse-in')
    in
@endsection

@section('dash-jobclass-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Manajemen Jobclass</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('quest.trash') }}">Manajemen Jobclass</a> </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if (session('status-delete'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        {{ session('status-delete') }}
                    </div>
                </div>
            </div>
        @endif

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal Create jobclass-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id=""><small>Tambah JobClass
                            </small></h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data" class="bg-white shadow-sm p-3"
                            action="{{ route('jobclass.store') }}" method="POST">

                            @csrf

                            <label>Job Class name</label><br>
                            <input type="text" class="form-control" name="name" />
                            <br>

                            <label>Deskripsi Job Class</label><br>
                            <textarea name="deskripsi" class="form-control"></textarea>
                            <br>

                            <label>Job Class image</label>
                            <input type="file" class="form-control" name="image" />

                            <br>

                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" value="Save" />

                        </form>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <form action="{{ route('jobclass.index') }}">

                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Filter by Job Class name"
                                name="name">
                            <div class="input-group-append">
                                <input type="submit" value="Filter" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                    <br>
                </div>
                <div class="col-md-4">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item mr-2">
                            <a class="nav-link active" href="{{ route('jobclass.index') }}">Published</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('jobclass.trash') }}">Trash</a>
                        </li>
                    </ul>
                    <br>
                </div>
            </div>
            <hr class="my-3">

            <div class="col-md-12 text-right">
                <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span
                        class="fa fa-plus"></span> Tambah JobClass
                </button>
            </div>
            <div class="row">
                <div class="table-responsive">
                    <div class="d-flex justify-content-end">
                        {!! $jobclass->appends(Request::all())->links() !!}
                    </div>
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
                                    <!-- Modal -->
                                    <div id="myModalEdit{{ $jobc->id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-lg">

                                            <!-- Modal edit jobclass-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="judul_file"><small>Edit Jobclass :
                                                            {{ $jobc->name }}
                                                        </small></h3>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('jobclass.update', [$jobc->id]) }}"
                                                        enctype="multipart/form-data" method="POST" class="">

                                                        @csrf

                                                        <input type="hidden" value="PUT" name="_method">

                                                        <label>Job Class Name</label> <br>
                                                        <input type="text" class="form-control"
                                                            value="{{ $jobc->name }}" name="name">
                                                        <br>

                                                        <label>Job Class Deskripsi</label> <br>
                                                        <textarea name="deskripsi" class="form-control">{{ $jobc->deskripsi }}</textarea>
                                                        <br>

                                                        <label>Job Class Image</label><br>
                                                        @if ($jobc->image)
                                                            <span>Current image</span><br>
                                                            <img src="{{ asset('storage/' . $jobc->image) }}"
                                                                width="120px">
                                                            <br><br>
                                                        @endif
                                                        <input type="file" class="form-control" name="image">
                                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah
                                                            gambar</small>
                                                        <br><br>


                                                        <div class="modal-footer">
                                                            <input type="submit" class="btn btn-primary" value="Update">

                                                    </form>
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    </div>


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
                            <a href="{{ route('jobclass.show', [$jobc->id]) }}" class="btn btn-primary btn-sm">
                                <span class="fa fa-eye"></span></a>
                            <!-- Trigger the modal with a button -->
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                data-target="#myModalEdit{{ $jobc->id }}"><span class="fa fa-edit"></span>
                            </button>
                            <form class="d-inline" action="{{ route('jobclass.destroy', [$jobc->id]) }}"
                                method="POST" onsubmit="return confirm('Move Job Class {{ $jobc->name }} to trash?')">

                                @csrf

                                <input type="hidden" value="DELETE" name="_method">
                                <button type="submit" class="btn btn-danger btn-sm"><span
                                        class="fa fa-trash-o"></span></button>
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
