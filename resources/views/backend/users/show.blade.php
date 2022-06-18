@extends('layouts.global')

@section('title')
    Detail user
@endsection

@section('content')
    <div class="col-md-8">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header bg-info text-center text-light border-0"
                    style="background-image: url({{ asset('storage/' . $user->background) }}); background-size: 100%">
                    <div class="text-left w-100">
                        <h5 class="m-0">{{ $user->name }}</h5>
                        @foreach (json_decode($user->roles) as $role)
                            @if ($role == '0')
                                <small>Pegawai</small>
                            @break

                        @elseif ($role == '1')
                            <small>Pegawai</small>
                        @break

                    @elseif ($role == '2')
                        <small>Siswa</small>
                    @break
                @endif
            @endforeach
        </div>
        @if ($user->avatar)
            <img class="w-25 h-25 clearfix rounded-circle border border-white"
                style="border-width: 3px !important;margin-bottom: -3rem;clear: both;"
                src="{{ asset('storage/' . $user->avatar) }}" alt="users">
        @else
            No avatar
        @endif
    </div>
    <div class="card-body text-center d-flex flex-row justify-content-between pt-4 mt-4">
        <div class="col text-align border-right">
            <h6 class="fw-bold m-0">{{ $user->level }}</h6>
            <small>Level</small>
        </div>
        <div class="col text-align border-right">
            <h6 class="fw-bold m-0">{{ $user->skor }}</h6>
            <small>Skor</small>
        </div>
        <div class="col text-align">
            <h6 class="fw-bold m-0">{{ $user->jobclass->count() }}</h6>
            <small>Job Class</small>
        </div>
        <div class="col text-align">
            <h6 class="fw-bold m-0">{{ $user->skill->count() }}</h6>
            <small>Skill</small>
        </div>
    </div>
    <div class="progress">
        <div style="width: 100%" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
            aria-valuemax="100">Exp :
            {{ $user->exp }} %
        </div>
    </div>
    {{-- Button untuk edit dan ubah password --}}
    @if (\Auth::user())
        @if (\Auth::user()->id == $user->id)
            <div class="row pl-3 pt-3 pb-4 pr-3 text-center">
                <div class="col">
                    <a class="btn btn-block btn-info text-white btn-sm"
                        href="{{ route('users.edit', [$user->id]) }}">Edit</a>
                </div>
                <div class="col">
                    <a class="btn btn-block btn-primary text-white btn-sm"
                        href="{{ route('auth.change-password') }}">Ubah Password</a>
                </div>
            </div>
        @elseif (json_decode(Auth::user()->roles) == array_intersect(['0']))
            <div class="row pl-3 pt-3 pb-4 pr-3 text-center">
                <div class="col">
                    <a class="btn btn-block btn-info text-white btn-sm"
                        href="{{ route('users.edit', [$user->id]) }}">Edit</a>
                </div>
                <div class="col">
                    <a class="btn btn-block btn-primary text-white btn-sm"
                        href="{{ route('users.edit', [$user->id]) }}">Ubah Password</a>
                </div>
            </div>
        @endif
    @else
    @endif

    <div>
        <table class="table table-border">
            <tr>
                <td>
                    <b>Nomor Induk
                        @foreach (json_decode($user->roles) as $role)
                            @if ($role == '0')
                                Pegawai
                            @break

                        @elseif ($role == '1')
                            Pegawai
                        @break

                    @elseif ($role == '2')
                        Siswa
                    @break
                @endif
            @endforeach
        </b>
    </td>
    <td>: {{ $user->nomor_induk }}</td>
</tr>
<tr>
    <td><b>Username</b></td>
    <td>: {{ $user->username }}</td>
</tr>
<tr>
    <td><b>Nama</b></td>
    <td>: {{ $user->name }}</td>
</tr>
<tr>
    <td><b>Job Class</b>
    </td>
    <td>:
        @foreach ($user->jobclass as $jobclass)
            <a href="{{ route('jobclass.show', $jobclass->id) }}">{{ $jobclass->name }}</a>,
        @endforeach
    </td>

</tr>
<tr>
    <td><b>Skill</b></td>
    <td>:
        @foreach ($user->skill as $skills)
            <a href="{{ route('jobclass.show', $skills->id) }}">{{ $skills->judul }}</a>,
        @endforeach
    </td>
</tr>
<tr>
    <td><b>Gender</b></td>
    <td>: {{ $user->gender }}</td>
</tr>
<tr>
    <td><b>Phone</b></td>
    <td>: {{ $user->phone }}</td>
</tr>
<tr>
    <td><b>Tempat Lahir</b></td>
    <td>: {{ $user->tempat_lahir }}</td>
</tr>
<tr>
    <td><b>Tanggal Lahir</b></td>
    <td>: {{ $user->tanggal_lahir }}</td>
</tr>
<tr>
    <td><b>Alamat</b></td>
    <td>: {{ $user->alamat }}</td>
</tr>

{{-- Roles --}}
<tr>
    <td><b>Roles</b></td>
    <td>: @foreach (json_decode($user->roles) as $role)
            @if ($role == '0')
                &middot; Admin
            @elseif ($role == '1')
                &middot; Pengajar</small>
            @elseif ($role == '2')
                &middot; Siswa</small>
            @endif
        @endforeach
    </td>
</tr>
</table>
</div>

<div class="p-3">

</div>

</div>
</div>
</div>
@endsection
