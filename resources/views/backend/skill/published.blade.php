@extends('layouts.global')

@section('title')
    Detail Skill
@endsection

@section('content')
    <div class="container col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @elseif (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
        <div>
            <div class="col-12 col-sm-12">
                <h2>Skill Available</h2>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <hr class="my-3">
                </div>
            </div>

            <div class="row-fluid">
                @foreach ($skill as $skills)
                    <!-- Modal Skill -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="">{{ $skills->judul }}</h3>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{ asset('storage/' . $skills->image) }}" class="card-img"
                                        alt="{{ $skills->judul }}">
                                    <p><strong>JobClass : </strong>
                                    </p>
                                    <p><strong>Syarat Lv : </strong> {{ $skills->syarat_lv }}
                                    </p>
                                    <p><strong>Deskripsi : </strong>
                                        <br>
                                        {{ $skills->deskripsi }}
                                    </p>
                                    <div class="modal-footer">
                                        @if ($user->isHasSkill($skills->id))
                                            <small class="text-info">Skill sudah ditambahkan</small>
                                        @else
                                            <form
                                                onsubmit="return confirm('Tambah this id {{ $skills->id }} Skill  {{ $skills->name }} ke user?')"
                                                method="POST" action="{{ route('user.tambahSkill', [$skills->id]) }}"
                                                class="d-inline">

                                                @csrf

                                                <input type="submit" value="Tambah" class="btn btn-primary" />
                                            </form>
                                        @endif
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card mb-3" style="max-width: 1080px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' . $skills->image) }}" class="card-img"
                                    alt="{{ $skills->judul }}">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    {{-- {{ route('artikel.lihatArtikel', [$skills->slug]) }}</a> --}}
                                    <h5 class="card-title">{{ $skills->judul }}</h5>
                                    <p class="card-text"><small class="text-muted">Creator Skill -
                                            @foreach ($skills->user as $users)
                                                @if ($users->id == $skills->created_by)
                                                    {{ $users->name }}
                                                @endif
                                            @endforeach
                                        </small></p>
                                    <p class="card-text"><small class="text-muted">Syarat Level
                                            {{ $skills->syarat_lv }}</small>
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <!-- Trigger the modal with a button -->

                                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                        data-target="#myModal"><span class="oi oi-eye"></span> Lihat Skill
                                    </button>

                                    @if ($user->isHasSkill($skills->id))
                                        <small class="text-info">Skill sudah ditambahkan</small>
                                    @else
                                        <form
                                            onsubmit="return confirm('Tambah this id {{ $skills->id }} Skill  {{ $skills->name }} ke user?')"
                                            method="POST" action="{{ route('user.tambahSkill', [$skills->id]) }}"
                                            class="d-inline">

                                            @csrf

                                            <input type="submit" value="Tambah" class="btn btn-primary" />
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex justify-content-start">
                {!! $skill->links() !!}
            </div>
        </div>
    </div>
@endsection
