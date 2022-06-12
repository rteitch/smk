@extends('layouts.app')

@section('content')
    <div class="d-flex flex-row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="alert alert-danger">
                <h1>404</h1>
                {{-- <h4>{{ $exception->getMessage() }}</h4> --}}
                <a class="btn btn-danger" href="/">Kembali</a>
            </div>
        </div>
    </div>
@endsection
