@extends('layouts.global')

@section('title')
    Edit Quest
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form enctype="multipart/form-data" method="POST" action="{{ route('notifikasi.update', [$notifikasi_to_edit->id]) }}"
                class="p-3 shadow-sm bg-white">

                @csrf
                <input type="hidden" name="_method" value="PUT">

                <label for="title">Judul Notifikasi</label> <br>
                <input type="text" class="form-control" name="title" placeholder="Title Pesan"
                    value="{{ $notifikasi_to_edit->title }}">
                <br>

                <label for="slug">Slug <small>(tidak perlu diedit)</small></label><br>
                <input disabled type="text" class="form-control" value="{{ $notifikasi_to_edit->slug }}" name="slug"
                    placeholder="enter-a-slug" />
                <br>

                <label for="image">Image</label><br>
                <small class="text-muted">Current image</small><br>
                @if ($notifikasi_to_edit->image)
                    <img src="{{ asset('storage/' . $notifikasi_to_edit->image) }}" width="96px" />
                @endif
                <br><br>
                <input type="file" class="form-control" name="image">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah cover</small>
                <br><br>

                {{-- Form Pilih Role User --}}
                <label for="">Kirim Notifikasi Role</label>
                <br />
                <select class="form-control" name="jenis_roles" id="jenis_roles">
                    <option {{ $notifikasi_to_edit->jenis_roles == 'SISWA' ? 'selected' : '' }} value="SISWA">Siswa</option>
                    <option {{ $notifikasi_to_edit->jenis_roles == 'PENGAJAR' ? 'selected' : '' }} value="PENGAJAR">Pengajar
                    </option>
                </select>
                <br>

                <label for="pesan">Isi Pesan</label><br>
                <textarea name="pesan" id="deskripsi" class="form-control" placeholder="Berikan Isi Notifikasi">{{ $notifikasi_to_edit->pesan }}</textarea>
                <br>

                {{-- Form Status --}}
                <label for="">Jenis Notifikasi <small class="text-danger">*Pilih Lagi Jenis Notifikasi yg ingin digunakan</small></label>
                <br />
                <select class="form-control" name="jenis_notifikasi" id="jenis_notifikasi" onchange="showDiv(this)">
                    <option {{ $notifikasi_to_edit->jenis_notifikasi == 'PESAN' ? 'selected' : '' }} value="PESAN">PESAN</option>
                    <option {{ $notifikasi_to_edit->jenis_notifikasi == 'REWARD' ? 'selected' : '' }}  value="REWARD">REWARD</option>
                </select>
                <br>
                <div id="hiddenDiv" style="display: block;">
                    {{-- Form Skor --}}
                    <label for="skor">Bonus Skor</label>
                    <input class="form-control" placeholder="skor" type="float" name="skor" id="skor"
                        value="{{ $notifikasi_to_edit->skor }}">
                    <br>
                    {{-- Form EXP --}}
                    <label for="exp">Bonus Exp</label>
                    <input class="form-control" placeholder="exp" type="float" name="exp" id="exp"
                        value="{{ $notifikasi_to_edit->skor }}">
                    <br>
                </div>
                <label for="">Status</label>
                <select name="status" id="status" class="form-control">
                    <option {{ $notifikasi_to_edit->status == 'PUBLISH' ? 'selected' : '' }} value="PUBLISH">PUBLISH</option>
                    <option {{ $notifikasi_to_edit->status == 'DRAFT' ? 'selected' : '' }} value="DRAFT">DRAFT</option>
                </select>
                <br>

                <button class="btn btn-primary" value="PUBLISH">Update</button>
            </form>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script src="{{ asset('js/pdfobject.min.js') }}"></script>
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
