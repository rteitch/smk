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
    <div class="container-fluid">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-stripped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Quest Code</th>
                            <th scope="col"><b>Status</b></th>
                            <th scope="col"><b>Siswa</b></th>
                            <th scope="col"><b>File Jawaban</b></th>
                            <th scope="col"><b>Jawaban Pilgan</b></th>
                            <th scope="col"><b>Batas Waktu</b></th>
                            <th scope="col"><b>Actions</b></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($orderq as $order)
                            <!-- Modal -->
                            <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-lg">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="">{{ $order->quest_code }}</h3>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- @foreach ($order->quest as $quests)
                                                {{ $quests->batas_waktu }}
                                                @if ($quests->pivot->order_q_id == $order->id)
                                                    {{ $quests->judul }}
                                                @endif
                                            @endforeach --}}
                                            <br>
                                            @if (!$order->file_pendukung == null)
                                                <iframe src="{{ asset('storage/' . $order->file_pendukung) }}"
                                                    frameborder="0" width="100%" height="400px"
                                                    type="application/pdf"></iframe>
                                            @else
                                                {{-- {{ $quest->where('id', $order->id)->first()->judul }} --}}
                                                tidak ada file upload
                                            @endif


                                            <div class="modal-footer">
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
                                <td>{{ $order->file_jawab }}</td>
                                <td>{{ $order->jawaban_pilgan }}</td>
                                <td>
                                    @foreach ($order->quest as $q)
                                        {{ $q->batas_waktu }}
                                    @endforeach()
                                </td>
                                <td>
                                    {{-- <a href="{{ route('orderq.edit', [$order->id]) }}" class="btn btn-success btn-sm">
                                        Upload</a>
                                    <a href="{{ route('orderq.show', [$order->id]) }}" class="btn btn-info btn-sm"> View</a> --}}

                                    <!-- Trigger the modal with a button -->

                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#myModal"><span class="oi oi-eye"></span> View
                                    </button>

                                    <small class="text-muted" id="judul_file2"></small>
                                    <br>
                                </td>
                            </tr>
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
    </div>
@endsection
