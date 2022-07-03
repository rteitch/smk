@extends('layouts.global')

@section('title')
    Notifikasi List
@endsection

@section('dashboard-active')
    active
@endsection

@section('da-collapse-in')
    in
@endsection

@section('dash-notifikasi-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Manajemen Notifikasi</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('notifikasi.index') }}">Manajemen Notifikasi</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">

                    <!-- Modal Create notifikasi-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id=""><small>Tambah Notifikasi
                                </small></h3>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('notifikasi.store') }}" method="POST" enctype="multipart/form-data"
                                class="shadow-sm p-3 bg-white">

                                @csrf
                                <div class="row">

                                    <div class="col-lg-12 col-md-12">
                                        <label for="image">Image Notifikasi</label> <small>*Opsional</small>
                                        <input type="file" class="form-control" name="image">
                                        <br>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        {{-- Form Pilih Role User --}}
                                        <label for="">Kirim Notifikasi Role</label>
                                        <br />
                                        <select class="form-control" name="jenis_roles" id="jenis_roles">
                                            <option value="SISWA">Siswa</option>
                                            <option value="PENGAJAR">Pengajar</option>
                                        </select>
                                        <br>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <label for="title">Judul Notifikasi</label> <br>
                                        <input type="text" class="form-control" name="title" placeholder="Title Pesan">
                                        <br>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <label for="pesan">Isi Pesan</label><br>
                                        <textarea name="pesan" id="deskripsi" class="form-control" placeholder="Berikan Isi Notifikasi"></textarea>
                                        <br>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        {{-- Form Status --}}
                                        <label for="">Jenis Notifikasi</label>
                                        <br />
                                        <select class="form-control" name="jenis_notifikasi" id="jenis_notifikasi"
                                            onchange="showDiv(this)">
                                            <option value="REWARD">REWARD</option>
                                            <option value="PESAN">PESAN</option>
                                        </select>
                                        <br>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div id="hiddenDiv" style="display: block;">
                                            <div class="row">

                                                <div class="col-lg-6 col-md-12">
                                                    {{-- Form Skor --}}
                                                    <label for="skor">Bonus Skor</label>
                                                    <input class="form-control" placeholder="skor" type="float"
                                                        name="skor" id="skor">
                                                    <br>
                                                </div>

                                                <div class="col-lg-6 col-md-12">
                                                    {{-- Form EXP --}}
                                                    <label for="exp">Bonus Exp</label>
                                                    <input class="form-control" placeholder="exp" type="float"
                                                        name="exp" id="exp">
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>





                                </div>
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

        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('notifikasi.index') }}">

                            <div class="input-group">
                                <input name="keyword" type="text" value="{{ Request::get('keyword') }}"
                                    class="form-control" placeholder="Filter by title">
                                <div class="input-group-append">
                                    <input type="submit" value="Filter" class="btn btn-primary">
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="col-md-6">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item text-white mr-3">
                                <a class="nav-link {{ Request::get('status') == null && Request::path() == 'notifikasi' ? 'active' : '' }}"
                                    href="{{ route('notifikasi.index') }}">All</a>
                            </li>
                            <li class="nav-item text-white mr-3">
                                <a class="nav-link {{ Request::get('status') == 'publish' ? 'active' : '' }}"
                                    href="{{ route('notifikasi.index', ['status' => 'publish']) }}">Publish</a>
                            </li>
                            <li class="nav-item text-white mr-3">
                                <a class="nav-link {{ Request::get('status') == 'draft' ? 'active' : '' }}"
                                    href="{{ route('notifikasi.index', ['status' => 'draft']) }}">Draft</a>
                            </li>
                            <li class="nav-item text-white mr-3">
                                <a class="nav-link {{ Request::path() == 'quest/trash' ? 'active' : '' }}"
                                    href="{{ route('notifikasi.trash') }}">Trash</a>
                            </li>


                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-12 text-right">

                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span
                                class="fa fa-plus"></span> Tambah Notifikasi
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
                                    <td><img src="{{ asset('storage/' . $notif->image) }}" alt="" width="70px"></td>
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
                                        <a href="{{ route('notifikasi.edit', [$notif->id]) }}"
                                            class="btn btn-info btn-sm"> <i class="fa fa-edit"></i>
                                        </a>
                                        <form method="POST" class="d-inline"
                                            onsubmit="return confirm('Move quest to trash?')"
                                            action="{{ route('notifikasi.destroy', [$notif->id]) }}">

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
                        {!! $notifikasi->links() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection

@section('footer-scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        function showDiv(select) {
            if (select.value == 'REWARD') {
                document.getElementById('hiddenDiv').style.display = "block";
            } else {
                document.getElementById('hiddenDiv').style.display = "none";
            }
        }
    </script>
@endsection
