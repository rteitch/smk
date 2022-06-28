@extends('layouts.global')
@section('title')
    - Create User
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Menambah User Baru</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('users.index') }}">Manajemen User</a> </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-md-10">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{ route('users.store') }}"
            method="POST">
            @csrf
            <div class="row">
                {{-- Form Name --}}
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="name">Name</label>
                    <input value="{{ old('name') }}"
                        class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" placeholder="Nama Lengkap"
                        type="text" name="name" id="name">
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                    <br>
                </div>

                {{-- Form Nomor Induk --}}
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="nomorInduk">Nomor Induk (NIS / NIP)</label>
                    <input value="{{ old('nomorInduk') }}"
                        class="form-control {{ $errors->first('nomorInduk') ? 'is-invalid' : '' }}"
                        placeholder="Nomor Induk (NIS / NIP)" type="integer" name="nomorInduk" id="nomorInduk">
                    <div class="invalid-feedback">
                        {{ $errors->first('nomorInduk') }}
                    </div>
                    <br>
                </div>

                {{-- Form Phone --}}
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="phone">Phone number</label>
                    <br>
                    <input value="{{ old('phone') }}" type="integer" name="phone"
                        class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}" placeholder="08...">
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                    <hr class="my-3">
                </div>

                {{-- Form Tempat Lahir --}}
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="tempatLahir">Tempat Lahir</label>
                    <input value="{{ old('tempatLahir') }}"
                        class="form-control {{ $errors->first('tempatLahir') ? 'is-invalid' : '' }}"
                        placeholder="Tempat Lahir" type="text" name="tempatLahir" id="tempatLahir">
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                    <br>
                </div>

                {{-- Form Tanggal Lahir --}}
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="tanggalLahir">Tanggal Lahir</label>
                    <input value="{{ old('tanggalLahir') }}"
                        class="form-control {{ $errors->first('tanggalLahir') ? 'is-invalid' : '' }}"
                        placeholder="Tanggal Lahir" type="date" name="tanggalLahir" id="tanggalLahir">
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                    <br>
                </div>

                {{-- Form Gender --}}
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label>Select</label>
                    <select class="form-control {{ $errors->first('gender') ? 'is-invalid' : '' }}" name="gender">
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                    <br>
                </div>

                {{-- Form Username --}}
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">

                    <label for="username">Username</label>
                    <input value="{{ old('username') }}"
                        class="form-control {{ $errors->first('username') ? 'is-invalid' : '' }}" placeholder="username"
                        type="text" name="username" id="username" />
                    <br>
                    <div class="invalid-feedback">
                        {{ $errors->first('username') }}
                    </div>
                </div>

                {{-- Form Email --}}
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="email">Email</label>
                    <input value="{{ old('email') }}"
                        class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" placeholder="user@..."
                        type="text" name="email" id="email" />
                    <div class="invalid-feedback">
                        {{ $errors->first('username') }}
                    </div>
                    <hr class="my-3">
                </div>

                {{-- Form Password --}}
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="password">Password</label>
                    <input value="{{ old('password') }}"
                        class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}" placeholder="password"
                        type="password" name="password" id="password" />
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                    <hr class="my-3">
                </div>


                {{-- Form Password Konfirmasi --}}
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="password_confirmation">Password Confirmation</label>
                    <input value="{{ old('password_confirmation') }}"
                        class="form-control {{ $errors->first('password_confirmation') ? 'is-invalid' : '' }}"
                        placeholder="password confirmation" type="password" name="password_confirmation"
                        id="password_confirmation" />
                    <div class="invalid-feedback">
                        {{ $errors->first('password_confirmation') }}
                    </div>
                    <hr class="my-3">
                </div>

                {{-- Form Alamat --}}
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}">{{ old('alamat') }}</textarea>
                    <div class="invalid-feedback">
                        {{ $errors->first('password_confirmation') }}
                    </div>
                    <br>
                </div>

                {{-- Form Avatar --}}
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <label for="avatar">Avatar image</label>
                    <br>
                    <input value="{{ old('avatar') }}" id="avatar" name="avatar" type="file"
                        class="form-control {{ $errors->first('avatar') ? 'is-invalid' : '' }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('avatar') }}
                    </div>
                    <hr class="my-3">
                </div>

                {{-- Form Background --}}
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <label for="background">Background image</label>
                    <br>
                    <input value="{{ old('background') }}" id="background" name="background" type="file"
                        class="form-control {{ $errors->first('background') ? 'is-invalid' : '' }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('background') }}
                    </div>
                    <hr class="my-3">
                </div>

                {{-- Job Class Choice --}}

                <div class="col-lg-4 col-md-12">
                    <label for="jobclass">Job Class</label><br>

                    <select name="jobclass[]" multiple id="jobclass"
                        class="form-control {{ $errors->first('jobclass') ? 'is-invalid' : '' }}">
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('jobclass') }}
                    </div>
                </div>

                {{-- Skill Choice --}}
                <div class="col-lg-4 col-md-12">
                    <label for="skill">Skill <small class="text-danger">*sesuaikan skill</small></label><br>
                    <select class="form-control" name="skill[]" multiple id="skill">
                    </select>
                </div>

                {{-- Form Roles --}}
                <div class="col-xl-3 col-lg-5 col-md-12 col-sm-12 col-12">
                    <label for="">Roles</label>
                    <br>
                    <input class="form-control {{ $errors->first('roles') ? 'is-invalid' : '' }}" type="checkbox"
                        name="roles[]" id="0" value="0">
                    <label for="0">Administrator</label>

                    <input class="form-control {{ $errors->first('roles') ? 'is-invalid' : '' }}" type="checkbox"
                        name="roles[]" id="1" value="1">
                    <label for="1">Pengajar</label>

                    <input class="form-control {{ $errors->first('roles') ? 'is-invalid' : '' }}" type="checkbox"
                        name="roles[]" id="2" value="2">
                    <label for="2">Siswa</label>
                    <div class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </div>
                    <br>
                </div>

                <div class="col-xl-3 col-lg-2 col-md-12 col-sm-12 col-12">
                    {{-- Form Level --}}
                    <label for="level">Level</label>
                    <input value="{{ old('level') }}"
                        class="form-control {{ $errors->first('level') ? 'is-invalid' : '' }}" placeholder="level"
                        type="integer" name="level" id="level">
                    <div class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </div>
                    <br>
                </div>

                <div class="col-xl-3 col-lg-2 col-md-12 col-sm-12 col-12">
                    {{-- Form Skor --}}
                    <label for="skor">Skor</label>
                    <input value="{{ old('skor') }}"
                        class="form-control {{ $errors->first('skor') ? 'is-invalid' : '' }}" placeholder="skor"
                        type="float" name="skor" id="skor">
                    <div class="invalid-feedback">
                        {{ $errors->first('skor') }}
                    </div>
                    <br>
                </div>

                <div class="col-xl-3 col-lg-2 col-md-12 col-sm-12 col-12">
                    {{-- Form EXP --}}
                    <label for="exp">Exp</label>
                    <input value="{{ old('exp') }}"
                        class="form-control {{ $errors->first('exp') ? 'is-invalid' : '' }}" placeholder="exp"
                        type="float" name="exp" id="exp">
                    <div class="invalid-feedback">
                        {{ $errors->first('exp') }}
                    </div>
                    <br>
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <hr class="my-3">
                </div>
                {{-- Job Skill / Program Keahlian --}}

            </div>

            {{-- button submit --}}
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
                url: 'http://127.0.0.1:8000/ajax/jobclass/search',
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
                url: 'http://127.0.0.1:8000/ajax/skill/search',
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
    </script>
@endsection
