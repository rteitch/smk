@extends('layouts.global')

@section('title')
    Manajemen User
@endsection

@section('dashboard-active')
    active
@endsection

@section('da-collapse-in')
    in
@endsection

@section('dash-user-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Manajemen User</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('users.index') }}">Manajemen User</a> </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    {{-- notifikasi form validasi --}}
    @if ($errors->has('file'))
        <span class="invalid-feedback" role="alert">
            {{-- <strong>{{ $errors->first('file') }}</strong> --}}
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </span>
    @endif
    {{-- notifikasi sukses --}}
    @if ($sukses = Session::get('sukses'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $sukses }}</strong>
        </div>
    @endif

    <div class="container col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                {{-- <form action="{{ route('users.index') }}">
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <label>Search By</label>
                            <div class="c_multiselect">
                                <select id="single-selection" name="optionFilter" class="multiselect multiselect-custom">
                                    <option {{ Request::get('optionFilter') == 'name' ? 'checked' : '' }} value="name">
                                        Name
                                    </option>
                                    <option {{ Request::get('optionFilter') == 'username' ? 'checked' : '' }}
                                        value="username">Username</option>
                                    <option {{ Request::get('optionFilter') == 'email' ? 'checked' : '' }} value="email">
                                        Email
                                    </option>
                                </select>
                            </div>
                            <br>
                        </div>

                        <div class="col-lg-2 col-md-12">
                            <div class="form-group">
                                <label>Status</label>
                                <br />
                                <label class="fancy-radio">
                                    <input {{ Request::get('status') == 'on' ? 'checked' : '' }} value="on"
                                        name="status" type="radio" class="form-control" id="on">
                                    <span><i></i>Online</span>
                                </label>
                                <label class="fancy-radio">
                                    <input {{ Request::get('status') == 'off' ? 'checked' : '' }} value="off"
                                        name="status" type="radio" class="form-control" id="off">
                                    <span><i></i>Offline</span>
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12">
                            <br>
                            <input value="{{ Request::get('keyword') }}" name="keyword" class="form-control" type="text"
                                placeholder="Masukan kata untuk filter..." />

                        </div>
                        <div class="col-lg-2 col-md-12">
                            <br>
                            <input type="submit" value="Filter" class="btn btn-primary pl-3 pr-3">
                        </div>


                    </div>
                </form> --}}
                <div class="text-center">
                    {{-- <hr class="my-3"> --}}
                    <h4>Manajemen User</h4>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <a href="{{ asset('file_user/Template Import Data User.xlsx') }}" class="btn btn-warning my-3"
                            target="_blank"> <i class="fa fa-download"></i> DOWNLOAD TEMPLATE IMPORT</a>

                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#importExcel">
                            <i class="fa fa-file"> </i> IMPORT USER
                        </button>
                        <!-- Import Excel -->
                        <div class="modal fade" id="importExcel" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form method="post" action="/user/import_excel" enctype="multipart/form-data">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                                        </div>
                                        <div class="modal-body">

                                            {{ csrf_field() }}

                                            <label>Pilih file excel</label>
                                            <div class="form-group">
                                                <input type="file" name="file" required="required">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Import</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <a href="/user/export_excel" class="btn btn-success my-3" target="_blank"> <i
                                class="fa fa-download"></i> EXPORT EXCEL ALL USER</a>
                        <a href="{{ route('users.create') }}" class="btn btn-primary"> <i class="fa fa-plus"> TAMBAH
                                USER</i> </a>
                    </div>
                    <hr class="my-3">
                </div>
                {{-- <div class="col-md-12">
                    <div class="d-flex justify-content-start">
                        {{ $users->links() }}
                    </div>
                </div> --}}
                <div class="table-responsive">
                    <table id="userr" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th hidden>id</th>
                                <th>Nama</th>
                                <th>Avatar</th>
                                <th hidden>Email</th>
                                <th>Jobclass</th>
                                <th hidden>Username</th>
                                <th>Roles</th>
                                <th hidden>Alamat</th>
                                <th hidden>Nomor Induk</th>
                                <th hidden>Phone</th>
                                <th hidden>Tempat Lahir</th>
                                <th hidden>Nomor Induk</th>
                                <th hidden>Level</th>
                                <th hidden>Skor</th>
                                <th hidden>Exp</th>
                                <th hidden>Gender</th>
                                <th hidden>Background</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td hidden>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        @if ($user->avatar)
                                            <img src="{{ asset('storage/' . $user->avatar) }}"
                                                alt="avatar_{{ $user->name }}" width="70px">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td hidden>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->jobclass as $jobc)
                                            @if ($user->jobclass->count() == 1)
                                                {{ $jobc->first()->name }}
                                            @elseif($user->jobclass->count() == 2)
                                                @if ($loop->last)
                                                    {{ $jobc->name }}
                                                @endif
                                            @elseif($user->jobclass->count() == 3)
                                                @if ($loop->last)
                                                    {{ $jobc->name }}
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                    <td hidden>{{ $user->username }}</td>

                                    <td>
                                        {{-- {{ $user->roles }} --}}
                                        @if ($user->roles == json_encode(['0']))
                                            Admin
                                        @elseif($user->roles == json_encode(['1']))
                                            Pengajar
                                        @elseif($user->roles == json_encode(['2']))
                                            Siswa
                                        @endif
                                    </td>
                                    <td hidden>{{ $user->alamat }}</td>
                                    <td hidden>{{ $user->nomor_induk }}</td>
                                    <td hidden>{{ $user->phone }}</td>
                                    <td hidden>{{ $user->tempat_lahir }}</td>
                                    <td hidden>{{ $user->tanggal_lahir }}</td>
                                    <td hidden>{{ $user->level }}</td>
                                    <td hidden>{{ $user->skor }}</td>
                                    <td hidden>{{ $user->exp }}</td>
                                    <td hidden>{{ $user->gender }}</td>

                                    <td hidden>{{ $user->background }}</td>
                                    <td>
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
                                            class="btn btn-primary btn-sm"><span class="fa fa-eye"></span></a>
                                        <a class="btn btn-info text-white btn-sm"
                                            href="{{ route('users.edit', [$user->id]) }}"><span
                                                class="fa fa-edit"></span></a>
                                        <form
                                            onsubmit="return confirm('Apakah anda yakin ingin menghapus user atas nama {{ $user->name }} secara permanent?')"
                                            class="d-inline" action="{{ route('users.destroy', [$user->id]) }}"
                                            method="POST">

                                            @csrf

                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger btn-sm"><span
                                                    class="fa fa-trash-o"></span></button>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <table class="table table-hover">
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
                                    <td>
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
                                            class="btn btn-primary btn-sm"><span class="fa fa-eye"></span></a>
                                        <a class="btn btn-info text-white btn-sm"
                                            href="{{ route('users.edit', [$user->id]) }}"><span
                                                class="fa fa-edit"></span></a>
                                        <form
                                            onsubmit="return confirm('Apakah anda yakin ingin menghapus user atas nama {{ $user->name }} secara permanent?')"
                                            class="d-inline" action="{{ route('users.destroy', [$user->id]) }}"
                                            method="POST">

                                            @csrf

                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger btn-sm"><span
                                                    class="fa fa-trash-o"></span></button>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan=10>
                                    <div class="d-flex justify-content-start">
                                        {{ $users->links() }}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#userr').DataTable({
                dom: 'Bfrtip',
                ServerSide: true,
                responsive: true,
                ordering: false,
                // autoWidth: false,
                buttons: [{
                    extend: 'excelHtml5',
                    autoFilter: true,
                    sheetName: 'Exported data',
                    text: ' <span class="fa fa-download"></span> Export Excel By Filter',
                    // className : 'btn btn-primary text-white'
                }]
            });
        });
    </script>
@endsection
