<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('frontend.orderr.index', compact('order_r_s'));
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
        return view('frontend.orderr.edit', compact('order_r_s'));
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
        $user_lama = $order_r_s->user;
        foreach ($order_r_s->reward as $reward) {
            $reward_syarat_skor = $reward->syarat_skor;
        }
        $status = $order_r_s->status = $request->get('status');


        $skor_lama = $user_lama->skor;
        $tukar_skor = $skor_lama - $reward_syarat_skor;
        if ($status == "DITERIMA") {
            $tukar_skor = $skor_lama - $reward_syarat_skor;
            \App\Models\User::where('id', $user_lama->id)->select('skor')->update(
                ['skor' => $tukar_skor]
            );
        }
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

    public function tukarOrderReward(Request $request, $id)
    {
        $tukar_reward = new \App\Models\OrderR();
        $reward = \App\Models\Reward::findOrfail($id);
        // $quest = new \App\Models\Quest();
        // dd($quest->orderq());
        $user_lama = Auth::user();
        $tukar_reward->user_id = $user_lama->id;
        $syarat_skor = $reward->syarat_skor;
        if ($user_lama->skor < $syarat_skor) {
            return redirect()->route('reward.published')->with('info', 'Anda tidak diizinkan menukar reward, skor tidak cukup');
        } else {
            $tukar_reward->status = 'PROSES';
            $tukar_reward->save();
            $tukar_reward->reward()->attach($id);
            return redirect()->route('reward.published')->with('status', 'Berhasil menukar Reward, reward sedang di proses');
        }
    }

    public function siswa(Request $request, $id)
    {
        $status = $request->get('status');
        $user = \App\Models\User::with('orderr')->select('name', 'id')->get();
        $user_name = Auth::user()->name;
        $orderr = \App\Models\OrderR::with('user')->with(
            ['reward' => function ($query) {
                $query->select('title', 'deskripsi', 'syarat_skor', 'image', 'pembuat', 'status');
            }]
        )->whereHas('user', function ($query) use ($user_name) {
            $query->where('name', 'LIKE', "%$user_name%");
        })->where('status', 'LIKE', "%$status%")->where('user_id', 'LIKE', $id)->paginate(4);
        $reward = \App\Models\Reward::select('id', 'title', 'deskripsi', 'syarat_skor', 'image', 'pembuat', 'status')->get();

        return view('frontend.orderr.siswa', compact('orderr', 'reward', 'user'));
    }
}
