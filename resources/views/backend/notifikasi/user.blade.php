@extends('layouts.global')

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
    <div class="card">
        <div class="card-body">

        </div>
    </div>
@endsection
