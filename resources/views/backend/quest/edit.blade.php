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
            <form enctype="multipart/form-data" method="POST" action="{{ route('quest.update', [$quests->id]) }}"
                class="p-3 shadow-sm bg-white">

                @csrf
                <input type="hidden" name="_method" value="PUT">

                <label for="judul">Judul</label><br>
                <input type="text" class="form-control" value="{{ $quests->judul }}" name="judul"
                    placeholder="Judul Quest" />
                <br>

                <label for="slug">Slug <small>(tidak perlu diedit)</small></label><br>
                <input disabled type="text" class="form-control" value="{{ $quests->slug }}" name="slug"
                    placeholder="enter-a-slug" />
                <br>

                <label for="image">Image</label><br>
                <small class="text-muted">Current image</small><br>
                @if ($quests->image)
                    <img src="{{ asset('storage/' . $quests->image) }}" width="96px" />
                @endif
                <br><br>

                <input type="file" class="form-control" name="image">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah cover</small>
                <br><br>

                <label for="skill">Skill</label>
                <select class="form-control" multiple class="form-control" name="skill[]" id="skill"></select>
                <br>
                <br>

                <label for="deskripsi">Deskripsi</label> <br>
                <textarea name="deskripsi" id="deskripsi" class="form-control">{{ $quests->deskripsi }}</textarea>
                <br>

                {{-- Form Tingkat Kesulitan --}}
                <label for="tingkat_kesulitan">Tingkat Kesulitan : </label>
                <select class="form-control" name="tingkat_kesulitan" id="tingkat_kesulitan">
                    <option disabled class="text-center">== Pilih Tingkat Kesulitan ==</option>
                    <option {{ $quests->kesulitan == 'kesulitan_Event' ? 'selected' : '' }} value="kesulitan_Event">Event
                    </option>
                    <option {{ $quests->kesulitan == 'kesulitan_SSSPlus' ? 'selected' : '' }} value="kesulitan_SSSPlus">
                        SSS+</option>
                    <option {{ $quests->kesulitan == 'kesulitan_SSS' ? 'selected' : '' }} value="kesulitan_SSS">SSS
                    </option>
                    <option {{ $quests->kesulitan == 'kesulitan_SS' ? 'selected' : '' }} value="kesulitan_SS">SS</option>
                    <option {{ $quests->kesulitan == 'kesulitan_S' ? 'selected' : '' }} value="kesulitan_S">
                        S</option>
                    <option {{ $quests->kesulitan == 'kesulitan_A' ? 'selected' : '' }} value="kesulitan_A">A</option>
                    <option {{ $quests->kesulitan == 'kesulitan_B' ? 'selected' : '' }} value="kesulitan_B">B</option>
                    <option {{ $quests->kesulitan == 'kesulitan_C' ? 'selected' : '' }} value="kesulitan_C">C</option>
                    <option {{ $quests->kesulitan == 'kesulitan_D' ? 'selected' : '' }} value="kesulitan_D">D</option>
                    <option {{ $quests->kesulitan == 'kesulitan_E' ? 'selected' : '' }} value="kesulitan_E">E</option>
                </select>
                <br>

                <!-- Trigger the modal with a button -->

                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><span
                        class="oi oi-eye"></span> Lihat File
                </button>

                <small class="text-muted" id="judul_file2"></small>
                <br>
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
                                {{-- <object data="{{ asset('storage/' . $quests->file_pendukung) }}" type="application/pdf"
                                    width="300" height="200">
                                </object> --}}
                                <iframe src="{{ asset('storage/' . $quests->file_pendukung) }}" frameborder="0"
                                    width="100%" height="400px"  type="application/pdf"></iframe>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <br>
                <label for="file">File Pendukung <small class="text-danger">*upload file jika diperlukan
                        (pdf)</small></label>
                <input type="file" class="form-control" name="file_pendukung">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah file pendukung</small>
                <br><br>

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

                {{-- Form Jawaban --}}
                <div id="hiddenDiv" style="display: none;">
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

                {{-- Form Batas Waktu Pengerjaan --}}
                <label for="batas_waktu">Batas Waktu Pengerjaan</label>
                <input class="form-control" placeholder="Batas Waktu" type="datetime-local" name="batas_waktu" id="batas_waktu" value="">
                <br>

                {{-- Form Level --}}
                <label for="level">Syarat Level</label>
                <input class="form-control" placeholder="level" type="integer" name="level" id="level"
                    value="{{ $quests->level }}">
                <br>

                {{-- Form Skor --}}
                <label for="skor">Bonus Skor</label>
                <input class="form-control" placeholder="skor" type="float" name="skor" id="skor"
                    value="{{ $quests->skor }}">
                <br>

                {{-- Form EXP --}}
                <label for="exp">Bonus Exp</label>
                <input class="form-control" placeholder="exp" type="float" name="exp" id="exp"
                    value="{{ $quests->exp }}">
                <br>

                <label for="pembuat">Pembuat <small>(tidak perlu diedit)</small></label>
                <input placeholder="pembuat" value="{{ $quests->pembuat }}" type="text" id="pembuat" name="pembuat"
                    class="form-control">
                <br>

                <label for="">Status</label>
                <select name="status" id="status" class="form-control">
                    <option {{ $quests->status == 'PUBLISH' ? 'selected' : '' }} value="PUBLISH">PUBLISH</option>
                    <option {{ $quests->status == 'DRAFT' ? 'selected' : '' }} value="DRAFT">DRAFT</option>
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
