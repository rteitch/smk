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
            <form action="{{ route('quest.store') }}" method="POST" enctype="multipart/form-data"
                class="shadow-sm p-3 bg-white">

                @csrf

                <label for="judul">Judul</label> <br>
                <input type="text" class="form-control" name="judul" placeholder="Judul Quest">
                <br>

                <label for="image">Image</label>
                <input type="file" class="form-control" name="image">
                <br>

                {{-- Skill Choice --}}
                <label for="skill">Skill <small class="text-danger">*sesuaikan skill</small></label><br>
                <select class="form-control" name="skill[]" multiple id="skill">
                </select>
                <br><br>

                <label for="deskripsi">Deskripsi</label><br>
                <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Berikan Deskripsi Quest"></textarea>
                <br>

                {{-- Form Tingkat Kesulitan --}}
                <label for="tingkat_kesulitan">Tingkat Kesulitan : </label>
                <select class="form-control" name="tingkat_kesulitan" id="tingkat_kesulitan">
                    <option disabled class="text-center">== Pilih Tingkat Kesulitan ==</option>
                    <option value="kesulitan_Event">Event</option>
                    <option value="kesulitan_SSSPlus">SSS+</option>
                    <option value="kesulitan_SSS">SSS</option>
                    <option value="kesulitan_SS">SS</option>
                    <option value="kesulitan_S">S</option>
                    <option value="kesulitan_A">A</option>
                    <option value="kesulitan_B">B</option>
                    <option value="kesulitan_C">C</option>
                    <option value="kesulitan_D">D</option>
                    <option value="kesulitan_E">E</option>
                </select>
                <br>

                <label for="file">File Pendukung <small class="text-danger">*upload file jika diperlukan</small></label>
                <input type="file" class="form-control" name="file_pendukung">
                <br>

                {{-- Form Status --}}
                <label for="">Jenis Soal</label>
                <br />
                <select class="form-control" name="jenis_soal" id="jenis_soal" onchange="showDiv(this)">
                    <option value="PILGANDA">PILGANDA</option>
                    <option value="LAPORAN">LAPORAN</option>
                </select>
                <br>

                {{-- Form Jawaban --}}
                <div id="hiddenDiv" style="display: block;">
                    <label for="jawaban_pilgan">Jawaban Pilihan Ganda : </label>
                    <select class="form-control" name="jawaban_pilgan" id="jawaban_pilgan">
                        <option disabled class="text-center">== Pilih Jawaban ==</option>
                        <option value="Tidak Menjawab">Tidak Menjawab</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                    </select>
                    <br>
                </div>

                {{-- Form Batas Waktu Pengerjaan --}}
                <label for="batas_waktu">Batas Waktu Pengerjaan</label>
                <input class="form-control" placeholder="Batas Waktu" type="datetime-local" name="batas_waktu" id="batas_waktu">
                <br>

                {{-- Form Level --}}
                <label for="level">Syarat Level</label>
                <input class="form-control" placeholder="level" type="integer" name="level" id="level">
                <br>

                {{-- Form Skor --}}
                <label for="skor">Bonus Skor</label>
                <input class="form-control" placeholder="skor" type="float" name="skor" id="skor">
                <br>

                {{-- Form EXP --}}
                <label for="exp">Bonus Exp</label>
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

        function showDiv(select) {
            if (select.value == 'PILGANDA') {
                document.getElementById('hiddenDiv').style.display = "block";
            } else {
                document.getElementById('hiddenDiv').style.display = "none";
            }
        }
    </script>
@endsection
