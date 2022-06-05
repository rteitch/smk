@extends('layouts.global')

@section('title')
    Users list
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="container col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <b>List User</b>
            </div>
            <div class="card-body">
                <form action="{{ route('users.index') }}">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-2">
                            <label for="optionFilter">Pilih Sort By:</label>
                            <select class="form-control" name="optionFilter" id="optionFilter">
                                <option class="text-center" disabled>== Pilih Sort By ==</option>
                                <option {{ Request::get('optionFilter') == 'name' ? 'checked' : '' }} value="name">Name
                                </option>
                                <option {{ Request::get('optionFilter') == 'username' ? 'checked' : '' }}
                                    value="username">Username</option>
                                <option {{ Request::get('optionFilter') == 'email' ? 'checked' : '' }} value="email">Email
                                </option>
                            </select>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-2">
                            <input value="{{ Request::get('keyword') }}" name="keyword" class="form-control" type="text"
                                placeholder="Masukan kata untuk filter..." />
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 p-2">
                            <input {{ Request::get('status') == 'on' ? 'checked' : '' }} value="on" name="status"
                                type="radio" class="form-control" id="on">
                            <label for="on">Online</label>

                            <input {{ Request::get('status') == 'off' ? 'checked' : '' }} value="off" name="status"
                                type="radio" class="form-control" id="off">
                            <label for="off">Offline</label>
                            <input type="submit" value="Filter" class="btn btn-primary pl-3 pr-3">
                        </div>
                    </div>
                </form>
                <div>
                    <hr class="my-3">
                </div>
                <div class="row">
                    <div class="col-md-12 text-right mb-2">
                        <a href="{{ route('users.create') }}" class="btn btn-primary"> <span class="oi oi-plus"> Tambah user</span> </a>
                    </div>
                    <hr class="my-3">
                </div>
                <div class="col-md-12">
                    <div class="d-flex justify-content-start">
                        {!! $users->links() !!}
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="border-0">
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Avatar</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->avatar)
                                            <img src="{{ asset('storage/' . $user->avatar) }}"
                                                alt="avatar_{{ $user->name }}" width="70px">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td align="center">
                                        @if ($user->status == 'on')
                                            <span class="badge badge-success p-2">
                                                {{ $user->status }}
                                            </span>
                                        @else
                                            <span class="badge badge-danger p-2">
                                                {{ $user->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('users.show', [$user->id]) }}"
                                            class="btn btn-primary btn-sm"><span class="oi oi-eye"></span></a>
                                        <a class="btn btn-info text-white btn-sm"
                                            href="{{ route('users.edit', [$user->id]) }}"><span class="oi oi-pencil"></span></a>
                                        <form onsubmit="return confirm('Delete this user atas nama {{ $user->name }} permanently?')"
                                            class="d-inline" action="{{ route('users.destroy', [$user->id]) }}"
                                            method="POST">

                                            @csrf

                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn- btn-danger btn-sm"><span class="oi oi-trash"></span></button>
                                            {{-- <input type="submit" value="Delete" class="btn btn-danger btn-sm"> --}}

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan=10>
                                    <div class="d-flex justify-content-start">
                                        {!! $users->links() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
