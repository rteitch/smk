@extends('layouts.global')

@section('title')
    Edit Skill
@endsection

@section('content')
    <div class="col-md-8">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('skill.update', [$skills->id]) }}" enctype="multipart/form-data" method="POST"
            class="bg-white shadow-sm p-3">

            @csrf

            <input type="hidden" value="PUT" name="_method">

            <label>Skill Judul</label> <br>
            <input type="text" class="form-control" value="{{ $skills->judul }}" name="judul">
            <br>

            <label>Skill Slug <small>(tidak perlu diedit)</small></label>
            <input disabled type="text" class="form-control" value="{{ $skills->slug }}" name="slug">
            <br>

            <label>Skill Deskripsi</label> <br>
            <textarea name="deskripsi" class="form-control">{{ $skills->deskripsi }}</textarea>
            <br>

            <label>Syarat Level Player</label> <br>
            <input type="number" class="form-control" value="{{ $skills->syarat_lv }}" name="syarat_lv">
            <br>
            <label>Jumlah Kuota Skill</label> <br>
            <input type="number" class="form-control" value="{{ $skills->qty }}" name="qty">
            <br>

            <label>Skill Image</label><br>
            @if ($skills->image)
                <span>Current image</span><br>
                <img src="{{ asset('storage/' . $skills->image) }}" width="120px">
                <br><br>
            @endif
            <input type="file" class="form-control" name="image">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
            <br><br>

            <input type="submit" class="btn btn-primary" value="Update">

        </form>
    </div>
@endsection
