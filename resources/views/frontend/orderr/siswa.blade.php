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
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('orderr.index') }}">
                <div class="row">
                    <div class="col-md-5">
                        <input value="{{ Request::get('name') }}" name="name" type="text" class="form-control"
                            placeholder="Search by buyer name">
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-control" id="status">
                            <option value="">ANY</option>
                            <option {{ Request::get('status') == 'SUBMIT' ? 'selected' : '' }} value="SUBMIT">SUBMIT
                            </option>
                            <option {{ Request::get('status') == 'PROCESS' ? 'selected' : '' }} value="PROCESS">PROCESS
                            </option>
                            <option {{ Request::get('status') == 'DITERIMA' ? 'selected' : '' }} value="FINISH">FINISH
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
                            <th class="col">Nama Reward</th>
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
                                        @elseif($order->status == 'PROCESS')
                                            <span class="badge bg-info text-light">{{ $order->status }}</span>
                                        @elseif($order->status == 'DITERIMA')
                                            <span class="badge bg-success text-light">{{ $order->status }}</span>
                                        @endif
                                    </td>
                                    <td> {{ $rewards->title }} </td>
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
