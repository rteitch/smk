@extends('layouts.global')

@section('title')
    Skill list
@endsection

@section('dashboard-active')
    active
@endsection

@section('da-collapse-in')
    in
@endsection

@section('dash-skill-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Manajemen Skill</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('skill.index') }}">Manajemen Skill</a> </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
    </div>

    <style>
        .select2 {
            width: 100% !important;
        }
    </style>
@endsection

@section('content')
    <div class="container col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-0">
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
                        <h3 class="modal-title" id=""><small>Tambah Skill
                            </small></h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data" class="bg-white shadow-sm p-3"
                            action="{{ route('skill.store') }}" method="POST">

                            @csrf

                            <label>Judul Skill</label><br>
                            <input type="text" class="form-control" name="judul" />
                            <br>

                            <label>Deskripsi Skill</label><br>
                            <textarea name="deskripsi" class="form-control"></textarea>
                            <br>

                            {{-- Job Class Choice --}}

                            <label for="jobclass">Job Class</label><br>
                            <select name="jobclass[]" multiple id="jobclass" class="form-control">
                            </select>
                            <br><br>

                            <label>Syarat Level Player</label><br>
                            <input type="number" name="syarat_lv" class="form-control">
                            <br>

                            <label>Skill image</label>
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
                    <form action="{{ route('skill.index') }}">

                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Masukkan kata untuk mencari Skill" name="judul">
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
                            <a class="nav-link active" href="{{ route('skill.index') }}">Published</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('skill.trash') }}">Trash</a>
                        </li>
                    </ul>
                    <br>
                </div>
            </div>
            <hr class="my-3">

            <div class="col-md-12 text-right">
                <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span
                        class="fa fa-plus"></span> Tambah Skill
                </button>
                <br><br>
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
                                    <a href="{{ route('skill.show', [$skills->id]) }}" class="btn btn-primary btn-sm">
                                        <span class="fa fa-eye"></span></a>

                                    <a class="btn btn-info btn-sm" href="{{ route('skill.edit', [$skills->id]) }}"><span
                                            class="fa fa-edit"></span></a>

                                    <form class="d-inline" action="{{ route('skill.destroy', [$skills->id]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Move Skill dengan nama {{ $skills->judul }} to trash?')">

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

@section('footer-scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $('#jobclass').select2({
            ajax: {
                url: 'http://127.0.0.1:8000/ajax/jobclass/search',
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.name
                            }
                        })
                    }
                }
            }
        });
    </script>
@endsection
