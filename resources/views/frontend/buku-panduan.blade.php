@extends('layouts.global')

@section('title')
    Buku Panduan
@endsection

@section('ga-active')
    active
@endsection

@section('ga-collapse-in')
    in
@endsection

@section('ga-buku-panduan-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Buku Panduan</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Guild Adventure</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('frontend.bukupanduan') }}">Buku Panduan</a> </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <h3>Buku Panduan</h3>
                        <ul>
                            <li>Pengenalan</li>
                            <li>Istilah dalam Website</li>
                            <li>Cara Menambah JobClass</li>
                            <li>Cara Menambah Skill</li>
                            <li>Cara Menambah Quest</li>
                            <li>Cara Mengirim Quest</li>
                            <li>Cara Menaikan Skor, Level, Exp</li>
                            <li>Cara Menukar Skor dengan Reward</li>
                            <li>Game Info</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
