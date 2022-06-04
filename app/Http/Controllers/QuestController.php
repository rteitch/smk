<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use LDAP\Result;

class QuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.quest.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_quest = new \App\Models\Quest();
        $new_quest->judul = $request->get('judul');
        $new_quest->deskripsi = $request->get('deskripsi');
        $new_quest->level = $request->get('level');
        $new_quest->skor = $request->get('skor');
        $new_quest->exp = $request->get('exp');

        $new_quest->created_by = \Auth::user()->id;

        $new_quest->status = $request->get('save_action');
        $new_quest->slug = \Str::slug($request->get('judul'));

        // Pilihan Ganda, Laporan
        $new_quest->jenis_soal = $request->get('jenis_soal');
        $new_quest->jawaban_pilgan = $request->get('jawaban_pilgan');

        // file_pendukung

        $file_pendukung = $request->file('file_pendukung');

        if ($file_pendukung){
            $filename = $file_pendukung->getClientOriginalName(). '.'. $file_pendukung->getClientOriginalExtension();
            $file_path = $file_pendukung->storeAs('file_pendukung', $filename, 'public');
            $new_quest->file_pendukung = $file_path;
        }

        //cover / image
        $image = $request->file('image');

        if ($image) {
            $image_path = $image->store('quest-image', 'public');

            $new_quest->image = $image_path;
        }

        $new_quest->save();

        $new_quest->skill()->attach($request->get('skill'));

        if($request->get('save_action') == 'PUBLISH'){
            return redirect()->route('quest.create')->with('status', 'Quest successfully saved and published');
          } else {
            return redirect()->route('quest.create')->with('status', 'Quest saved as draft');
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
