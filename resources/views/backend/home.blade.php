@extends("layouts.global")

@section("title")- Home @endsection

@section('content')
<div class="container">

</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="">
            <div class="card text-center">
                <div class="card-header bg-danger text-white pt-4 pb-3">Informasi!</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>Selamat Datang <strong>{{ Auth::user()->name }}</strong> di Guild Adventure World! <br> Kamu Sekarang berada di ibu kota SMK Negeri 2 Surakarta.</p>
                    <img src="img/smkn2solo.png" alt="smkn2solo-logo" srcset="" width="50%">
                    <p>Silakan kunjungi <a href="#">Guild Adventure</a> Untuk mengecek progress harianmu!</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')

<script src="{{ asset('iconic/dist/assets/vendor/toastr/toastr.js') }}"></script>
@endsection
