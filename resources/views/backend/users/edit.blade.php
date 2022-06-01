@extends('layouts.global')

@section('title')
    Edit User
@endsection

@section('content')
    <div class="col-md-8">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form enctype="multipart/form-data" class="bg-white shadow-sm p-3"
            action="{{ route('users.update', [$user->id]) }}" method="POST">

            @csrf

            <input type="hidden" value="PUT" name="_method">
            <div class="row">
                {{-- Form Name --}}
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="name">Name</label>
                    <input value="{{ $user->name }}" class="form-control" placeholder="Full Name" type="text" name="name"
                        id="name" />
                    <br>
                </div>

                {{-- Form Nomor Induk --}}
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="nomorInduk">Nomor Induk (NIS / NIP)</label>
                    <input value="{{ $user->nomor_induk }}" class="form-control" placeholder="Nomor Induk (NIS / NIP)"
                        type="text" name="nomorInduk" id="nomorInduk" />
                    <br>
                </div>

                {{-- Form Phone --}}
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="phone">Phone number</label>
                    <br>
                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                </div>

                {{-- Form Tempat Lahir --}}
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="tempatLahir">Tempat Lahir</label>
                    <input class="form-control" placeholder="Tempat Lahir" type="text" name="tempatLahir" id="tempatLahir"
                        value="{{ $user->tempat_lahir }}">
                    <hr class="my-3">
                </div>

                {{-- Form Tanggal Lahir --}}
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="tanggalLahir">Tanggal Lahir</label>
                    <input class="form-control" placeholder="Tanggal Lahir" type="date" name="tanggalLahir"
                        id="tanggalLahir" value="{{ $user->tanggal_lahir }}">
                    <hr class="my-3">
                </div>

                {{-- Form Gender --}}
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label>Select</label>
                    <select class="form-control" name="gender">
                        <option value="Laki-Laki" {{ $user->gender == 'Laki-Laki' ? 'selected' : '' }} >Laki-Laki</option>
                        <option value="Perempuan" {{ $user->gender == 'Perempuan' ? 'selected' : '' }} >Perempuan</option>
                    </select>
                    <br>
                </div>

                {{-- Form Email --}}
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="email">Email</label>
                    <input value="{{ $user->email }}" disabled class="form-control" placeholder="user@mail.com"
                        type="text" name="email" id="email" />
                </div>

                {{-- Form Username --}}
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="username">Username</label>
                    <input value="{{ $user->username }}" disabled class="form-control" placeholder="username"
                        type="text" name="username" id="username" />
                    <br>
                </div>

                {{-- Form Alamat --}}
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control">{{ $user->alamat }}
                </textarea>
                    <br>
                </div>


                {{-- Form Avatar --}}
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <label for="avatar">Avatar image</label>
                    <br>
                    Current avatar: <br>
                    @if ($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" width="120px" />
                        <br>
                    @else
                        No avatar
                    @endif
                    <br>
                    <input id="avatar" name="avatar" type="file" class="form-control">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>
                    <hr class="my-3">
                </div>

                {{-- Form Background --}}
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <label for="background">Background image</label>
                    <br>
                    Current avatar: <br>
                    @if ($user->background)
                        <img src="{{ asset('storage/' . $user->background) }}" width="120px" />
                        <br>
                    @else
                        No background
                    @endif
                    <br>
                    <input id="background" name="background" type="file" class="form-control">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah background</small>
                    <hr class="my-3">
                </div>

                {{-- Form Status --}}
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="">Status</label>
                    <br />
                    <input {{ $user->status == 'on' ? 'checked' : '' }} value="on" type="radio" class="form-control"
                        id="on" name="status">
                    <label for="on">Online</label>

                    <input {{ $user->status == 'off' ? 'checked' : '' }} value="off" type="radio" class="form-control"
                        id="off" name="status">
                    <label for="off">Offline</label>
                    <br>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="">Roles</label>
                    <br>
                    <input type="checkbox" {{ in_array('0', json_decode($user->roles)) ? 'checked' : '' }} name="roles[]"
                        id="0" value="0">
                    <label for="0">Administrator</label>

                    <input type="checkbox" {{ in_array('1', json_decode($user->roles)) ? 'checked' : '' }} name="roles[]"
                        id="1" value="1">
                    <label for="1">Pengajar</label>

                    <input type="checkbox" {{ in_array('2', json_decode($user->roles)) ? 'checked' : '' }} name="roles[]"
                        id="2" value="2">
                    <label for="2">Siswa</label>
                </div>

                {{-- Form Level --}}
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    <label for="level">Level</label>
                    <input class="form-control" placeholder="level" type="integer" name="level" id="level"
                        value="{{ $user->level }}">
                    <br>
                </div>

                {{-- Form Skor --}}
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    <label for="skor">Skor</label>
                    <input class="form-control" placeholder="skor" type="float" name="skor" id="skor"
                        value="{{ $user->skor }}">
                    <br>
                </div>

                {{-- Form EXP --}}
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    <label for="exp">Exp</label>
                    <input class="form-control" placeholder="exp" type="float" name="exp" id="exp"
                        value="{{ $user->exp }}">
                    <br>
                </div>
            </div>

            <input class="btn btn-primary" type="submit" value="Save" />
        </form>
    </div>
@endsection
