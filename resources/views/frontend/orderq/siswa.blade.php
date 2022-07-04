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

@section('dash-quest-saya-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Quest Saya</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('orderq.index', \Auth::user()->id) }}">Quest
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
    <form action="{{ route('orderq.siswa', \Auth::user()->id) }}">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <select name="status" class="form-control" id="status">
                    <option value="">ANY</option>
                    <option {{ Request::get('status') == 'SUBMIT' ? 'selected' : '' }} value="SUBMIT">SUBMIT</option>
                    <option {{ Request::get('status') == 'PROCESS' ? 'selected' : '' }} value="PROCESS">PROCESS</option>
                    <option {{ Request::get('status') == 'FINISH' ? 'selected' : '' }} value="FINISH">FINISH</option>
                    <option {{ Request::get('status') == 'CANCEL' ? 'selected' : '' }} value="CANCEL">CANCEL</option>
                </select>
                <br>
            </div>
            <div class="col-lg-4 col-md-4">
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
                            <th scope="col">Judul</th>
                            <th scope="col"><b>Status</b></th>
                            <th scope="col"><b>Siswa</b></th>
                            <th scope="col"><b>File Jawaban</b></th>
                            <th scope="col"><b>Jawaban Pilgan</b></th>
                            <th scope="col"><b>Batas Waktu</b></th>
                            <th scope="col"><b>Waktu Upload</b></th>
                            <th scope="col"><b>Actions</b></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($orderq as $order)
                            @foreach ($order->quest as $index => $quests)
                                <!-- Modal View file jawab -->
                                <div id="myModalFileJawab{{ $order->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-lg">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="judul_file">{{ $order->quest_code }}</h3>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <iframe src="{{ asset('storage/' . $order->file_jawab) }}" frameborder="0"
                                                    width="100%" height="400px" type="application/pdf"></iframe>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Penugasan -->
                                <div id="myModal{{ $order->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-lg">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id=""><small>{{ $quests->judul }} -
                                                        {{ $quest->where('id', $quests->pivot->quest_id)->first()->jenis_soal }}
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
                                                    </small>
                                                </h3>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <br>
                                            <div class="modal-body">
                                                <strong
                                                    class="mb-2">{{ $nama_quest = $quest->where('id', $quests->pivot->quest_id)->first()->judul }}</strong>
                                                <br>
                                                <div class="container">
                                                    {{ $quest->where('id', $quests->pivot->quest_id)->first()->deskripsi }}
                                                    <br>


                                                    @if ($order->status == 'PROCESS')
                                                        <div>
                                                            <hr class="my-3">
                                                        </div>
                                                        <p>Jawaban mu telah terkirim, tunggu beberapa waktu untuk penilaian
                                                            dari pembuat quest</p>
                                                    @elseif ($order->status == 'FINISH')
                                                        <div>
                                                            <hr class="my-3">
                                                        </div>
                                                        <p>
                                                            Selamat
                                                            <strong>{{ $user->where('id', $order->user_id)->first()->name }}</strong>
                                                            <br>
                                                            <strong>{{ $quest->where('id', $quests->pivot->quest_id)->first()->pembuat }}</strong>
                                                            Senang dengan bantuan anda! <br>jika ada kesempatan dia
                                                            akan membutuhkan
                                                            bantuanmu lagi, semangat petualang!
                                                        </p>
                                                    @elseif($order->status == 'CANCEL')
                                                        <div>
                                                            <hr class="my-3">
                                                        </div>
                                                        <p>Sayang sekali
                                                            <strong>{{ $user->where('id', $order->user_id)->first()->name }}</strong>,
                                                            jawaban anda tidak tepat, untuk quest ini akan diserahkan ke
                                                            petualang lain, terima kasih sudah mencoba!
                                                            <br>Silakan untuk mencoba quest yang lain,
                                                        </p>
                                                    @endif
                                                    {{-- @if ($quest->where('id', $quests->pivot->quest_id)->first()->jenis_soal == 'LAPORAN')
                                                            <hr class="my-3">
                                                            <label for="file">Upload file jawaban dalam bentuk
                                                                pdf</label>
                                                            <input type="file" class="form-control"
                                                                name="file_jawaban_siswa">
                                                            <br>
                                                        @endif --}}
                                                    <hr class="my-3">
                                                    <form
                                                        action="{{ route('orderq.updateJawaban', [$order->id, $quests->pivot->quest_id]) }}"
                                                        enctype="multipart/form-data" method="POST">

                                                        @csrf

                                                        <input type="hidden" value="PUT" name="_method">

                                                        @if ($quest->where('id', $quests->pivot->quest_id)->first()->jenis_soal == 'PILGANDA')
                                                            @if ($order->status == 'SUBMIT')
                                                                <label for="jawaban_pilgan">Pilih Jawaban Anda : </label>
                                                                <select class="form-control" name="jawaban_pilgan"
                                                                    id="jawaban_pilgan">
                                                                    <option disabled class="text-center">== Pilih Jawaban ==
                                                                    </option>
                                                                    <option value="Tidak Menjawab">Tidak Menjawab</option>
                                                                    <option value="A">A.
                                                                        {{ $quest->where('id', $quests->pivot->quest_id)->first()->pil_A }}
                                                                    </option>
                                                                    <option value="B">B.
                                                                        {{ $quest->where('id', $quests->pivot->quest_id)->first()->pil_B }}
                                                                    </option>
                                                                    <option value="C">C.
                                                                        {{ $quest->where('id', $quests->pivot->quest_id)->first()->pil_D }}
                                                                    </option>
                                                                    <option value="D">D.
                                                                        {{ $quest->where('id', $quests->pivot->quest_id)->first()->pil_D }}
                                                                    </option>
                                                                    <option value="E">E.
                                                                        {{ $quest->where('id', $quests->pivot->quest_id)->first()->pil_E }}
                                                                    </option>
                                                                </select>
                                                            @endif
                                                        @endif
                                                        @if ($quest->where('id', $quests->pivot->quest_id)->first()->jenis_soal == 'LAPORAN')
                                                            @if ($quest_file = $quest->where('id', $quests->pivot->quest_id)->first()->file_pendukung)
                                                                File pendukung dari pembuat quest : <br>
                                                                <iframe src="{{ asset('storage/' . $quest_file) }}"
                                                                    frameborder="0" width="100%" height="400px"
                                                                    type="application/pdf"></iframe>
                                                            @endif
                                                            @if ($order->status == 'SUBMIT')
                                                                <label for="file">Upload File Jawab</label>
                                                                <input type="file" class="form-control"
                                                                    name="file_jawaban_siswa">
                                                                <br><br>
                                                            @endif
                                                        @endif


                                                        <br>
                                                        <br>
                                                        @if ($order->file_pendukung != '')
                                                            <iframe
                                                                src="{{ asset('storage/' . $order->file_pendukung) }}"
                                                                frameborder="0" width="100%" height="400px"
                                                                type="application/pdf"></iframe>
                                                        @else
                                                            <small>tidak ada file upload</small>
                                                        @endif

                                                        <div class="modal-footer">
                                                            <input type="submit" class="btn btn-primary" value="SUBMIT">
                                                    </form>
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
            </div>
            <tr>
                <td>{{ $quests->judul }}</td>
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
                <td>
                    @if (!$order->file_jawab == null)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#myModalFileJawab{{ $order->id }}"><span class="oi oi-eye"></span> View
                        </button>
                    @else
                        <small>tidak ada file upload</small>
                    @endif
                </td>
                <td>{{ $order->jawaban_pilgan }}</td>
                <td>
                    <span class="btn" data-countdown="{{ $quests->batas_waktu }}"></span>
                </td>
                <td>
                    {{ $order->updated_at }}
                </td>
                <td>
                    {{-- <a href="{{ route('orderq.edit', [$order->id]) }}" class="btn btn-success btn-sm">
                                        Upload</a>
                                    <a href="{{ route('orderq.show', [$order->id]) }}" class="btn btn-info btn-sm"> View</a> --}}

                    <!-- Trigger the modal with a button -->

                    <button id="tombolup" type="button" class="btn btn-info btn-sm" data-toggle="modal"
                        data-target="#myModal{{ $order->id }}"><span class="fa fa-eye"></span> Upload
                    </button>

                    <form onsubmit="return confirm('Membatalkan quest kode {{ $order->quest_code }}?')"
                        class="d-inline" action="{{ route('orderq.destroy', [$order->id]) }}" method="POST">

                        @csrf

                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn- btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                        {{-- <input type="submit" value="Delete" class="btn btn-danger btn-sm"> --}}

                    </form>
                    <br>
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
    </div>
@endsection

@section('footer-scripts')
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script>
        $('[data-countdown]').each(function() {
            var $this = $(this),
                finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
                if (event.strftime('%D days %H:%M:%S') == event.strftime('00 days 00:00:00')) {
                    $this.html('<span class="badge bg-danger text-light">Quest telah berakhir!</span>');
                    $('#tombolup').hide();
                } else {
                    $this.html(event.strftime(
                        '<p class="badge bg-success text-light">Waktu Quest Masih Tersedia</p><br><span >%D days %H:%M:%S</span>'
                        ));
                }
            });
        });
    </script>
@endsection
