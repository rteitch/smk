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
                            <th scope="col">Judul</th>
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

                    <div class="wrap-countdown mercado-countdown"
                        data-expire="{{ Carbon\Carbon::parse($quests->batas_waktu)->format('Y/m/d h:i:s') }}"></div>
                    {{-- {{ $quests->batas_waktu }} --}}
                    {{-- <div id="countdown{{ $index }}"> --}}
                </td>
                <td>
                    {{-- <a href="{{ route('orderq.edit', [$order->id]) }}" class="btn btn-success btn-sm">
                                        Upload</a>
                                    <a href="{{ route('orderq.show', [$order->id]) }}" class="btn btn-info btn-sm"> View</a> --}}

                    <!-- Trigger the modal with a button -->

                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                        data-target="#myModal{{ $order->id }}"><span class="fa fa-eye"></span> View
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
        ;
        (function($) {

            var MERCADO_JS = {
                init: function() {
                    this.mercado_countdown();

                },
                mercado_countdown: function() {
                    if ($(".mercado-countdown").length > 0) {
                        $(".mercado-countdown").each(function(index, el) {
                            var _this = $(this),
                                _expire = _this.data('expire');
                            _this.countdown(_expire, function(event) {

                                $(this).html(event.strftime(
                                    '<div class="badge bg-success text-light"><span><b>%D</b> Days</span> <span><b>%-H</b> Hrs</span> <span><b>%M</b> Mins</span> <span><b>%S</b> Secs</span></div>'
                                ));
                            });
                        });
                    }
                },

            }

            window.onload = function() {
                MERCADO_JS.init();
            }

        })(window.Zepto || window.jQuery, window, document);
        // CountDownTimer('{{ $quests->created_at }}', 'countdown{{ $index }}');

        // function CountDownTimer(dt, id) {
        //     var end = new Date('{{ $quests->batas_waktu }}');
        //     var _second = 1000;
        //     var _minute = _second * 60;
        //     var _hour = _minute * 60;
        //     var _day = _hour * 24;
        //     var timer;

        //     function showRemaining() {
        //         var now = new Date();
        //         var distance = end - now;
        //         if (distance < 0) {

        //             clearInterval(timer);
        //             document.getElementById(id).innerHTML =
        //                 '<span class="badge bg-danger text-light">Quest Telah Berakhir!</span> ';
        //             return;
        //         } else {
        //             var days = Math.floor(distance / _day);
        //             var hours = Math.floor((distance % _day) / _hour);
        //             var minutes = Math.floor((distance % _hour) / _minute);
        //             var seconds = Math.floor((distance % _minute) / _second);

        //             document.getElementById(id).innerHTML = days + 'days ';
        //             document.getElementById(id).innerHTML += hours + 'hrs ';
        //             document.getElementById(id).innerHTML += minutes + 'mins ';
        //             document.getElementById(id).innerHTML += seconds + 'secs';
        //             document.getElementById(id).innerHTML +=
        //                 '<br><span class="badge bg-success text-light">Quest Tersedia!</span> ';

        //         }
        //     }
        //     timer = setInterval(showRemaining, 1000);
        // }
    </script>
@endsection
