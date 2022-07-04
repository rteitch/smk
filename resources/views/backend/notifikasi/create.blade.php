@extends('layouts.global')

@section('title')
    Create book
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('notifikasi.store') }}" method="POST" enctype="multipart/form-data"
                class="shadow-sm p-3 bg-white">

                @csrf

                <label for="title">Judul Notifikasi</label> <br>
                <input type="text" class="form-control" name="title" placeholder="Title Pesan">
                <br>

                <label for="image">Image Notifikasi</label> <small>*Opsional</small>
                <input type="file" class="form-control" name="image">
                <br>

                {{-- Form Pilih Role User --}}
                <label for="">Kirim Notifikasi Role</label>
                <br />
                <select class="form-control" name="jenis_roles" id="jenis_roles">
                    <option value="SISWA">Siswa</option>
                    <option value="PENGAJAR">Pengajar</option>
                </select>
                <br>

                <label for="pesan">Isi Pesan</label><br>
                <textarea name="pesan" id="deskripsi" class="form-control" placeholder="Berikan Isi Notifikasi"></textarea>
                <br>

                <button class="btn btn-primary" name="save_action" value="PUBLISH">Publish</button>

                <button class="btn btn-secondary" name="save_action" value="DRAFT">Save as draft</button>
            </form>
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
