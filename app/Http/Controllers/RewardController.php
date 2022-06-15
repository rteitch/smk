<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $status = $request->get('status');
        $keyword = $request->get('keyword') ?: '';

        if ($status) {
            $reward = \App\Models\Reward::where('title', "LIKE", "%$keyword%")->where('status', strtoupper($status))->paginate(10);
        } else {
            $reward = \App\Models\Reward::where("title", "LIKE", "%$keyword%")->paginate(10);
        }
        return view('backend.reward.index', ['reward' => $reward]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.reward.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_reward = new \App\Models\Reward();
        $new_reward->title = $request->get('title');
        $new_reward->deskripsi = $request->get('deskripsi');
        $new_reward->syarat_skor = $request->get('syarat_skor');
        $new_reward->created_by = \Auth::user()->id;
        $new_reward->pembuat = \Auth::user()->name;
        $new_reward->status = $request->get('save_action');
        $new_reward->slug = \Str::slug($request->get('title'));

        //cover / image
        $image = $request->file('image');

        if ($image) {
            $image_path = $image->store('reward-image', 'public');

            $new_reward->image = $image_path;
        }

        $new_reward->save();

        if ($request->get('save_action') == 'PUBLISH') {
            return redirect()->route('reward.index')->with('status', 'Reward successfully saved and published');
        } else {
            return redirect()->route('reward.create')->with('status', 'Reward saved as draft');
        }
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
        //
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
        //
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
}
