@extends('layouts.global')

@section('title')
    Create Quest
@endsection

@section('dashboard-active')
    active
@endsection

@section('da-collapse-in')
    in
@endsection

@section('dash-quest-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Manajemen Quest</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('quest.index') }}">Manajemen Quest</a> </li>
                    <li class="breadcrumb-item active"> <a href="{{ route('quest.create') }}">Tambah Quest</a> </li>
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
    <div class="row">
        <div class="col-md-10">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('quest.store') }}" method="POST" enctype="multipart/form-data"
                class="shadow-sm p-3 bg-white">

                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image">
                        <br>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <label for="file">File Pendukung <small class="text-danger">*upload file jika
                                diperlukan</small></label>
                        <input type="file" class="form-control" name="file_pendukung">
                        <br>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        {{-- Skill Choice --}}
                        <label for="skill">Skill <small class="text-danger">*sesuaikan skill</small></label><br>
                        <select class="form-control" name="skill[]" multiple id="skill">
                        </select>
                        <br><br>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        {{-- Form Tingkat Kesulitan --}}
                        <label for="tingkat_kesulitan">Tingkat Kesulitan : </label>
                        <select class="form-control" name="tingkat_kesulitan" id="tingkat_kesulitan">
                            <option disabled class="text-center">== Pilih Tingkat Kesulitan ==</option>
                            <option value="Event">Event</option>
                            <option value="SSSPlus">SSS+</option>
                            <option value="SSS">SSS</option>
                            <option value="SS">SS</option>
                            <option value="S">S</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                        </select>
                        <br>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <label for="judul">Judul Utama Quest</label> <br>
                        <input type="text" class="form-control" name="judul" placeholder="Judul Quest">
                        <br>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <label for="deskripsi">Deskripsi Quest / Pertanyaan</label><br>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Berikan Deskripsi Quest/Soal"></textarea>
                        <br>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        {{-- Form Status --}}
                        <label for="">Jenis Soal</label>
                        <br />
                        <select class="form-control" name="jenis_soal" id="jenis_soal" onchange="showDiv(this)">
                            <option value="PILGANDA">PILGANDA</option>
                            <option value="LAPORAN">LAPORAN</option>
                        </select>
                        <br>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        {{-- Form Jawaban --}}
                        <div id="hiddenDiv" style="display: block;">

                            <label for="">Inputkan Pilihan Jawaban</label> <br>
                            <ol type="A">
                                <li class="mb-2">
                                    <input type="text" class="form-control" name="pil_A" placeholder="Judul Quest">
                                </li>
                                <li class="mb-2">
                                    <input type="text" class="form-control" name="pil_B" placeholder="Judul Quest">
                                </li>
                                <li class="mb-2">
                                    <input type="text" class="form-control" name="pil_C" placeholder="Judul Quest">
                                </li>
                                <li class="mb-2">
                                    <input type="text" class="form-control" name="pil_D" placeholder="Judul Quest">
                                </li>
                                <li class="mb-2">
                                    <input type="text" class="form-control" name="pil_E" placeholder="Judul Quest">
                                </li>
                            </ol>

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
                    </div>

                    <div class="col-lg-6 col-md-12">
                        {{-- Form Batas Waktu Pengerjaan --}}
                        <label for="batas_waktu">Batas Waktu Pengerjaan</label>
                        <input class="form-control" placeholder="Batas Waktu" type="datetime-local" name="batas_waktu"
                            id="batas_waktu">
                        <br>
                    </div>

                    <div class="col-lg-2 col-md-12">
                        {{-- Form Level --}}
                        <label for="level">Syarat Level</label>
                        <input class="form-control" placeholder="level" type="integer" name="level" id="level">
                        <br>
                    </div>

                    <div class="col-lg-2 col-md-12">
                        {{-- Form Skor --}}
                        <label for="skor">Bonus Skor</label>
                        <input class="form-control" placeholder="skor" type="float" name="skor" id="skor">
                        <br>
                    </div>

                    <div class="col-lg-2 col-md-12">
                        {{-- Form EXP --}}
                        <label for="exp">Bonus Exp</label>
                        <input class="form-control" placeholder="exp" type="float" name="exp" id="exp">
                        <br>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 text-right">
                    <button class="btn btn-primary" name="save_action" value="PUBLISH">Publish</button>
                    <button class="btn btn-secondary" name="save_action" value="DRAFT">Save as draft</button>
                </div>
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
