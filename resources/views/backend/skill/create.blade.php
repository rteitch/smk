@extends('layouts.global')

@section('title')
    Create Skill
@endsection

@section('content')
    <div class="col-md-8">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{ route('skill.store') }}"
            method="POST">

            @csrf

            <label>Judul Skill</label><br>
            <input type="text" class="form-control" name="judul" />
            <br>

            <label>Deskripsi Skill</label><br>
            <textarea name="deskripsi" class="form-control"></textarea>
            <br>

            {{-- Job Class Choice --}}

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <label for="jobclass">Job Class</label><br>
                <select name="jobclass[]" multiple id="jobclass" class="form-control">
                </select>
                <br><br>
            </div>

            <label>Syarat Level Player</label><br>
            <input type="number" name="syarat_lv" class="form-control">
            <br>

            <label>Jumlah Kuota Skill</label><br>
            <input type="number" name="qty" class="form-control">
            <br>

            <label>Skill image</label>
            <input type="file" class="form-control" name="image" />

            <br>

            <input type="submit" class="btn btn-primary" value="Save" />

        </form>
    </div>
@endsection

@section('footer-scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $('#jobclass').select2({
            ajax: {
                url: 'http://127.0.0.1:8000/ajax/jobclass/search',
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.name
                            }
                        })
                    }
                }
            }
        });
    </script>
@endsection
