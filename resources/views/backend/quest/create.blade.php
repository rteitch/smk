@extends('layouts.global')

@section('title')
    Create book
@endsection

@section('content')
    <div class="row">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="col-md-8">
            <form action="{{ route('quest.store') }}" method="POST" enctype="multipart/form-data"
                class="shadow-sm p-3 bg-white">

                @csrf

                <label for="judul">Judul</label> <br>
                <input type="text" class="form-control" name="judul" placeholder="Judul Quest">
                <br>

                <label for="image">Cover</label>
                <input type="file" class="form-control" name="image">
                <br>

                {{-- Skill Choice --}}
                <label for="skill">Skill <small class="text-danger">*sesuaikan skill</small></label><br>
                <select name="skill[]" multiple id="skill" class="form-control">
                </select>
                <br><br>

                <label for="deskripsi">Deskripsi</label><br>
                <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Berikan Deskripsi Quest"></textarea>
                <br>

                {{-- Form Status --}}
                <label for="">Jenis Soal</label>
                <br />
                <input value="PILGANDA" type="radio" class="form-control" id="PILGANDA" name="jenis_soal">
                <label for="PILGANDA">Pilihan Ganda</label>

                <input value="LAPORAN" type="radio" class="form-control" id="LAPORAN" name="jenis_soal">
                <label for="LAPORAN">Laporan</label>
                <br>

                <label for="jawaban_pilgan">Jawaban <small class="text-danger">*isikan jawaban jika pilihan pilgan ex: a | A / b | B / c | C / d | D / e | E</small></label><br>
                <input type="text" class="form-control" name="jawaban_pilgan" placeholder="jawaban...">
                <br>

                <label for="file">File Pendukung <small class="text-danger">*upload jika diperlukan</small></label>
                <input type="file" class="form-control" name="jawaban_laporan">
                <br>

                {{-- Form Level --}}
                <label for="level">Level</label>
                <input class="form-control" placeholder="level" type="integer" name="level" id="level">
                <br>

                {{-- Form Skor --}}
                <label for="skor">Skor</label>
                <input class="form-control" placeholder="skor" type="float" name="skor" id="skor">
                <br>

                {{-- Form EXP --}}
                <label for="exp">Exp</label>
                <input class="form-control" placeholder="exp" type="float" name="exp" id="exp">
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
        $('#skill').select2({
            ajax: {
                url: 'http://127.0.0.1:8000/ajax/skill/search',
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.judul
                            }
                        })
                    }
                }
            }
        });
    </script>
@endsection
