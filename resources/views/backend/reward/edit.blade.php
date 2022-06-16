@extends('layouts.global')

@section('title')
    Edit Quest
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form enctype="multipart/form-data" method="POST" action="{{ route('reward.update', [$reward->id]) }}"
                class="p-3 shadow-sm bg-white">

                @csrf
                <input type="hidden" name="_method" value="PUT">


                <label for="title">Judul Reward</label> <br>
                <input type="text" class="form-control" name="title" placeholder="Judul Reward" value="{{ $reward->title }}">
                <br>

                <label for="slug">Slug <small>(tidak perlu diedit)</small></label><br>
                <input disabled type="text" class="form-control" value="{{ $reward->slug }}" name="slug"
                    placeholder="enter-a-slug" />
                <br>

                <label for="image">Image</label><br>
                <small class="text-muted">Current image</small><br>
                @if ($reward->image)
                    <img src="{{ asset('storage/' . $reward->image) }}" width="96px" />
                @endif
                <br><br>

                <input type="file" class="form-control" name="image">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah image</small>
                <br><br>

                <label for="deskripsi">Deskripsi</label><br>
                <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Berikan Deskripsi Reward">{{ $reward->deskripsi }}</textarea>
                <br>

                {{-- Form Skor --}}
                <label for="syarat_skor">Syarat Skor</label>
                <input class="form-control" placeholder="syarat skor" type="float" name="syarat_skor" id="syarat_skor" value="{{ $reward->syarat_skor }}">
                <br>

                <label for="pembuat">Pembuat <small>(tidak perlu diedit)</small></label>
                <input placeholder="pembuat" value="{{ $reward->pembuat }}" type="text" id="pembuat" name="pembuat"
                    class="form-control">
                <br>

                <label for="">Status</label>
                <select name="status" id="status" class="form-control">
                    <option {{ $reward->status == 'PUBLISH' ? 'selected' : '' }} value="PUBLISH">PUBLISH</option>
                    <option {{ $reward->status == 'DRAFT' ? 'selected' : '' }} value="DRAFT">DRAFT</option>
                </select>
                <br>

                <button class="btn btn-primary" value="PUBLISH">Update</button>

            </form>
        </div>
    </div>
@endsection
