@extends('layouts.news')

@section('title')
    Create Category
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col mt-4">
                <div class="card">
                    <div class="card-header">
                        Create News
                    </div>
                    <div class="card-body">
                        <form method="post" action="" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Judul :</label>
                                <input class="form-control" type="text">
                                <br>
                                <label for="konten">Konten :</label>
                                <textarea class="ckeditor form-control" name="konten" id="konten"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-scripts')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('konten', {
            filebrowserUploadUrl: "{{ route('news.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
            filebrowserBrowseUrl: '/browser/browse.php',
            height: 360
        });
    </script>
@endsection
