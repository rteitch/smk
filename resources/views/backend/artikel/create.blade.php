@extends('layouts.global')

@section('title')
    Create Category
@endsection

@section('dashboard-active')
    active
@endsection

@section('da-collapse-in')
    in
@endsection

@section('dash-artikel-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Manajemen Artikel</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('quest.trash') }}">Manajemen Artikel</a> </li>
                    <li class="breadcrumb-item active"> <a href="{{ route('artikel.create') }}">Tambah Artikel</a> </li>
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
    <div class="container">
        <div class="row">

            <div class="col mt-4">

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('artikel.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    {{-- Skill Choice --}}
                                    <label for="skill">Skill <small class="text-danger">*sesuaikan kategori
                                            skill</small></label><br>
                                    <select class="form-control" name="skill[]" multiple id="skill">
                                    </select>
                                    <br><br>
                                    <label for="title">Judul :</label>
                                    <input class="form-control" type="text" name="title">
                                    <br>

                                    <label for="">Konten :</label>
                                    <textarea class="form-control" name="konten" id="konten"></textarea>
                                    <br>
                                    <div class="row">
                                        <div class="col">
                                            <label for="image">Image Utama</label>
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                        <div class="col">
                                            <label for="file">File Pendukung <small class="text-danger">*upload file
                                                    jika
                                                    diperlukan</small></label>
                                            <input type="file" class="form-control" name="file_pendukung">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-lg-12 col-md-12 text-right">
                                        <button class="btn btn-primary" name="save_action" value="PUBLISH">Publish</button>

                                        <button class="btn btn-secondary" name="save_action" value="DRAFT">Save as
                                            draft</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                ['insert', ['link', 'picture']],
            ]
        });
    </script>
    {{-- ckeditor tidak digunakan --}}
    {{-- <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').CKEDITOR;
        });
    </script>
    <script type="text/javascript">
        CKEDITOR.replace('konten', {
            filebrowserUploadUrl: "{{ route('artikel.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
            // belum dibuat route ke filemanager lanjut kapan"
            // filebrowserBrowseUrl: '/browser/browse.php',
            height: 360
        });
    </script> --}}

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $('#skill').select2({
            ajax: {
                url: 'http://ga-smkn2solo.online/ajax/skill/search',
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
