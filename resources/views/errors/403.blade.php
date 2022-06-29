@extends('layouts.error')

@section('content')
    <div class="d-flex flex-row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="alert alert-danger">
                <h1>403</h1>
                {{-- <h4>{{ $exception->getMessage() }}</h4> --}}
                <h4>Anda Tidak Diizinkan untuk mengakses halaman ini!</h4>
                <a class="btn btn-danger" href="/home">Kembali</a>
            </div>
        </div>
    </div>
@endsection
