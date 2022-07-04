@extends('layouts.global')

@section('title')
    Trashed Quests
@endsection

@section('dashboard-active')
    active
@endsection

@section('da-collapse-in')
    in
@endsection

@section('dash-quest-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Manajemen Quest</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item"> <a href="{{ route('quest.index') }}">Manajemen Quest</a> </li>
                    <li class="breadcrumb-item active"> <a href="{{ route('quest.index') }}">Trash</a> </li>
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
            <div class="row">
                <div class="col-md-12">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('quest.trash') }}">

                                <div class="input-group">
                                    <input name="keyword" type="text" value="{{ Request::get('keyword') }}"
                                        class="form-control" placeholder="Masukkan kata untuk mencari Quest">
                                    <div class="input-group-append">
                                        <input type="submit" value="Filter" class="btn btn-primary">
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="col-md-6">
                            <ul class="nav nav-pills card-header-pills">
                                <li class="nav-item">
                                    <a class="nav-link mr-3 text-white" href="{{ route('quest.index') }}">All</a>
                                </li>
                                <li class="nav-item mr-3 text-white">
                                    <a class="nav-link"
                                        href="{{ route('quest.index', ['status' => 'publish']) }}">Publish</a>
                                </li>
                                <li class="nav-item mr-3 text-white">
                                    <a class="nav-link" href="{{ route('quest.index', ['status' => 'draft']) }}">Draft</a>
                                </li>
                                <li class="nav-item mr-3 text-white">
                                    <a class="nav-link {{ Request::path() == 'quest/trash' ? 'active' : '' }}"
                                        href="{{ route('quest.trash') }}">Trash</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <hr class="my-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped">
                            <thead>
                                <tr>
                                    <th scope="col"><b>Image</b></th>
                                    <th scope="col"><b>Judul</b></th>
                                    <th scope="col"><b>Pembuat</b></th>
                                    <th scope="col"><b>Batas Waktu</b></th>
                                    <th scope="col"><b>Jenis Soal</b></th>
                                    <th scope="col"><b>Status</b></th>
                                    <th scope="col"><b>Action</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quests as $quest)
                                    <tr>
                                        <td>
                                            @if ($quest->image)
                                                <img src="{{ asset('storage/' . $quest->image) }}" width="96px" />
                                            @endif
                                        </td>
                                        <td>{{ $quest->judul }}</td>
                                        <td>{{ $quest->pembuat }}</td>
                                        <td>
                                            <span class="btn" data-countdown="{{ $quest->batas_waktu }}"></span>
                                        </td>
                                        <td>{{ $quest->jenis_soal }}</td>
                                        <td>
                                            @if ($quest->status == 'DRAFT')
                                                <span class="badge bg-dark text-white">{{ $quest->status }}</span>
                                            @else
                                                <span class="badge badge-success">{{ $quest->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('quest.restore', [$quest->id]) }}"
                                                class="btn btn-success">Restore</a>

                                            <form method="POST"
                                                action="{{ route('quest.delete-permanent', [$quest->id]) }}"
                                                class="d-inline"
                                                onsubmit="return confirm('Delete this quest {{ $quest->judul }} permanently?')">

                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">

                                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="d-flex justify-content-start">
                            {!! $quests->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-scripts')
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script>
        $('[data-countdown]').each(function() {
            var $this = $(this),
                finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
                if (event.strftime('%D days %H:%M:%S') == event.strftime('00 days 00:00:00')) {
                    $this.html('<span class="badge bg-danger text-light">Quest telah berakhir!</span>');
                } else {
                    $this.html(event.strftime(
                        '<p class="badge bg-success text-light">Waktu Quest Masih Tersedia</p><br><span >%D days %H:%M:%S</span>'
                        ));
                }
            });
        });
    </script>
@endsection
