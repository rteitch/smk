@extends('layouts.global')

@section('title')
    Edit Job Class
@endsection

@section('content')
    <div class="col-md-8">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('jobclass.update', [$jobclass->id]) }}" enctype="multipart/form-data" method="POST"
            class="bg-white shadow-sm p-3">

            @csrf

            <input type="hidden" value="PUT" name="_method">

            <label>Job Class Name</label> <br>
            <input type="text" class="form-control" value="{{ $jobclass->name }}" name="name">
            <br>

            <label>Job Class Slug <small>(tidak perlu diedit)</small></label>
            <input disabled type="text" class="form-control" value="{{ $jobclass->slug }}" name="slug">
            <br>

            <label>Job Class Deskripsi</label> <br>
            <textarea name="deskripsi" class="form-control">{{ $jobclass->deskripsi }}</textarea>
            <br>

            <label>Job Class Image</label><br>
            @if ($jobclass->image)
                <small class="text-muted">Current image</small><br>
                <img src="{{ asset('storage/' . $jobclass->image) }}" width="120px">
                <br><br>
            @endif
            <input type="file" class="form-control" name="image">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
            <br><br>

            <input type="submit" class="btn btn-primary" value="Update">

        </form>
    </div>
@endsection
