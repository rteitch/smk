@extends('layouts.global')

@section('title')
    Orders list
@endsection

@section('content')
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
                                [TODO: actions]
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
