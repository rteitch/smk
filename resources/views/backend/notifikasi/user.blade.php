@extends('layouts.global')

@section('css-vendor')
@endsection

@section('title')
    Notifikasi
    @if (\Auth::user())
        @if (json_decode(\Auth::user()->roles) == array_intersect(['1']))
            Pengajar
        @elseif(json_decode(\Auth::user()->roles) == array_intersect(['2']))
            Siswa
        @else
            Admin
        @endif
    @endif
@endsection

@section('dashboard-active')
    active
@endsection

@section('da-collapse-in')
    in
@endsection

@section('dash-notifikasi-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Notifikasi
                    @if (\Auth::user())
                        @if (json_decode(\Auth::user()->roles) == array_intersect(['1']))
                            Pengajar
                        @elseif(json_decode(\Auth::user()->roles) == array_intersect(['2']))
                            Siswa
                        @else
                            Admin
                        @endif
                    @endif
                </h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-bell"></i></a></li>
                    <li class="breadcrumb-item">Notifikasi
                        @if (\Auth::user())
                            @if (json_decode(\Auth::user()->roles) == array_intersect(['1']))
                                Pengajar
                            @elseif(json_decode(\Auth::user()->roles) == array_intersect(['2']))
                                Siswa
                            @else
                                Admin
                            @endif
                        @endif
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row bg-white p-3 border-">
            <div class="col-lg-12 col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="scope">Pengirim</th>
                                <th class="scope">Tanggal</th>
                                <th class="scope">Judul</th>
                                <th class="col">Pesan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notifikasi as $index => $notif)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->where('id', $notif->created_by)->first()->name }} </td>
                                    <td><small>{{ $notif->created_at }}</small></td>
                                    <td>{{ $notif->title }} </td>
                                    <td>{{ $notif->pesan }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            {{-- <div class="col-lg-8 col-md-8">
                ini isi pesan
            </div> --}}
        </div>
    </div>
@endsection

@section('footer-scripts')
@endsection
