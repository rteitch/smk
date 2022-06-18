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
        $order_q_s = \App\Models\OrderQ::with('user')->with('quest')->whereHas('user', function($query) use ($user_name){
            $query->where('name', 'LIKE', "%$user_name%");
        })->where('status','LIKE', "%$status%")->paginate(10);


        return view('frontend.orderq.index', ['order_q_s' => $order_q_s]);
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
        $quest_order->user_id = \Auth::user()->id;
        $quest_order->status = 'SUBMIT';
        $CodeQuest = uniqid();
        $quest_order->quest_code = substr(md5($CodeQuest), 6, 6);
        $quest_order->save();

        $quest_id = \App\Models\OrderQ::findOrFail(\Auth::user()->id);
        $quest_order->quest()->attach([
            1 => ['order_q_s_id' => $quest_id],
            2 => ['user_id' => $$quest_order->user_id],
            3 => ['file_jawab' => null],
            4 => ['jawaban_pilgan' => null],
        ]);
        return redirect()->route('quest.published')->with('status', 'Berhasil mendaftarkan Quest di quest order');

    }
}
