<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


class OrderQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // Otorisasi Gate
        // $this->middleware(function($request, $next){
        //     if(Gate::allows('manage-order-quest')) return $next($request);

        //     abort(403, 'Anda tidak memiliki cukup hak akses');
        // });
    }
    public function index(Request $request)
    {
        $status = $request->get('status');
        $user_name = $request->get('name');
        // $orderq = \App\Models\OrderQ::with('user')->with('quest')->whereHas('user', function($query) use ($user_name){
        //     $query->where('name', 'LIKE', "%$user_name%");
        // })->where('status','LIKE', "%$status%")->paginate(10);
        $orderq = \App\Models\OrderQ::with('user')->with(
            ['quest' => function ($query) {
                $query->select('batas_waktu', 'judul');
            }]
        )->whereHas('user', function ($query) use ($user_name) {
            $query->where('name', 'LIKE', "%$user_name%");
        })->where('status', 'LIKE', "%$status%")->paginate(10);
        return view('frontend.orderq.index', compact('orderq'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order_q_s = \App\Models\OrderQ::with('quest')->findOrFail($id);
        return view('frontend.orderq.edit', ['order_q_s' => $order_q_s]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order_q_s = \App\Models\OrderQ::findOrFail($id);
        $user_lama = $order_q_s->user;
        foreach ($order_q_s->quest as $quests) {
            $quest_skor = $quests->skor;
            $quest_exp = $quests->exp;
        }
        $status = $order_q_s->status = $request->get('status');

        $exp_lama = $user_lama->exp;
        $skor_lama = $user_lama->skor;
        $tambah_exp = $exp_lama + $quest_exp;

        $tambah_skor = $skor_lama + $quest_skor;
        if ($status == "SELESAI") {
            $total_exp = $user_lama->exp = $tambah_exp;
            $total_skor = $user_lama->skor = $tambah_skor;
            //logika update level ketika exp bertambah level dalam ga web max adalah 99
            switch ($total_exp) {
                case $total_exp == 0:
                    $user_lama->level = 1;
                    break;
                case ($total_exp - 0) <= 700:
                    $user_lama->level = 1;
                    break;
                case ($total_exp - 2100) <= 2100:
                    $user_lama->level = 2;
                    break;
                case ($total_exp - 3500) <= 3500:
                    $user_lama->level = 3;
                    break;
                case ($total_exp - 4900) <= 4900:
                    $user_lama->level = 4;
                    break;
                case ($total_exp - 6300) <= 6300:
                    $user_lama->level = 5;
                    break;
                case ($total_exp - 7700) <= 7700:
                    $user_lama->level = 6;
                    break;
                case ($total_exp - 9100) <= 9100:
                    $user_lama->level = 7;
                    break;
                case ($total_exp - 10500) <= 10500:
                    $user_lama->level = 8;
                    break;
                case ($total_exp - 11900) <= 11900:
                    $user_lama->level = 9;
                    break;
                case ($total_exp - 13300) <= 13300:
                    $user_lama->level = 10;
                    break;
                case ($total_exp - 14700) <= 14700:
                    $user_lama->level = 11;
                    break;
                case ($total_exp - 16100) <= 16100:
                    $user_lama->level = 12;
                    break;
                case ($total_exp - 17500) <= 17500:
                    $user_lama->level = 13;
                    break;
                case ($total_exp - 18900) <= 18900:
                    $user_lama->level = 14;
                    break;
                case ($total_exp - 20300) <= 20300:
                    $user_lama->level = 15;
                    break;
                case ($total_exp - 21700) <= 21700:
                    $user_lama->level = 16;
                    break;
                case ($total_exp - 23100) <= 23100:
                    $user_lama->level = 17;
                    break;
                case ($total_exp - 24500) <= 24500:
                    $user_lama->level = 18;
                    break;
                case ($total_exp - 25900) <= 25900:
                    $user_lama->level = 19;
                    break;
                case ($total_exp - 27300) <= 27300:
                    $user_lama->level = 20;
                    break;
                case ($total_exp - 28700) <= 28700:
                    $user_lama->level = 21;
                    break;
                case ($total_exp - 30100) <= 30100:
                    $user_lama->level = 22;
                    break;
                case ($total_exp - 31500) <= 31500:
                    $user_lama->level = 23;
                    break;
                case ($total_exp - 32900) <= 32900:
                    $user_lama->level = 24;
                    break;
                case ($total_exp - 34300) <= 34300:
                    $user_lama->level = 25;
                    break;
                case ($total_exp - 35700) <= 35700:
                    $user_lama->level = 26;
                    break;
                case ($total_exp - 37100) <= 37100:
                    $user_lama->level = 27;
                    break;
                case ($total_exp - 38500) <= 38500:
                    $user_lama->level = 28;
                    break;
                case ($total_exp - 39900) <= 39900:
                    $user_lama->level = 29;
                    break;
                case ($total_exp - 41300) <= 41300:
                    $user_lama->level = 30;
                    break;
                case ($total_exp - 42700) <= 42700:
                    $user_lama->level = 31;
                    break;
                case ($total_exp - 44100) <= 44100:
                    $user_lama->level = 32;
                    break;
                case ($total_exp - 45500) <= 45500:
                    $user_lama->level = 33;
                    break;
                case ($total_exp - 46900) <= 46900:
                    $user_lama->level = 34;
                    break;
                case ($total_exp - 48300) <= 48300:
                    $user_lama->level = 35;
                    break;
                case ($total_exp - 49700) <= 49700:
                    $user_lama->level = 36;
                    break;
                case ($total_exp - 51100) <= 51100:
                    $user_lama->level = 37;
                    break;
                case ($total_exp - 52500) <= 52500:
                    $user_lama->level = 38;
                    break;
                case ($total_exp - 53900) <= 53900:
                    $user_lama->level = 39;
                    break;
                case ($total_exp - 55300) <= 55300:
                    $user_lama->level = 40;
                    break;
                case ($total_exp - 56700) <= 56700:
                    $user_lama->level = 41;
                    break;
                case ($total_exp - 58100) <= 58100:
                    $user_lama->level = 42;
                    break;
                case ($total_exp - 59500) <= 59500:
                    $user_lama->level = 43;
                    break;
                case ($total_exp - 60900) <= 60900:
                    $user_lama->level = 44;
                    break;
                case ($total_exp - 62300) <= 62300:
                    $user_lama->level = 45;
                    break;
                case ($total_exp - 63700) <= 63700:
                    $user_lama->level = 46;
                    break;
                case ($total_exp - 65100) <= 65100:
                    $user_lama->level = 47;
                    break;
                case ($total_exp - 66500) <= 66500:
                    $user_lama->level = 48;
                    break;
                case ($total_exp - 67900) <= 67900:
                    $user_lama->level = 49;
                    break;
                case ($total_exp - 69300) <= 69300:
                    $user_lama->level = 50;
                    break;
                case ($total_exp - 70700) <= 70700:
                    $user_lama->level = 51;
                    break;
                case ($total_exp - 72100) <= 72100:
                    $user_lama->level = 52;
                    break;
                case ($total_exp - 73500) <= 73500:
                    $user_lama->level = 53;
                    break;
                case ($total_exp - 74900) <= 74900:
                    $user_lama->level = 54;
                    break;
                case ($total_exp - 76300) <= 76300:
                    $user_lama->level = 55;
                    break;
                case ($total_exp - 77700) <= 77700:
                    $user_lama->level = 56;
                    break;
                case ($total_exp - 79100) <= 79100:
                    $user_lama->level = 57;
                    break;
                case ($total_exp - 80500) <= 80500:
                    $user_lama->level = 58;
                    break;
                case ($total_exp - 81900) <= 81900:
                    $user_lama->level = 59;
                    break;
                case ($total_exp - 83300) <= 83300:
                    $user_lama->level = 60;
                    break;
                case ($total_exp - 84700) <= 84700:
                    $user_lama->level = 61;
                    break;
                case ($total_exp - 86100) <= 86100:
                    $user_lama->level = 62;
                    break;
                case ($total_exp - 87500) <= 87500:
                    $user_lama->level = 63;
                    break;
                case ($total_exp - 88900) <= 88900:
                    $user_lama->level = 64;
                    break;
                case ($total_exp - 90300) <= 90300:
                    $user_lama->level = 65;
                    break;
                case ($total_exp - 91700) <= 91700:
                    $user_lama->level = 66;
                    break;
                case ($total_exp - 93100) <= 93100:
                    $user_lama->level = 67;
                    break;
                case ($total_exp - 94500) <= 94500:
                    $user_lama->level = 68;
                    break;
                case ($total_exp - 95900) <= 95900:
                    $user_lama->level = 69;
                    break;
                case ($total_exp - 97300) <= 97300:
                    $user_lama->level = 70;
                    break;
                case ($total_exp - 98700) <= 98700:
                    $user_lama->level = 71;
                    break;
                case ($total_exp - 100100) <= 100100:
                    $user_lama->level = 72;
                    break;
                case ($total_exp - 101500) <= 101500:
                    $user_lama->level = 73;
                    break;
                case ($total_exp - 102900) <= 102900:
                    $user_lama->level = 74;
                    break;
                case ($total_exp - 104300) <= 104300:
                    $user_lama->level = 75;
                    break;
                case ($total_exp - 105700) <= 105700:
                    $user_lama->level = 76;
                    break;
                case ($total_exp - 107100) <= 107100:
                    $user_lama->level = 77;
                    break;
                case ($total_exp - 108500) <= 108500:
                    $user_lama->level = 78;
                    break;
                case ($total_exp - 109900) <= 109900:
                    $user_lama->level = 79;
                    break;
                case ($total_exp - 111300) <= 111300:
                    $user_lama->level = 80;
                    break;
                case ($total_exp - 112700) <= 112700:
                    $user_lama->level = 81;
                    break;
                case ($total_exp - 114100) <= 114100:
                    $user_lama->level = 82;
                    break;
                case ($total_exp - 115500) <= 115500:
                    $user_lama->level = 83;
                    break;
                case ($total_exp - 116900) <= 116900:
                    $user_lama->level = 84;
                    break;
                case ($total_exp - 118300) <= 118300:
                    $user_lama->level = 85;
                    break;
                case ($total_exp - 119700) <= 119700:
                    $user_lama->level = 86;
                    break;
                case ($total_exp - 121100) <= 121100:
                    $user_lama->level = 87;
                    break;
                case ($total_exp - 122500) <= 122500:
                    $user_lama->level = 88;
                    break;
                case ($total_exp - 123900) <= 123900:
                    $user_lama->level = 89;
                    break;
                case ($total_exp - 125300) <= 125300:
                    $user_lama->level = 90;
                    break;
                case ($total_exp - 126700) <= 126700:
                    $user_lama->level = 91;
                    break;
                case ($total_exp - 128100) <= 128100:
                    $user_lama->level = 92;
                    break;
                case ($total_exp - 129500) <= 129500:
                    $user_lama->level = 93;
                    break;
                case ($total_exp - 130900) <= 130900:
                    $user_lama->level = 94;
                    break;
                case ($total_exp - 132300) <= 132300:
                    $user_lama->level = 95;
                    break;
                case ($total_exp - 133700) <= 133700:
                    $user_lama->level = 96;
                    break;
                case ($total_exp - 135100) <= 135100:
                    $user_lama->level = 97;
                    break;
                case ($total_exp - 136500) <= 136500:
                    $user_lama->level = 98;
                    break;
                case ($total_exp - 137900) <= 137900:
                    $user_lama->level = 99;
                    break;
                case ($total_exp - 139300) <= 139300:
                    $user_lama->level = 100;
                    break;
                case ($total_exp - 139300) > 139300:
                    $user_lama->level = 100;
                    break;
            }
            \App\Models\User::where('id', $user_lama->id)->select('exp', 'skor')->update(
                ['exp' => $total_exp, 'skor' => $total_skor]
            );
        }
        $order_q_s->save();

        return redirect()->route('orderq.edit', [$order_q_s->id])->with('status', 'Order Quest sucessfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orderq = \App\Models\OrderQ::findOrFail($id);
        $orderq->delete();
        $orderq->quest()->detach();

        return redirect()->route('orderq.siswa', \Auth::user()->id)->with('status', 'Order Quest berhasil dibatalkan');
    }

    // public function getBatasWaktu($id){
    //     $quest = new \App\Models\Quest()->findOrFail($id);
    //     $batas_waktu = $quest->batas_waktu;
    //     $
    //     return $
    // }

    public function tambahOrderQuest(Request $request, $id)
    {
        //syarat yang harus dipenuhi level harus sama dengan syarat quest atau dibawahnya
        $quest_order = new \App\Models\OrderQ();
        $quest = \App\Models\Quest::findOrfail($id);
        $user_lama = Auth::user();
        if ($user_lama->level >= $quest->level) {
            $quest_order->user_id = $user_lama->id;
            $quest_order->file_jawab = null;
            $quest_order->jawaban_pilgan = null;
            $quest_order->status = 'SUBMIT';
            $CodeQuest = uniqid();
            $quest_order->quest_code = substr(md5($CodeQuest), 6, 6);
            $quest_order->save();
            $quest_order->quest()->attach($id);
            // $quest_id = \App\Models\OrderQ::findOrFail(\Auth::user()->id);
            // $hasQuest = $
            return redirect()->route('quest.published')->with('status', 'Berhasil mendaftarkan Quest di quest order');
        } else {
            return redirect()->route('quest.published')->with('status', 'Tidak bisa mengambil quest, level tidak mencukupi');
        }
    }

    public function siswa(Request $request, $id)
    {
        $status = $request->get('status');
        $user = \App\Models\User::with('orderq')->select('name', 'id')->get();
        $user_name = Auth::user()->name;
        $orderq = \App\Models\OrderQ::with('user')->with(
            ['quest' => function ($query) {
                $query->select('batas_waktu', 'judul', 'deskripsi', 'level', 'skor', 'exp', 'image', 'file_pendukung', 'jenis_soal');
            }]
        )->whereHas('user', function ($query) use ($user_name) {
            $query->where('name', 'LIKE', "%$user_name%");
        })->where('status', 'LIKE', "%$status%")->where('user_id', 'LIKE', $id)->paginate(4);
        $quest = \App\Models\Quest::select('id', 'judul', 'deskripsi', 'level', 'skor', 'exp', 'image', 'batas_waktu', 'kesulitan', 'file_pendukung', 'jenis_soal', 'pil_A', 'pil_B', 'pil_C', 'pil_D', 'pil_E', 'pembuat')->get();

        return view('frontend.orderq.siswa', compact('orderq', 'quest', 'user'));
    }


    public function updateJawaban(Request $request, $id, $quest_id)
    {
        $order_q_s = \App\Models\OrderQ::findOrFail($id);
        $quest = \App\Models\Quest::where('id', 'LIKE', $quest_id)->get();
        foreach ($quest as $quests) {
            $quest_kunci = $quests->jawaban_pilgan;
            $quest_kunci_file_jawab = $quests->file_jawab;
            $quest_skor = $quests->skor;
            $quest_exp = $quests->exp;
        }
        $user_login = \App\Models\User::findOrFail(Auth::user()->id);
        $cekJawabanPilgan = $request->get('jawaban_pilgan');
        $jawaban_user = $order_q_s->jawaban_pilgan = $cekJawabanPilgan;
        if ($cekJawabanPilgan) {
            if ($jawaban_user == $quest_kunci) {
                $skor_lama = $user_login->skor;
                $hitung_skor = $skor_lama + $quest_skor;

                $exp_lama = $user_login->exp;
                $hitung_exp = $exp_lama + $quest_exp;
                //logika update level ketika exp bertambah level dalam ga web max adalah 99
                switch ($hitung_exp) {
                    case $hitung_exp == 0:
                        $user_login->level = 1;
                        break;
                    case ($hitung_exp - 0) <= 700:
                        $user_login->level = 1;
                        break;
                    case ($hitung_exp - 2100) <= 2100:
                        $user_login->level = 2;
                        break;
                    case ($hitung_exp - 3500) <= 3500:
                        $user_login->level = 3;
                        break;
                    case ($hitung_exp - 4900) <= 4900:
                        $user_login->level = 4;
                        break;
                    case ($hitung_exp - 6300) <= 6300:
                        $user_login->level = 5;
                        break;
                    case ($hitung_exp - 7700) <= 7700:
                        $user_login->level = 6;
                        break;
                    case ($hitung_exp - 9100) <= 9100:
                        $user_login->level = 7;
                        break;
                    case ($hitung_exp - 10500) <= 10500:
                        $user_login->level = 8;
                        break;
                    case ($hitung_exp - 11900) <= 11900:
                        $user_login->level = 9;
                        break;
                    case ($hitung_exp - 13300) <= 13300:
                        $user_login->level = 10;
                        break;
                    case ($hitung_exp - 14700) <= 14700:
                        $user_login->level = 11;
                        break;
                    case ($hitung_exp - 16100) <= 16100:
                        $user_login->level = 12;
                        break;
                    case ($hitung_exp - 17500) <= 17500:
                        $user_login->level = 13;
                        break;
                    case ($hitung_exp - 18900) <= 18900:
                        $user_login->level = 14;
                        break;
                    case ($hitung_exp - 20300) <= 20300:
                        $user_login->level = 15;
                        break;
                    case ($hitung_exp - 21700) <= 21700:
                        $user_login->level = 16;
                        break;
                    case ($hitung_exp - 23100) <= 23100:
                        $user_login->level = 17;
                        break;
                    case ($hitung_exp - 24500) <= 24500:
                        $user_login->level = 18;
                        break;
                    case ($hitung_exp - 25900) <= 25900:
                        $user_login->level = 19;
                        break;
                    case ($hitung_exp - 27300) <= 27300:
                        $user_login->level = 20;
                        break;
                    case ($hitung_exp - 28700) <= 28700:
                        $user_login->level = 21;
                        break;
                    case ($hitung_exp - 30100) <= 30100:
                        $user_login->level = 22;
                        break;
                    case ($hitung_exp - 31500) <= 31500:
                        $user_login->level = 23;
                        break;
                    case ($hitung_exp - 32900) <= 32900:
                        $user_login->level = 24;
                        break;
                    case ($hitung_exp - 34300) <= 34300:
                        $user_login->level = 25;
                        break;
                    case ($hitung_exp - 35700) <= 35700:
                        $user_login->level = 26;
                        break;
                    case ($hitung_exp - 37100) <= 37100:
                        $user_login->level = 27;
                        break;
                    case ($hitung_exp - 38500) <= 38500:
                        $user_login->level = 28;
                        break;
                    case ($hitung_exp - 39900) <= 39900:
                        $user_login->level = 29;
                        break;
                    case ($hitung_exp - 41300) <= 41300:
                        $user_login->level = 30;
                        break;
                    case ($hitung_exp - 42700) <= 42700:
                        $user_login->level = 31;
                        break;
                    case ($hitung_exp - 44100) <= 44100:
                        $user_login->level = 32;
                        break;
                    case ($hitung_exp - 45500) <= 45500:
                        $user_login->level = 33;
                        break;
                    case ($hitung_exp - 46900) <= 46900:
                        $user_login->level = 34;
                        break;
                    case ($hitung_exp - 48300) <= 48300:
                        $user_login->level = 35;
                        break;
                    case ($hitung_exp - 49700) <= 49700:
                        $user_login->level = 36;
                        break;
                    case ($hitung_exp - 51100) <= 51100:
                        $user_login->level = 37;
                        break;
                    case ($hitung_exp - 52500) <= 52500:
                        $user_login->level = 38;
                        break;
                    case ($hitung_exp - 53900) <= 53900:
                        $user_login->level = 39;
                        break;
                    case ($hitung_exp - 55300) <= 55300:
                        $user_login->level = 40;
                        break;
                    case ($hitung_exp - 56700) <= 56700:
                        $user_login->level = 41;
                        break;
                    case ($hitung_exp - 58100) <= 58100:
                        $user_login->level = 42;
                        break;
                    case ($hitung_exp - 59500) <= 59500:
                        $user_login->level = 43;
                        break;
                    case ($hitung_exp - 60900) <= 60900:
                        $user_login->level = 44;
                        break;
                    case ($hitung_exp - 62300) <= 62300:
                        $user_login->level = 45;
                        break;
                    case ($hitung_exp - 63700) <= 63700:
                        $user_login->level = 46;
                        break;
                    case ($hitung_exp - 65100) <= 65100:
                        $user_login->level = 47;
                        break;
                    case ($hitung_exp - 66500) <= 66500:
                        $user_login->level = 48;
                        break;
                    case ($hitung_exp - 67900) <= 67900:
                        $user_login->level = 49;
                        break;
                    case ($hitung_exp - 69300) <= 69300:
                        $user_login->level = 50;
                        break;
                    case ($hitung_exp - 70700) <= 70700:
                        $user_login->level = 51;
                        break;
                    case ($hitung_exp - 72100) <= 72100:
                        $user_login->level = 52;
                        break;
                    case ($hitung_exp - 73500) <= 73500:
                        $user_login->level = 53;
                        break;
                    case ($hitung_exp - 74900) <= 74900:
                        $user_login->level = 54;
                        break;
                    case ($hitung_exp - 76300) <= 76300:
                        $user_login->level = 55;
                        break;
                    case ($hitung_exp - 77700) <= 77700:
                        $user_login->level = 56;
                        break;
                    case ($hitung_exp - 79100) <= 79100:
                        $user_login->level = 57;
                        break;
                    case ($hitung_exp - 80500) <= 80500:
                        $user_login->level = 58;
                        break;
                    case ($hitung_exp - 81900) <= 81900:
                        $user_login->level = 59;
                        break;
                    case ($hitung_exp - 83300) <= 83300:
                        $user_login->level = 60;
                        break;
                    case ($hitung_exp - 84700) <= 84700:
                        $user_login->level = 61;
                        break;
                    case ($hitung_exp - 86100) <= 86100:
                        $user_login->level = 62;
                        break;
                    case ($hitung_exp - 87500) <= 87500:
                        $user_login->level = 63;
                        break;
                    case ($hitung_exp - 88900) <= 88900:
                        $user_login->level = 64;
                        break;
                    case ($hitung_exp - 90300) <= 90300:
                        $user_login->level = 65;
                        break;
                    case ($hitung_exp - 91700) <= 91700:
                        $user_login->level = 66;
                        break;
                    case ($hitung_exp - 93100) <= 93100:
                        $user_login->level = 67;
                        break;
                    case ($hitung_exp - 94500) <= 94500:
                        $user_login->level = 68;
                        break;
                    case ($hitung_exp - 95900) <= 95900:
                        $user_login->level = 69;
                        break;
                    case ($hitung_exp - 97300) <= 97300:
                        $user_login->level = 70;
                        break;
                    case ($hitung_exp - 98700) <= 98700:
                        $user_login->level = 71;
                        break;
                    case ($hitung_exp - 100100) <= 100100:
                        $user_login->level = 72;
                        break;
                    case ($hitung_exp - 101500) <= 101500:
                        $user_login->level = 73;
                        break;
                    case ($hitung_exp - 102900) <= 102900:
                        $user_login->level = 74;
                        break;
                    case ($hitung_exp - 104300) <= 104300:
                        $user_login->level = 75;
                        break;
                    case ($hitung_exp - 105700) <= 105700:
                        $user_login->level = 76;
                        break;
                    case ($hitung_exp - 107100) <= 107100:
                        $user_login->level = 77;
                        break;
                    case ($hitung_exp - 108500) <= 108500:
                        $user_login->level = 78;
                        break;
                    case ($hitung_exp - 109900) <= 109900:
                        $user_login->level = 79;
                        break;
                    case ($hitung_exp - 111300) <= 111300:
                        $user_login->level = 80;
                        break;
                    case ($hitung_exp - 112700) <= 112700:
                        $user_login->level = 81;
                        break;
                    case ($hitung_exp - 114100) <= 114100:
                        $user_login->level = 82;
                        break;
                    case ($hitung_exp - 115500) <= 115500:
                        $user_login->level = 83;
                        break;
                    case ($hitung_exp - 116900) <= 116900:
                        $user_login->level = 84;
                        break;
                    case ($hitung_exp - 118300) <= 118300:
                        $user_login->level = 85;
                        break;
                    case ($hitung_exp - 119700) <= 119700:
                        $user_login->level = 86;
                        break;
                    case ($hitung_exp - 121100) <= 121100:
                        $user_login->level = 87;
                        break;
                    case ($hitung_exp - 122500) <= 122500:
                        $user_login->level = 88;
                        break;
                    case ($hitung_exp - 123900) <= 123900:
                        $user_login->level = 89;
                        break;
                    case ($hitung_exp - 125300) <= 125300:
                        $user_login->level = 90;
                        break;
                    case ($hitung_exp - 126700) <= 126700:
                        $user_login->level = 91;
                        break;
                    case ($hitung_exp - 128100) <= 128100:
                        $user_login->level = 92;
                        break;
                    case ($hitung_exp - 129500) <= 129500:
                        $user_login->level = 93;
                        break;
                    case ($hitung_exp - 130900) <= 130900:
                        $user_login->level = 94;
                        break;
                    case ($hitung_exp - 132300) <= 132300:
                        $user_login->level = 95;
                        break;
                    case ($hitung_exp - 133700) <= 133700:
                        $user_login->level = 96;
                        break;
                    case ($hitung_exp - 135100) <= 135100:
                        $user_login->level = 97;
                        break;
                    case ($hitung_exp - 136500) <= 136500:
                        $user_login->level = 98;
                        break;
                    case ($hitung_exp - 137900) <= 137900:
                        $user_login->level = 99;
                        break;
                    case ($hitung_exp - 139300) <= 139300:
                        $user_login->level = 100;
                        break;
                    case ($hitung_exp - 139300) > 139300:
                        $user_login->level = 100;
                        break;
                }

                //simpan ke field, untuk dikirim ke db
                $user_login->skor = $hitung_skor;
                $user_login->exp = $hitung_exp;
                $order_q_s->status = "SELESAI";
            } elseif ($jawaban_user !== $quest_kunci) {
                $order_q_s->status = "GAGAL";
            }
        }
        //update file jawab
        $file_pendukung = $request->file('file_jawaban_siswa');
        if ($file_pendukung) {
            $filename = $file_pendukung->getClientOriginalName();
            $file_path = $file_pendukung->storeAs('file_jawab', $filename, 'public');
            $order_q_s->file_jawab = $file_path;
            $order_q_s->status = "PROSES";
        }

        $user_login->save();
        $order_q_s->save();

        return redirect()->route('orderq.siswa', Auth::user()->id)->with('status', 'Berhasil Upload tugas sucessfully updated');
    }

    // public function hapusOrderQuest($id){
    //     $orderq = \App\Models\OrderQ::findOrFail($id);
    //     $orderq->delete();
    //     $orderq->quest()->detach();

    //     return redirect()->route('orderq.siswa')->with('status', 'Order Quest Berhasil dihapus dari daftar');
    // }
}
