@extends('layouts.global')

@section('title')
    Statistik
@endsection

@section('dashboard-active')
    active
@endsection

@section('da-collapse-in')
    in
@endsection

@section('dash-statistik-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Statistik</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('user.statistik') }}">Statistik</a> </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-lg-12 col-md-12">
        Ini adalah halaman statistik
    </div>
@endsection
@section('footer-scripts')


@endsection
