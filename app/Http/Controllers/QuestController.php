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
    public function index(Request $request)
    {
        $status = $request->get('status');
        $keyword = $request->get('keyword') ?: '';

        if($status){
            $quests = \App\Models\Quest::where('judul', "LIKE", "%$keyword%")->where('status', strtoupper($status))->paginate(10);
        } else {
            $quests = \App\Models\Quest::where("judul", "LIKE", "%$keyword%")->paginate(10);
        }
        return view('backend.quest.index', ['quests' => $quests]);
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

        $new_quest->kesulitan = $request->get('tingkat_kesulitan');
        $new_quest->created_by = \Auth::user()->id;
        $new_quest->pembuat = \Auth::user()->name;
        $new_quest->status = $request->get('save_action');
        $new_quest->slug = \Str::slug($request->get('judul'));

        // Pilihan Ganda, Laporan
        $new_quest->jenis_soal = $request->get('jenis_soal');
        $new_quest->jawaban_pilgan = $request->get('jawaban_pilgan');

        // file_pendukung

        $file_pendukung = $request->file('file_pendukung');

        if ($file_pendukung) {
            $filename = $file_pendukung->getClientOriginalName();
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

        if ($request->get('save_action') == 'PUBLISH') {
            return redirect()->route('quest.index')->with('status', 'Quest successfully saved and published');
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
        $quest_to_edit = \App\Models\Quest::findOrFail($id);
        return view('backend.quest.edit', ['quests' => $quest_to_edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requestquest
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $quest = \App\Models\Quest::findOrFail($id);
        $getJudul = $request->get('judul');
        $quest->judul = $getJudul;
        $quest->slug = \Str::slug($getJudul);
        $quest->deskripsi = $request->get('deskripsi');
        $quest->level = $request->get('level');
        $quest->skor = $request->get('skor');

        $quest->kesulitan = $request->get('tingkat_kesulitan');
        $quest->pembuat = \Auth::user()->name;

        $quest->jenis_soal = $request->get('jenis_soal');
        $quest->jawaban_pilgan = $request->get('jawaban_pilgan');

        // file pendukung
        $new_file_pendukung = $request->file('file_pendukung');

        if ($new_file_pendukung) {
            if ($quest->file_pendukung && file_exists(storage_path('app/public/' . $quest->file_pendukung))) {
                \Storage::delete('public/' . $quest->file_pendukung);
            }

            $filename = $new_file_pendukung->getClientOriginalName();
            $file_path = $new_file_pendukung->storeAs('file_pendukung', $filename, 'public');

            $quest->file_pendukung = $file_path;
        }

        // file image
        $new_image = $request->file('image');

        if ($new_image) {
            if ($quest->image && file_exists(storage_path('app/public/' . $quest->image))) {
                \Storage::delete('public/' . $quest->image);
            }

            $new_image_path = $new_image->store('quest-image', 'public');

            $quest->image = $new_image_path;
        }

        $quest->updated_by = \Auth::user()->id;

        $quest->status = $request->get('status');

        $quest->save();

        $quest->skill()->sync($request->get('skill'));

        return redirect()->route('quest.edit', [$quest->id])->with('status', 'Quest successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quests = \App\Models\Quest::findOrFail($id);
        $quests->delete();

        return redirect()->route('quest.index')->with('status', 'Quest moved to trash');
    }

    public function trash(){
        $quests = \App\Models\Quest::onlyTrashed()->paginate(10);
        return view('backend.quest.trash', ['quests' => $quests]);
    }

    public function deletePermanent($id){
        $quests = \App\Models\Quest::withTrashed()->findOrFail($id);

        if(!$quests->trashed()){
          return redirect()->route('quest.trash')->with('status', 'Quest is not in trash!')->with('status_type', 'alert');
        } else {
          $quests->skill()->detach();
          $quests->forceDelete();

          return redirect()->route('quest.trash')->with('status', 'Quest permanently deleted!');
        }
      }

      public function restore($id){
          $quests = \App\Models\Quest::withTrashed()->findOrFail($id);
          if($quests->trashed()){
              $quests->restore();
              return redirect()->route('quest.trash')->with('status', 'Quest successfully restored');
            } else {
                return redirect()->route('quest.trash')->with('status', 'Quest is not in trash');
            }
        }
}
