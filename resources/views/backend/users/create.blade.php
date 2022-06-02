@extends('layouts.global')
@section('title')
    - Create User
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
                    <input class="form-control" placeholder="Nama Lengkap" type="text" name="name" id="name">
                    <br>
                </div>

                {{-- Form Nomor Induk --}}
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="nomorInduk">Nomor Induk (NIS / NIP)</label>
                    <input class="form-control" placeholder="Nomor Induk (NIS / NIP)" type="integer" name="nomorInduk"
                        id="nomorInduk">
                    <br>
                </div>

                {{-- Form Phone --}}
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="phone">Phone number</label>
                    <br>
                    <input type="integer" name="phone" class="form-control" placeholder="08...">
                    <hr class="my-3">
                </div>

                {{-- Form Tempat Lahir --}}
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="tempatLahir">Tempat Lahir</label>
                    <input class="form-control" placeholder="Tempat Lahir" type="text" name="tempatLahir"
                        id="tempatLahir">
                    <br>
                </div>

                {{-- Form Tanggal Lahir --}}
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="tanggalLahir">Tanggal Lahir</label>
                    <input class="form-control" placeholder="Tanggal Lahir" type="date" name="tanggalLahir"
                        id="tanggalLahir">
                    <br>
                </div>

                {{-- Form Gender --}}
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label>Select</label>
                    <select class="form-control" name="gender">
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <br>
                </div>

                {{-- Form Username --}}
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">

                    <label for="username">Username</label>
                    <input class="form-control" placeholder="username" type="text" name="username" id="username" />
                    <br>
                </div>

                {{-- Form Email --}}
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="email">Email</label>
                    <input class="form-control" placeholder="user@gmail.com" type="text" name="email" id="email" />
                    <hr class="my-3">
                </div>

                {{-- Form Password --}}
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="password">Password</label>
                    <input class="form-control" placeholder="password" type="password" name="password" id="password" />
                    <hr class="my-3">
                </div>


                {{-- Form Password Konfirmasi --}}
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <label for="password_confirmation">Password Confirmation</label>
                    <input class="form-control" placeholder="password confirmation" type="password"
                        name="password_confirmation" id="password_confirmation" />
                    <hr class="my-3">
                </div>

                {{-- Form Alamat --}}
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control"></textarea>
                    <br>
                </div>

                {{-- Form Avatar --}}
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <label for="avatar">Avatar image</label>
                    <br>
                    <input id="avatar" name="avatar" type="file" class="form-control">
                    <hr class="my-3">
                </div>

                {{-- Form Background --}}
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <label for="background">Background image</label>
                    <br>
                    <input id="background" name="background" type="file" class="form-control">
                    <hr class="my-3">
                </div>

                {{-- Job Class Choice --}}

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <label for="jobclass">Job Class</label><br>

                    <select name="jobclass[]" multiple id="jobclass" class="form-control">
                    </select>
                </div>

                {{-- Form Roles --}}
                <div class="col-xl-3 col-lg-5 col-md-12 col-sm-12 col-12">
                    <label for="">Roles</label>
                    <br>
                    <input type="checkbox" name="roles[]" id="0" value="0">
                    <label for="0">Administrator</label>

                    <input type="checkbox" name="roles[]" id="1" value="1">
                    <label for="1">Pengajar</label>

                    <input type="checkbox" name="roles[]" id="2" value="2">
                    <label for="2">Siswa</label>
                    <br>
                </div>

                <div class="col-xl-3 col-lg-2 col-md-12 col-sm-12 col-12">
                    {{-- Form Level --}}
                    <label for="level">Level</label>
                    <input class="form-control" placeholder="level" type="integer" name="level" id="level">
                    <br>
                </div>

                <div class="col-xl-3 col-lg-2 col-md-12 col-sm-12 col-12">
                    {{-- Form Skor --}}
                    <label for="skor">Skor</label>
                    <input class="form-control" placeholder="skor" type="float" name="skor" id="skor">
                    <br>
                </div>

                <div class="col-xl-3 col-lg-2 col-md-12 col-sm-12 col-12">
                    {{-- Form EXP --}}
                    <label for="exp">Exp</label>
                    <input class="form-control" placeholder="exp" type="float" name="exp" id="exp">
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
    </script>
@endsection
