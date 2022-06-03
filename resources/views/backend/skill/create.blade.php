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

            <label>Skill name</label><br>
            <input type="text" class="form-control" name="name" />
            <br>

            <label>Deskripsi Skill</label><br>
            <textarea name="deskripsi" class="form-control"></textarea>
            <br>

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
