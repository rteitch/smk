<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
                $query->select('batas_waktu');
            }]
        )->whereHas('user', function ($query) use ($user_name) {
            $query->where('name', 'LIKE', "%$user_name%");
        })->where('status', 'LIKE', "%$status%")->paginate(4);
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
        $order_q_s = \App\Models\OrderQ::findOrFail($id);
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
        $order_q_s->status = $request->get('status');

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
        //
    }

    // public function getBatasWaktu($id){
    //     $quest = new \App\Models\Quest()->findOrFail($id);
    //     $batas_waktu = $quest->batas_waktu;
    //     $
    //     return $
    // }

    public function tambahOrderQuest(Request $request, $id)
    {
        $quest_order = new \App\Models\OrderQ();
        // $quest = new \App\Models\Quest();
        // dd($quest->orderq());
        $quest_order->user_id = \Auth::user()->id;
        $quest_order->status = 'SUBMIT';
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
    }

    public function siswa(Request $request, $id)
    {
        $status = $request->get('status');
        $user_name = \Auth::user()->name;
        $orderq = \App\Models\OrderQ::with('user')->with(
            ['quest' => function ($query) {
                $query->select('batas_waktu','judul', 'deskripsi', 'level', 'skor', 'exp', 'image', 'file_pendukung', 'jenis_soal');
            }]
        )->whereHas('user', function ($query) use ($user_name) {
            $query->where('name', 'LIKE', "%$user_name%");
        })->where('status', 'LIKE', "%$status%")->where('user_id', 'LIKE', $id)->paginate(4);
        $quest = \App\Models\Quest::select('id', 'judul', 'deskripsi', 'level', 'skor', 'exp', 'image', 'batas_waktu', 'kesulitan', 'file_pendukung', 'jenis_soal')->get();

        // $orderq = \App\Models\OrderQ::with(
        //     'user'
        // )->with(
        //     ['quest' => function ($query) {
        //         $query->select('batas_waktu');
        //     }]
        // )->paginate(4);
        // dd($orderq);
        // $auth_user = \Auth::user()->id;
        // $orderq = \App\Models\OrderQ::where('user_id', $id)->paginate(4);
        return view('frontend.orderq.siswa', compact('orderq', 'quest'));
    }
}
