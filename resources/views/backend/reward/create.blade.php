@extends('layouts.global')

@section('title')
    Create Reward
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('reward.store') }}" method="POST" enctype="multipart/form-data"
                class="shadow-sm p-3 bg-white">

                @csrf

                <label for="title">Judul Reward</label> <br>
                <input type="text" class="form-control" name="judul" placeholder="Judul Reward">
                <br>

                <label for="image">Image</label>
                <input type="file" class="form-control" name="image">
                <br>

                <label for="deskripsi">Deskripsi</label><br>
                <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Berikan Deskripsi Quest"></textarea>
                <br>

                {{-- Form Skor --}}
                <label for="syarat_skor">Syarat Skor</label>
                <input class="form-control" placeholder="skor" type="float" name="skor" id="skor">
                <br>


                <button class="btn btn-primary" name="save_action" value="PUBLISH">Publish</button>

                <button class="btn btn-secondary" name="save_action" value="DRAFT">Save as draft</button>
            </form>
        </div>
    </div>
@endsection
