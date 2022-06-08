@extends('layouts.global')

@section('title')
    Orders list
@endsection

@section('content')
    <form action="{{ route('orderq.index') }}">
        <div class="row">
            <div class="col-md-5">
                <input value="{{ Request::get('name') }}" name="name" type="text" class="form-control"
                    placeholder="Search by buyer name">
            </div>
            <div class="col-md-2">
                <select name="status" class="form-control" id="status">
                    <option value="">ANY</option>
                    <option {{ Request::get('status') == 'SUBMIT' ? 'selected' : '' }} value="SUBMIT">SUBMIT</option>
                    <option {{ Request::get('status') == 'PROCESS' ? 'selected' : '' }} value="PROCESS">PROCESS</option>
                    <option {{ Request::get('status') == 'FINISH' ? 'selected' : '' }} value="FINISH">FINISH</option>
                    <option {{ Request::get('status') == 'CANCEL' ? 'selected' : '' }} value="CANCEL">CANCEL</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="submit" value="Filter" class="btn btn-primary">
            </div>
        </div>
    </form>

    <hr class="my-3">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-stripped table-bordered">
                <thead>
                    <tr>
                        <th>Quest Code</th>
                        <th><b>Status</b></th>
                        <th><b>Siswa</b></th>
                        <th><b>File Jawaban</b></th>
                        <th><b>Jawaban Pilgan</b></th>
                        <th><b>Batas Waktu</b></th>
                        <th><b>Actions</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order_q_s as $order)
                        <tr>
                            <td>{{ $order->quest_code }}</td>
                            <td>
                                @if ($order->status == 'SUBMIT')
                                    <span class="badge bg-warning text-light">{{ $order->status }}</span>
                                @elseif($order->status == 'PROCESS')
                                    <span class="badge bg-info text-light">{{ $order->status }}</span>
                                @elseif($order->status == 'FINISH')
                                    <span class="badge bg-success text-light">{{ $order->status }}</span>
                                @elseif($order->status == 'CANCEL')
                                    <span class="badge bg-dark text-light">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $order->user->name }} <br>
                                <small>{{ $order->user->email }}</small>
                            </td>
                            <td>{{ $order->quest_order->file_jawab }}</td>
                            <td>{{ $order->quest_order->jawaban_pilgan }}</td>
                            <td>{{ $order->quest->batas_waktu }}</td>
                            <td>
                                <a href="{{ route('orderq.edit', [$order->id]) }}" class="btn btn-info btn-sm"> Edit</a>
                                <a href="{{ route('orderq.view', [$order->id]) }}" class="btn btn-info btn-sm"> View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="10">
                            <div class="d-flex justify-content-start">
                                {!! $order_q_s->links() !!}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
