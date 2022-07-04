@extends('layouts.global')

@section('title')
    Edit Quest
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
                <h2>Edit Notifikasi</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('notifikasi.index') }}">Manajemen Notifikasi</a>
                    <li class="breadcrumb-item active"> <a
                            href="{{ route('notifikasi.edit', [$notifikasi_to_edit->id]) }}">Edit Notifikasi :
                            {{ $notifikasi_to_edit->title }}</a>
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
        <div class="col-md-10">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form enctype="multipart/form-data" method="POST"
                action="{{ route('notifikasi.update', [$notifikasi_to_edit->id]) }}" class="p-3 shadow-sm bg-white">

                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <label for="image">Image</label><br>
                        <small class="text-muted">Current image</small><br>
                        @if ($notifikasi_to_edit->image)
                            <img src="{{ asset('storage/' . $notifikasi_to_edit->image) }}" width="96px" />
                        @endif
                        <br><br>
                        <input type="file" class="form-control" name="image">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah cover</small>
                        <br><br>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <label for="">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option {{ $notifikasi_to_edit->status == 'PUBLISH' ? 'selected' : '' }} value="PUBLISH">
                                PUBLISH
                            </option>
                            <option {{ $notifikasi_to_edit->status == 'DRAFT' ? 'selected' : '' }} value="DRAFT">DRAFT
                            </option>
                        </select>
                        <br>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        {{-- Form Pilih Role User --}}
                        <label for="">Kirim Notifikasi Role</label>
                        <br />
                        <select class="form-control" name="jenis_roles" id="jenis_roles">
                            <option {{ $notifikasi_to_edit->jenis_roles == 'SISWA' ? 'selected' : '' }} value="SISWA">
                                Siswa
                            </option>
                            <option {{ $notifikasi_to_edit->jenis_roles == 'PENGAJAR' ? 'selected' : '' }}
                                value="PENGAJAR">
                                Pengajar
                            </option>
                        </select>
                        <br>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <label for="title">Judul Notifikasi</label> <br>
                        <input type="text" class="form-control" name="title" placeholder="Title Pesan"
                            value="{{ $notifikasi_to_edit->title }}">
                        <br>
                    </div>


                    <div class="col-lg-12 col-md-12">
                        <label for="pesan">Isi Pesan</label><br>
                        <textarea name="pesan" id="deskripsi" class="form-control" placeholder="Berikan Isi Notifikasi">{{ $notifikasi_to_edit->pesan }}</textarea>
                        <br>
                    </div>
                    <div class="col-lg-12 col-md-12 text-right">

                        <hr>
                        <button class="btn btn-primary" value="PUBLISH">Update</button>

                    </div>
            </form>
        </div>

    </div>
    </div>
@endsection

@section('footer-scripts')
    <script src="{{ asset('js/pdfobject.min.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@endsection
