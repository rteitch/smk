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
        <div class="table-responsive">
            <table class="table table-stripped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Quest Code</th>
                        <th scope="col"><b>Status</b></th>
                        <th scope="col"><b>Siswa</b></th>
                        <th scope="col"><b>Jenis Soal</b></th>
                        <th scope="col"><b>Batas Waktu</b></th>
                        <th scope="col"><b>Actions</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderq as $order)
                        @foreach ($order->quest as $quests)
                            <small class="text-muted" id="judul_file2"></small>
                            <br>
                            <!-- Modal -->
                            <div id="myModal{{ $order->id }}" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-lg">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="judul_file"><small>{{ $order->quest_code }} -
                                                    {{ $quests->where('id', $quests->pivot->quest_id)->first()->jenis_soal }}
                                                    @if ($order->status == 'SUBMIT')
                                                        <span
                                                            class="badge bg-warning text-light">{{ $order->status }}</span>
                                                    @elseif($order->status == 'PROCESS')
                                                        <span
                                                            class="badge bg-info text-light">{{ $order->status }}</span>
                                                    @elseif($order->status == 'FINISH')
                                                        <span
                                                            class="badge bg-success text-light">{{ $order->status }}</span>
                                                    @elseif($order->status == 'CANCEL')
                                                        <span
                                                            class="badge bg-dark text-light">{{ $order->status }}</span>
                                                    @endif
                                                </small></h3>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe src="{{ asset('storage/' . $order->file_jawab) }}" frameborder="0"
                                                width="100%" height="400px" type="application/pdf"></iframe>

                                            <div class="modal-footer">

                                                <a href="{{ route('orderq.edit', [$order->id]) }}"
                                                    class="btn btn-info btn-sm"> Edit Status</a>
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
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
                                <td>{{ $quests->where('id', $quests->pivot->quest_id)->first()->jenis_soal }}</td>
                                <td>
                                    @foreach ($order->quest as $q)
                                        {{ $q->batas_waktu }}
                                    @endforeach()
                                </td>
                                <td>

                                    <a href="{{ route('orderq.edit', [$order->id]) }}" class="btn btn-info btn-sm"> Edit
                                        Status</a>
                                    <!-- Trigger the modal with a button -->
                                    @if ($quests->where('id', $quests->pivot->quest_id)->first()->jenis_soal == 'LAPORAN')
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#myModal{{ $order->id }}"><span class="oi oi-eye"></span> Lihat
                                            Laporan
                                        </button>
                                    @else
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="10">
                            <div class="d-flex justify-content-start">
                                {!! $orderq->links() !!}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
