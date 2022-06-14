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
        @endif
        <a class="btn btn-info" href="{{ route('artikel.index') }}">
            < Kembali</a>
                <br><br>
                <div class="row no-gutters">
                    <div class="mb-2">
                        <div class="card bg-white border-0 shadow-sm">
                            <div class="card-header bg-white border-light">
                                <div class="media">
                                    <img style="width: 48px" class="mr-3 rounded-circle" src="{{ asset('storage/'. $artikel->user->avatar) }}" alt="#">
                                    <div class="media-body">
                                        <h6 class="text-indigo m-0">
                                            {{ $artikel->user->name }}</h6>
                                        <small class="text-muted">Shared publicly - 7:30PM Today</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <img class="w-100 mb-2" src="{{ asset('public/'. $artikel->image) }}" alt="image post">
                                <p class="fs-smaller">
                                    Amazing isn't it?
                                </p>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button class="btn btn-sm border-secondary text-muted">
                                            <span class="oi oi-share"></span>
                                            Share
                                        </button>
                                        <button class="btn btn-sm border-secondary text-muted">
                                            <span class="oi oi-heart"></span>
                                            Like
                                        </button>
                                    </div>
                                    <div>
                                        <span class="fs-smaller text-muted">139 Likes - 5 Comments</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <ul class="list-unstyled">
                                    <li class="media">
                                        <img class="mr-3 rounded-circle" style="width: 48px" src="assets/azamuddin.jpg"
                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <h6>Iqbal Kholis <small class="float-right">9:08 PM Today</small> </h6>
                                            <p class="fs-smallest text-dark">Cras sit amet nibh libero, in gravida nulla.
                                                Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum
                                                in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
                                                vulputate fringilla. Donec lacinia congue felis in faucibus.</ps>
                                        </div>
                                    </li>
                                    <li class="media my-4">
                                        <img class="mr-3 rounded-circle" style="width: 48px" src="assets/azamuddin.jpg"
                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <h6>Habib Asagaf <small class="float-right">9:08 PM Today</small> </h6>
                                            <p class="fs-smallest text-dark">Cras sit amet nibh libero, in gravida nulla.
                                                Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum
                                                in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
                                                vulputate fringilla. Donec lacinia congue felis in faucibus.</ps>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="mr-3 rounded-circle" style="width: 48px" src="assets/azamuddin.jpg"
                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <h6>Ridwan Mutafaq <small class="float-right">9:08 PM Today</small> </h6>
                                            <p class="fs-smallest text-dark">Cras sit amet nibh libero, in gravida nulla.
                                                Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum
                                                in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
                                                vulputate fringilla. Donec lacinia congue felis in faucibus.</ps>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="card col-md-4">
                        <img src="{{ asset('storage/' . $artikel->image) }}" class="card-img p-2" alt="...">
                    </div>
                    <div class="card col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $artikel->title }}</h5>
                            <p><strong>Skill : </strong>
                                @foreach ($artikel->skill as $skills)
                                    <a href="{{ route('skill.show', $skills->id) }}">{{ $skills->judul }}</a>,
                                @endforeach
                            </p>
                            <p class="card-text">{!! $artikel->konten !!}</p>
                            <p class="card-text"><small class="text-muted">{{ $artikel->slug }}</small></p>
                            <b>Pergi Ke :</b>
                            <div class="row m-2">
                                <div class="col-6 mb-2">
                                    <a href="#" class="btn btn-block btn-danger" style="">Quest</a>
                                </div>
                                <div class="col-6 mb-2">
                                    <a href="#" class="btn btn-block btn-primary">Siswa</a>
                                </div>
                                <div class="col-6 mb-2">
                                    <a href="#" class="btn btn-block btn-info">Pengajar</a>
                                </div>
                                <div class="col-6 mb-2">
                                    <a href="#" class="btn btn-block btn-warning">artikel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
@endsection
