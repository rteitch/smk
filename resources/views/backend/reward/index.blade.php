@extends('layouts.global')

@section('title')
    Reward List
@endsection

@section('dashboard-active')
    active
@endsection

@section('da-collapse-in')
    in
@endsection

@section('dash-reward-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Manajemen Reward</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('reward.index') }}">Manajemen Reward</a> </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">

                        <!-- Modal Create jobclass-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id=""><small>Tambah Reward
                                    </small></h3>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('reward.store') }}" method="POST" enctype="multipart/form-data"
                                    class="shadow-sm p-3 bg-white">

                                    @csrf

                                    <label for="title">Judul Reward</label> <br>
                                    <input type="text" class="form-control" name="title" placeholder="Judul Reward">
                                    <br>

                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" name="image">
                                    <br>

                                    <label for="deskripsi">Deskripsi</label><br>
                                    <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Berikan Deskripsi Quest"></textarea>
                                    <br>

                                    {{-- Form Skor --}}
                                    <label for="syarat_skor">Syarat Skor</label>
                                    <input class="form-control" placeholder="syarat skor" type="float" name="syarat_skor"
                                        id="skor">
                                    <br>


                                    <div class="modal-footer">
                                        <button class="btn btn-primary" name="save_action" value="PUBLISH">Publish</button>

                                        <button class="btn btn-secondary" name="save_action" value="DRAFT">Save as
                                            draft</button>
                                </form>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-8">
                        <form action="{{ route('reward.index') }}">

                            <div class="input-group">
                                <input name="keyword" type="text" value="{{ Request::get('keyword') }}"
                                    class="form-control" placeholder="Filter by title">
                                <div class="input-group-append">
                                    <input type="submit" value="Filter" class="btn btn-primary">
                                </div>
                            </div>
                            <br>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item text-white mr-2">
                                <a class="nav-link {{ Request::get('status') == null && Request::path() == 'reward' ? 'active' : '' }}"
                                    href="{{ route('reward.index') }}">All</a>
                            </li>
                            <li class="nav-item text-white mr-2">
                                <a class="nav-link {{ Request::get('status') == 'publish' ? 'active' : '' }}"
                                    href="{{ route('reward.index', ['status' => 'publish']) }}">Publish</a>
                            </li>
                            <li class="nav-item text-white mr-2">
                                <a class="nav-link {{ Request::get('status') == 'draft' ? 'active' : '' }}"
                                    href="{{ route('reward.index', ['status' => 'draft']) }}">Draft</a>
                            </li>
                            <li class="nav-item text-white mr-2">
                                <a class="nav-link {{ Request::path() == 'quest/trash' ? 'active' : '' }}"
                                    href="{{ route('reward.trash') }}">Trash</a>
                            </li>
                        </ul>
                        <br>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-12 text-right">

                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span
                                class="fa fa-plus"></span> Tambah Reward
                        </button>
                    </div>
                </div>
                <hr>

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
                                <!-- Modal -->
                                <div id="myModalEdit{{ $rewards->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-lg">

                                        <!-- Modal edit jobclass-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="judul_file"><small>Edit Reward :
                                                        {{ $rewards->title }}
                                                    </small></h3>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form enctype="multipart/form-data" method="POST"
                                                    action="{{ route('reward.update', [$rewards->id]) }}"
                                                    class="">

                                                    @csrf
                                                    <input type="hidden" name="_method" value="PUT">


                                                    <label for="title">Judul Reward</label> <br>
                                                    <input type="text" class="form-control" name="title"
                                                        placeholder="Judul Reward" value="{{ $rewards->title }}">
                                                    <br>

                                                    <label for="image">Image</label><br>
                                                    <small class="text-muted">Current image</small><br>
                                                    @if ($rewards->image)
                                                        <img src="{{ asset('storage/' . $rewards->image) }}"
                                                            width="96px" />
                                                    @endif
                                                    <br><br>

                                                    <input type="file" class="form-control" name="image">
                                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah
                                                        image</small>
                                                    <br><br>

                                                    <label for="deskripsi">Deskripsi</label><br>
                                                    <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Berikan Deskripsi Reward">{{ $rewards->deskripsi }}</textarea>
                                                    <br>

                                                    {{-- Form Skor --}}
                                                    <label for="syarat_skor">Syarat Skor</label>
                                                    <input class="form-control" placeholder="syarat skor" type="float"
                                                        name="syarat_skor" id="syarat_skor"
                                                        value="{{ $rewards->syarat_skor }}">
                                                    <br>

                                                    <label for="pembuat">Pembuat <small>(tidak perlu
                                                            diedit)</small></label>
                                                    <input placeholder="pembuat" value="{{ $rewards->pembuat }}"
                                                        type="text" id="pembuat" name="pembuat"
                                                        class="form-control" disabled>
                                                    <br>

                                                    <label for="">Ubah Status</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option {{ $rewards->status == 'PUBLISH' ? 'selected' : '' }}
                                                            value="PUBLISH">PUBLISH</option>
                                                        <option {{ $rewards->status == 'DRAFT' ? 'selected' : '' }}
                                                            value="DRAFT">DRAFT</option>
                                                    </select>
                                                    <br>
                                                <div class="modal-footer">

                                                    <button class="btn btn-primary" value="PUBLISH">Update</button>

                                                </form>
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

                                            <!-- Trigger the modal with a button -->
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#myModalEdit{{ $rewards->id }}"><span
                                                    class="fa fa-edit"></span>
                                            </button>
                                            <form method="POST" class="d-inline"
                                                onsubmit="return confirm('Move quest to trash?')"
                                                action="{{ route('reward.destroy', [$rewards->id]) }}">

                                                @csrf
                                                <input type="hidden" value="DELETE" name="_method">

                                                <button type="submit" class="btn btn-danger btn-sm"><span
                                                        class="fa fa-trash-o"></span></button>

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
    </div>
    </div>
@endsection
