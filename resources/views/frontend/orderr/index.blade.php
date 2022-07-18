@extends('layouts.global')

@section('title')
    Manajemen Reward Siswa
@endsection

@section('dashboard-active')
    active
@endsection

@section('da-collapse-in')
    in
@endsection

@section('dash-reward-siswa-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Manajemen Reward Siswa</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('orderr.index') }}">Manajemen Reward Siswa</a>
                    </li>
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
            <form action="{{ route('orderr.index') }}">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <input value="{{ Request::get('name') }}" name="name" type="text" class="form-control"
                            placeholder="Search by siswa name">
                            <br>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <select name="status" class="form-control" id="status">
                            <option value="">ANY</option>
                            <option {{ Request::get('status') == 'PROSES' ? 'selected' : '' }} value="PROSES">PROSES
                            </option>
                            <option {{ Request::get('status') == 'DITERIMA' ? 'selected' : '' }} value="DITERIMA">DITERIMA
                            </option>
                        </select>
                        <br>
                    </div>
                    <div class="col-md-3">
                        <input type="submit" value="Filter" class="btn btn-primary">
                    </div>
                </div>
            </form>

            <hr class="my-3">
            <div class="table-responsive">
                <table class="table table-stripped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><b>Status</b></th>
                            <th scope="col"><b>Nama Reward</b></th>
                            <th scope="col"><b>Siswa</b></th>
                            <th scope="col"><b>Nomor HP Siswa</b></th>
                            <th scope="col"><b>Actions</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_r_s as $index => $order)
                            @foreach ($order->reward as $rewards)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if ($order->status == 'SUBMIT')
                                            <span class="badge bg-warning text-light">{{ $order->status }}</span>
                                        @elseif($order->status == 'PROSES')
                                            <span class="badge bg-info text-light">{{ $order->status }}</span>
                                        @elseif($order->status == 'DITERIMA')
                                            <span class="badge bg-success text-light">{{ $order->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $rewards->title }}</td>
                                    <td>
                                        {{ $order->user->name }} <br>
                                        <small>{{ $order->user->email }}</small>
                                    </td>
                                    <td>
                                        {{ $order->user->phone }}
                                    </td>
                                    <td>
                                        <a href="{{ route('orderr.edit', [$order->id]) }}" class="btn btn-info btn-sm">
                                            Edit Status</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10">
                                <div class="d-flex justify-content-start">
                                    {!! $order_r_s->links() !!}
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
