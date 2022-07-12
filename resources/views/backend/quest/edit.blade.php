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
                    <li class="breadcrumb-item"> <a href="{{ route('quest.index') }}">Manajemen Quest</a> </li>
                    <li class="breadcrumb-item active"> <a href="{{ route('quest.edit', [$quests->id]) }}">Edit Quest :
                            {{ $quests->judul }}</a> </li>
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
            <form enctype="multipart/form-data" method="POST" action="{{ route('quest.update', [$quests->id]) }}"
                class="p-3 shadow-sm bg-white">

                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="row">

                    <div class="col-lg-6 col-md-12">
                        <label for="image">Image</label><br>
                        <small class="text-muted">Current image</small><br>
                        @if ($quests->image)
                            <img src="{{ asset('storage/' . $quests->image) }}" width="96px" />
                        @endif
                        <br><br>

                        <input type="file" class="form-control" name="image">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah cover</small>
                        <br><br>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="judul_file"></h3>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <iframe src="{{ asset('storage/' . $quests->file_pendukung) }}" frameborder="0"
                                            width="100%" height="400px" type="application/pdf"></iframe>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <label for="file">File Pendukung <small class="text-danger">*upload file jika diperlukan
                                (pdf)</small></label>
                        <br>
                        <!-- Trigger the modal with a button -->

                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><span
                                class="oi oi-eye"></span> Lihat File
                        </button>
                        <small class="text-muted" id="judul_file2"></small>
                        <br><br>
                        <input type="file" class="form-control" name="file_pendukung">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah file pendukung</small>
                        <br><br>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <label for="skill">Skill</label>
                        <select class="form-control" multiple class="form-control" name="skill[]" id="skill"></select>
                        <br>
                        <br>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        {{-- Form Tingkat Kesulitan --}}
                        <label for="tingkat_kesulitan">Tingkat Kesulitan : </label>
                        <select class="form-control" name="tingkat_kesulitan" id="tingkat_kesulitan">
                            <option disabled class="text-center">== Pilih Tingkat Kesulitan ==</option>
                            <option {{ $quests->kesulitan == 'Event' ? 'selected' : '' }} value="Event">Event
                            </option>
                            <option {{ $quests->kesulitan == 'SSSPlus' ? 'selected' : '' }} value="SSSPlus">
                                SSS+</option>
                            <option {{ $quests->kesulitan == 'SSS' ? 'selected' : '' }} value="SSS">SSS
                            </option>
                            <option {{ $quests->kesulitan == 'SS' ? 'selected' : '' }} value="SS">SS</option>
                            <option {{ $quests->kesulitan == 'S' ? 'selected' : '' }} value="S">
                                S</option>
                            <option {{ $quests->kesulitan == 'A' ? 'selected' : '' }} value="A">A</option>
                            <option {{ $quests->kesulitan == 'B' ? 'selected' : '' }} value="B">B</option>
                            <option {{ $quests->kesulitan == 'C' ? 'selected' : '' }} value="C">C</option>
                            <option {{ $quests->kesulitan == 'D' ? 'selected' : '' }} value="D">D</option>
                            <option {{ $quests->kesulitan == 'E' ? 'selected' : '' }} value="E">E</option>
                        </select>
                        <br>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <label for="judul">Judul Utama Quest</label><br>
                        <input type="text" class="form-control" value="{{ $quests->judul }}" name="judul"
                            placeholder="Judul Quest" />
                        <br>
                    </div>


                    <div class="col-lg-12 col-md-12">
                        <label for="deskripsi">Deskripsi Quest / Pertanyaan</label> <br>
                        <textarea name="deskripsi" id="deskripsi" class="form-control">{{ $quests->deskripsi }}</textarea>
                        <br>
                    </div>



                    <div class="col-lg-12 col-md-12">
                        {{-- Form Status --}}
                        <label for="">Jenis Soal</label>
                        <br />
                        <select class="form-control" name="jenis_soal" id="jenis_soal" onchange="showDiv(this)">
                            <option {{ $quests->jenis_soal == 'PILGANDA' ? 'selected' : '' }} value="PILGANDA">PILGANDA
                            </option>
                            <option {{ $quests->jenis_soal == 'LAPORAN' ? 'selected' : '' }} value="LAPORAN">LAPORAN
                            </option>
                        </select>
                        <br>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        {{-- Form Jawaban --}}
                        <div id="hiddenDiv" style="display: none;">
                            <label for="">Inputkan Pilihan Jawaban</label> <br>
                            <ol type="A">
                                <li class="mb-2">
                                    <input type="text" class="form-control" name="pil_A" placeholder="Judul Quest"
                                        value="{{ $quests->pil_A }}">
                                </li>
                                <li class="mb-2">
                                    <input type="text" class="form-control" name="pil_B" placeholder="Judul Quest"
                                        value="{{ $quests->pil_B }}">
                                </li>
                                <li class="mb-2">
                                    <input type="text" class="form-control" name="pil_C" placeholder="Judul Quest"
                                        value="{{ $quests->pil_C }}">
                                </li>
                                <li class="mb-2">
                                    <input type="text" class="form-control" name="pil_D" placeholder="Judul Quest"
                                        value="{{ $quests->pil_D }}">
                                </li>
                                <li class="mb-2">
                                    <input type="text" class="form-control" name="pil_E" placeholder="Judul Quest"
                                        value="{{ $quests->pil_E }}">
                                </li>
                            </ol>
                            <label for="jawaban_pilgan">Jawaban Pilihan Ganda : </label>
                            <select class="form-control" name="jawaban_pilgan" id="jawaban_pilgan">
                                <option disabled class="text-center">== Pilih Jawaban ==</option>
                                <option {{ $quests->jawaban_pilgan == 'Tidak Menjawab' ? 'selected' : '' }}
                                    value="Tidak Menjawab">Tidak Menjawab</option>
                                <option {{ $quests->jawaban_pilgan == 'A' ? 'selected' : '' }} value="A">A</option>
                                <option {{ $quests->jawaban_pilgan == 'B' ? 'selected' : '' }} value="B">B</option>
                                <option {{ $quests->jawaban_pilgan == 'C' ? 'selected' : '' }} value="C">C</option>
                                <option {{ $quests->jawaban_pilgan == 'D' ? 'selected' : '' }} value="D">D</option>
                                <option {{ $quests->jawaban_pilgan == 'E' ? 'selected' : '' }} value="E">E</option>
                            </select>
                            <br>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        {{-- Form Batas Waktu Pengerjaan --}}
                        <label for="batas_waktu">Batas Waktu Pengerjaan</label>

                        <input class="form-control @error('time') is-invalid @enderror" placeholder="Batas Waktu"
                            type="datetime-local" name="batas_waktu" id="batas_waktu"
                            value="{{ old('time') ?? date('Y-m-d\TH:i', strtotime($quests->batas_waktu)) }}">
                        <br>
                    </div>

                    <div class="col-lg-2 col-md-12">
                        {{-- Form Level --}}
                        <label for="level">Syarat Level</label>
                        <input class="form-control" placeholder="level" type="integer" name="level" id="level"
                            value="{{ $quests->level }}">
                        <br>
                    </div>

                    <div class="col-lg-2 col-md-12">
                        {{-- Form Skor --}}
                        <label for="skor">Bonus Skor</label>
                        <input class="form-control" placeholder="skor" type="float" name="skor" id="skor"
                            value="{{ $quests->skor }}">
                        <br>
                    </div>

                    <div class="col-lg-2 col-md-12">
                        {{-- Form EXP --}}
                        <label for="exp">Bonus Exp</label>
                        <input class="form-control" placeholder="exp" type="float" name="exp" id="exp"
                            value="{{ $quests->exp }}">
                        <br>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <label for="pembuat">Pembuat <small>(tidak perlu diedit)</small></label>
                        <input placeholder="pembuat" value="{{ $quests->pembuat }}" type="text" id="pembuat"
                            name="pembuat" class="form-control" disabled>
                        <br>

                    </div>

                    <div class="col-lg-6 col-md-12">

                        <label for="">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option {{ $quests->status == 'PUBLISH' ? 'selected' : '' }} value="PUBLISH">PUBLISH
                            </option>
                            <option {{ $quests->status == 'DRAFT' ? 'selected' : '' }} value="DRAFT">DRAFT</option>
                        </select>
                        <br>
                    </div>

                    <hr>

                    <div class="col-lg-12 col-md-12 text-right">
                        <button class="btn btn-primary" value="PUBLISH">Update</button>
                    </div>
                </div>


            </form>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script src="{{ asset('js/pdfobject.min.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $('#skill').select2({
            ajax: {
                url: 'https://ga-smkn2solo.online/ajax/skill/search',
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

        var skill = {!! $quests->skill !!}

        skill.forEach(function(skill) {
            var option = new Option(skill.judul, skill.id, true, true);
            $('#skill').append(option).trigger('change');
        });

        function showDiv(select) {
            if (select.value == 'PILGANDA') {
                document.getElementById('hiddenDiv').style.display = "block";
            } else {
                document.getElementById('hiddenDiv').style.display = "none";
            }
        }

        var text = "{{ $quests->file_pendukung }}";
        const judulArray = text.split("/");
        if (!text) {
            document.getElementById("judul_file").innerHTML = "Belum Ada File";
            document.getElementById("judul_file2").innerHTML = "Belum Ada File";
        } else {
            document.getElementById("judul_file").innerHTML = judulArray[1];
            document.getElementById("judul_file2").innerHTML = judulArray[1];
        }
    </script>
@endsection
