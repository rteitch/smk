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
                <input value="{{ old('title') }}" type="text"
                    class="form-control {{ $errors->first('title') ? 'is-invalid' : '' }}" name="title"
                    placeholder="Judul Reward">
                <div class="invalid-feedback">
                    {{ $errors->first('title') }}
                </div>
                <br>

                <label for="image">Image</label>
                <input value="{{ old('image') }}" type="file"
                    class="form-control {{ $errors->first('image') ? 'is-invalid' : '' }}" name="image">
                <div class="invalid-feedback">
                    {{ $errors->first('image') }}
                </div>
                <br>

                <label for="deskripsi">Deskripsi</label><br>
                <textarea name="deskripsi" id="deskripsi" class="form-control {{ $errors->first('deskripsi') ? 'is-invalid' : '' }}"
                    placeholder="Berikan Deskripsi Quest">{{ old('deskripsi') }}</textarea>
                <div class="invalid-feedback">
                    {{ $errors->first('deskripsi') }}
                </div>
                <br>

                {{-- Form Skor --}}
                <label for="syarat_skor">Syarat Skor</label>
                <input value="{{ old('syarat_skor') }}"
                    class="form-control {{ $errors->first('syarat_skor') ? 'is-invalid' : '' }}"
                    placeholder="syarat skor" type="float" name="syarat_skor" id="skor">
                <div class="invalid-feedback">
                    {{ $errors->first('syarat_skor') }}
                </div>
                <br>


                <button class="btn btn-primary" name="save_action" value="PUBLISH">Publish</button>

                <button class="btn btn-secondary" name="save_action" value="DRAFT">Save as draft</button>
            </form>
        </div>
    </div>
@endsection
