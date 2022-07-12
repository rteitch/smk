@extends('layouts.global')

@section('title')
    Edit Skill
@endsection

@section('dashboard-active')
    active
@endsection

@section('da-collapse-in')
    in
@endsection

@section('dash-skill-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Edit Skill</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item"> <a href="{{ route('skill.index') }}">Manajemen Skill</a> </li>
                    <li class="breadcrumb-item active"> <a href="{{ route('skill.edit', [$skills->id]) }}">Edit Skill :
                            {{ $skills->judul }}</a> </li>
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
    <div class="col-md-10">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('skill.update', [$skills->id]) }}" enctype="multipart/form-data" method="POST"
            class="bg-white shadow-sm p-3">

            @csrf

            <input type="hidden" value="PUT" name="_method">
            <div class="col-lg-12 col-md-12">
                <label>Skill Judul</label> <br>
                <input type="text" class="form-control" value="{{ $skills->judul }}" name="judul">
                <br>
            </div>

            <div class="col-lg-12 col-md-12">
                <label>Skill Deskripsi</label> <br>
                <textarea name="deskripsi" class="form-control">{{ $skills->deskripsi }}</textarea>
                <br>
            </div>

            <div class="col-lg-12 col-md-12">
                <label>Syarat Level Player</label> <br>
                <input type="number" class="form-control" value="{{ $skills->syarat_lv }}" name="syarat_lv">
                <br>
            </div>


            <div class="col-lg-12 col-md-12">
                {{-- Job Class Choice --}}
                <label for="jobclass">Job Class</label><br>

                <select name="jobclass[]" multiple id="jobclass" class="form-control">
                </select>
                <br>
                <br>
            </div>
            <div class="col-lg-12 col-md-12">
                <label>Skill Image</label><br>
                @if ($skills->image)
                    <small class="text-muted">Current image</small><br>
                    <img src="{{ asset('storage/' . $skills->image) }}" width="120px">
                    <br><br>
                @endif
                <input type="file" class="form-control" name="image">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                <br>
            </div>
            <div class="col-lg-12 col-md-12 text-right">
                <input type="submit" class="btn btn-primary" value="Update">
            </div>

        </form>
    </div>
@endsection
@section('footer-scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $('#jobclass').select2({
            ajax: {
                url: 'https://ga-smkn2solo.online/ajax/jobclass/search',
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

        var jobclass = {!! $skills->jobclass !!}

        jobclass.forEach(function(jobclass) {
            var option = new Option(jobclass.name, jobclass.id, true, true);
            $('#jobclass').append(option).trigger('change');
        });
    </script>
@endsection
