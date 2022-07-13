@extends('layouts.global')

@section('title')
    Edit Reward
@endsection

@section('dashboard-active')
    active
@endsection

@section('da-collapse-in')
    in
@endsection

@section('dash-reward-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Manajemen Reward</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('reward.index') }}">Manajemen Reward</a> </li>
                    <li class="breadcrumb-item active"> <a href="{{ route('reward.edit', $rewards->id) }}">Manajemen Reward</a> </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
    </div>
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
