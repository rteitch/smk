@extends('layouts.global')

@section('title')
    Orders list
@endsection

@section('dashboard-active')
    active
@endsection

@section('da-collapse-in')
    in
@endsection

@section('dash-reward-saya-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Reward Saya</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('orderr.index', \Auth::user()->id) }}">Reward
                            Saya</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
    </div>
    <style>
        #tabel {
            font-size: 15px;
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }
    </style>
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('orderr.siswa', \Auth::user()->id) }}">
                <div class="row">
                    <div class="col-md-2">
                        <select name="status" class="form-control" id="status">
                            <option value="">ANY</option>
                            <option {{ Request::get('status') == 'PROSES' ? 'selected' : '' }} value="PROSES">PROSES
                            </option>
                            <option {{ Request::get('status') == 'DITERIMA' ? 'selected' : '' }} value="DITERIMA">DITERIMA
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" value="Filter" class="btn btn-primary">
                    </div>
                </div>
            </form>
            <hr class="my-3">

            <div class="table table-stripped table-bordered">
                <table>
                    <thead>
                        <tr>
                            <th class="scope">#</th>
                            <th class="scope">Status</th>
                            <th class="scope">Code Reward</th>
                            <th class="col">Nama Reward</th>
                            <th class="scope">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderr as $index => $order)
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
                                    <td>{{ $order->reward_code }}</td>
                                    <td> {{ $rewards->title }} </td>
                                    <td>
                                        <a class="btn btn-success text-white" style="cursor:pointer"
                                            onclick="window.open('{{ route('orderr.cetakInvoice', [$order->id]) }}','nama window','width=1000,height=500,toolbar=no,location=no,directories=no,status=no,menubar=no, scrollbars=no,resizable=yes,copyhistory=no')"><i class="fa fa-print"></i> Cetak
                                            Invoice</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection

@section('footer-scripts')
    <script></script>
@endsection
