@extends('layouts.global')

@section('title')
    Edit Artikel
@endsection

@section('content')
    <div class="col-md-8">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('artikel.update', [$artikel->id]) }}" enctype="multipart/form-data" method="POST"
            class="bg-white shadow-sm p-3">

            @csrf
            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
                {{-- Skill Choice --}}
                <label for="skill">Skill</label>
                <select class="form-control" multiple class="form-control" name="skill[]" id="skill"></select>
                <br>
                <br>

                <label for="title">Judul :</label>
                <input class="form-control" type="text" name="title" value="{{ $artikel->title }}">
                <br>

                <label for="">Konten :</label>
                <textarea class="form-control" name="konten" id="konten">{{ $artikel->konten }}</textarea>
                <br>
                <div class="row">
                    <div class="col">
                        {{-- Image --}}
                        <!-- Trigger the modal with a button -->
                        <br>
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                            data-target="#myModalImage"><span class="oi oi-eye"></span> Lihat Image Utama
                        </button>

                        <small class="text-muted" id="judul_image2">
                            @if ($artikel->image)
                                {{ $artikel->title }}
                            @else
                                Belum ada Gambar
                            @endif
                        </small>
                        <br>
                        <!-- Modal -->
                        <div id="myModalImage" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="judul_image">{{ $artikel->title }}</h3>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="text-center">
                                            @if ($artikel->image)
                                                <img src="{{ asset('storage/' . $artikel->image) }}" width="50%" />
                                            @else
                                                Belum ada Gambar
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="">
                            <label for="image">Image Utama</label>
                            <input type="file" class="form-control" name="image">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah image</small>
                            <br><br>
                        </div>
                    </div>

                    <div class="col">
                        {{-- File Pendukung --}}
                        <!-- Trigger the modal with a button -->
                        <br>
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
                                        <iframe src="{{ asset('storage/' . $artikel->file_pendukung) }}" frameborder="0"
                                            width="100%" height="400px" type="application/pdf"></iframe>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="">
                            <label for="file">File Pendukung <small class="text-danger">*upload file jika diperlukan
                                    (pdf)</small></label>
                            <input type="file" class="form-control" name="file_pendukung">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah file pendukung</small>
                        </div>
                    </div>
                </div>
                <br>
                <label for="">Status</label>
                <select name="status" id="status" class="form-control">
                    <option {{ $artikel->status == 'PUBLISH' ? 'selected' : '' }} value="PUBLISH">PUBLISH</option>
                    <option {{ $artikel->status == 'DRAFT' ? 'selected' : '' }} value="DRAFT">DRAFT</option>
                </select>
                <br>

                <button class="btn btn-primary" value="PUBLISH">Update</button>
            </div>
        </form>

    </div>
@endsection

@section('footer-scripts')
    {{-- Summernote css/js --}}
    <link rel="stylesheet" href="{{ asset('summernote/summernote-bs4.min.css') }}">
    <script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script>

    <script>
        $('#konten').summernote({
            height: 400,
            popatmouse: true,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['link', 'picture', 'video']],
            ]
        });
    </script>
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

        var skill = {!! $artikel->skill !!}

        skill.forEach(function(skill) {
            var option = new Option(skill.judul, skill.id, true, true);
            $('#skill').append(option).trigger('change');
        });

        var text = "{{ $artikel->file_pendukung }}";
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
