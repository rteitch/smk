<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderRController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->get('status');
        $user_name = $request->get('name');
        $order_r_s = \App\Models\OrderR::with('user')->whereHas('user', function ($query) use ($user_name) {
            $query->where('name', 'LIKE', "%$user_name%");
        })->where('status', 'LIKE', "%$status%")->paginate(10);


        return view('frontend.orderr.index', ['order_r_s' => $order_r_s]);
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
        $order_r_s = \App\Models\OrderR::findOrFail($id);
        return view('frontend.orderr.edit', ['order_r_s' => $order_r_s]);
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
        $order_r_s = \App\Models\OrderR::findOrFail($id);
        $order_r_s->status = $request->get('status');

        $order_r_s->save();

        return redirect()->route('orderr.edit', [$order_r_s->id])->with('status', 'Order Reward sucessfully updated');
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

    public function tambahOrderQuest(Request $request, $id)
    {
        $quest_order = new \App\Models\OrderQ();
        // $quest = new \App\Models\Quest();
        // dd($quest->orderq());
        $quest_order->user_id = Auth::user()->id;
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
}
