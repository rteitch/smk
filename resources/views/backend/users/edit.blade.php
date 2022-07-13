@extends('layouts.global')

@section('title')
    Edit User
@endsection

@section('dashboard-active')
    active
@endsection

@section('da-collapse-in')
    in
@endsection

@section('dash-user-active')
    active
@endsection


@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Manajemen User</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item"> <a href="{{ route('users.index') }}">Manajemen User</a> </li>
                    <li class="breadcrumb-item active"> <a href="{{ route('users.edit', [$user->id]) }}">Edit User :
                            {{ $user->name }}</a> </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
        <style>
            .select2 {
                width: 100% !important;
            }
        </style>
    </div>
@endsection

@section('content')
    <div class="col-md-10">
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
                <div class="col-lg-4 col-md-12">
                    <label for="name">Nama</label>
                    <input value="{{ old('name') ? old('name') : $user->name }}"
                        class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" placeholder="Full Name"
                        type="text" name="name" id="name" />

                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                    <br>
                </div>

                {{-- Form Nomor Induk --}}
                <div class="col-lg-4 col-md-12">
                    <label for="nomorInduk">Nomor Induk (NIS / NIP)</label>
                    <input value="{{ old('nomorInduk') ? old('nomorInduk') : $user->nomor_induk }}"
                        class="form-control {{ $errors->first('nomorInduk') ? 'is-invalid' : '' }}"
                        placeholder="Nomor Induk (NIS / NIP)" type="text" name="nomorInduk" id="nomorInduk" />
                    <div class="invalid-feedback">
                        {{ $errors->first('nomorInduk') }}
                    </div>
                    <br>
                </div>

                {{-- Form Phone --}}
                <div class="col-lg-4 col-md-12">
                    <label for="phone">Nomor Hp</label>
                    <br>
                    <input type="text" name="phone"
                        class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}"
                        value="{{ old('phone') ? old('phone') : $user->phone }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                    <br>
                </div>

                {{-- Form Tempat Lahir --}}
                <div class="col-lg-4 col-md-12">
                    <label for="tempatLahir">Tempat Lahir</label>
                    <input class="form-control {{ $errors->first('tempatLahir') ? 'is-invalid' : '' }}"
                        placeholder="Tempat Lahir" type="text" name="tempatLahir" id="tempatLahir"
                        value="{{ old('tempatLahir') ? old('tempatLahir') : $user->tempat_lahir }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('tempatLahir') }}
                    </div>
                    <br>
                </div>

                {{-- Form Tanggal Lahir --}}
                <div class="col-lg-4 col-md-12">
                    <label for="tanggalLahir">Tanggal Lahir</label>
                    <input class="form-control {{ $errors->first('tanggalLahir') ? 'is-invalid' : '' }}"
                        placeholder="Tanggal Lahir" type="date" name="tanggalLahir" id="tanggalLahir"
                        value="{{ old('tanggalLahir') ? old('tanggalLahir') : $user->tanggal_lahir }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('tanggalLahir') }}
                    </div>
                    <br>
                </div>

                {{-- Form Gender --}}
                <div class="col-lg-4 col-md-12">
                    <label>Jenis Kelamin</label>
                    <select class="form-control {{ $errors->first('gender') ? 'is-invalid' : '' }}" name="gender">
                        <option value="Laki-Laki" {{ $user->gender == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                        <option value="Perempuan" {{ $user->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                    <br>
                </div>

                {{-- Form Username --}}
                <div class="col-lg-6 col-md-12">
                    <label for="username">Username</label>
                    <input value="{{ $user->username }}" disabled
                        class="form-control" placeholder="username"
                        type="text" name="username" id="username" />
                    <br>
                </div>

                {{-- Form Email --}}
                <div class="col-lg-6 col-md-12">
                    <label for="email">Email</label>
                    <input value="{{ $user->email }}" disabled
                        class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                        placeholder="user@mail.com" type="text" name="email" id="email" />
                    <br>
                </div>

                {{-- Form Alamat --}}
                <div class="col-lg-12 col-md-12">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}">{{ old('alamat') ? old('alamat') : $user->alamat }}
                </textarea>
                    <div class="invalid-feedback">
                        {{ $errors->first('alamat') }}
                    </div>
                    <br>
                </div>


                {{-- Form Avatar --}}
                <div class="col-lg-12 col-md-12">
                    <label for="avatar">Avatar image</label>
                    <br>
                    @if ($user->avatar)
                        <small class="text-muted">Current avatar</small><br>
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
                <div class="col-lg-12 col-md-12">
                    <label for="background">Background image</label>
                    <br>
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
                @if (json_decode(Auth::user()->roles) == array_intersect(['0']))
                    {{-- Job Class Choice --}}

                    <div class="col-lg-6 col-md-12">
                        <label for="jobclass">Job Class</label><br>
                        <select name="jobclass[]" multiple id="jobclass" class="form-control">
                        </select>
                        <br><br>
                    </div>


                    {{-- Skill Choice --}}
                    <div class="col-lg-6 col-md-12">
                        <label for="skill">Skill</label>
                        <select class="form-control" multiple class="form-control" name="skill[]"
                            id="skill"></select>
                        <br><br>
                    </div>

                    {{-- Form Status --}}

                    <div class="form-group col-lg-6 col-md-12">
                        <label>Status</label>
                        <br />
                        <label class="fancy-radio">
                            <input {{ $user->status == 'on' ? 'checked' : '' }} value="on" type="radio"
                                class="form-control" id="on" name="status">
                            <span><i></i>Online</span>
                        </label>
                        <label class="fancy-radio">
                            <input {{ $user->status == 'off' ? 'checked' : '' }} value="off" type="radio"
                                class="form-control" id="off" name="status">
                            <span><i></i>Offline</span>
                        </label>
                    </div>

                    {{-- Form Roles --}}
                    <div class="form-group col-lg-6 col-md-12">
                        <label>Roles</label>
                        <br>
                        <label class="fancy-checkbox">
                            <input {{ in_array('0', json_decode($user->roles)) ? 'checked' : '' }} type="checkbox"
                                name="roles[]" value="0">
                            <span>Administrator</span>
                        </label>
                        <label class="fancy-checkbox">
                            <input {{ in_array('1', json_decode($user->roles)) ? 'checked' : '' }} type="checkbox"
                                name="roles[]" value="1">
                            <span>Pengajar</span>
                        </label>
                        <label class="fancy-checkbox">
                            <input {{ in_array('2', json_decode($user->roles)) ? 'checked' : '' }} type="checkbox"
                                name="roles[]" value="2">
                            <span>Siswa</span>
                        </label>
                        <div class="invalid-feedback">
                            {{ $errors->first('roles') }}
                        </div>
                    </div>

                    {{-- Form Level --}}
                    <div class="col-lg-4 col-md-12">
                        <label for="level">Level</label>
                        <input class="form-control" placeholder="level" type="integer" name="level" id="level"
                            value="{{ $user->level }}">
                        <br>
                    </div>

                    {{-- Form Skor --}}
                    <div class="col-lg-4 col-md-12">
                        <label for="skor">Skor</label>
                        <input class="form-control" placeholder="skor" type="float" name="skor" id="skor"
                            value="{{ $user->skor }}">
                        <br>
                    </div>

                    {{-- Form EXP --}}
                    <div class="col-lg-4 col-md-12">
                        <label for="exp">Exp</label>
                        <input class="form-control" placeholder="exp" type="float" name="exp" id="exp"
                            value="{{ $user->exp }}">
                        <br>
                    </div>
            </div>
            @endif


            <input class="btn btn-primary" type="submit" value="Save" />
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

        $('#skill').select2({
            ajax: {
                url: 'https://ga-smkn2solo.online/ajax/skill/search',
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.judul
                            }
                        })
                    }
                }
            }
        });

        var jobclass = {!! $user->jobclass !!}

        jobclass.forEach(function(jobclass) {
            var option = new Option(jobclass.name, jobclass.id, true, true);
            $('#jobclass').append(option).trigger('change');
        });

        var skill = {!! $user->skill !!}

        skill.forEach(function(skill) {
            var option = new Option(skill.judul, skill.id, true, true);
            $('#skill').append(option).trigger('change');
        });
    </script>
@endsection
