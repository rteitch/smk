<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use LDAP\Result;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class QuestController extends Controller
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
        //     if(Gate::allows('manage-quest')) return $next($request);

        //     abort(403, 'Anda tidak memiliki cukup hak akses');
        // });
    }
    public function index(Request $request)
    {
        $status = $request->get('status');
        $keyword = $request->get('keyword') ?: '';
        if (Gate::allows('isPengajardanAdmin')) {
            if ($status) {
                $quests = \App\Models\Quest::where('judul', "LIKE", "%$keyword%")->where('status', strtoupper($status))->paginate(10);
            } else {
                $quests = \App\Models\Quest::where("judul", "LIKE", "%$keyword%")->paginate(10);
            }
            return view('backend.quest.index', ['quests' => $quests]);
        } else {
            return view("errors.403");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('isPengajardanAdmin')) {
            return view('backend.quest.create');
        } else {
            return view("errors.403");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = \Validator::make($request->all(), [
            "judul" => "required|min:1|max:300",
            "deskripsi" => "required|min:1|max:300",
            "level" => "required|digits_between:0,100",
            "skor" => "required",
            "exp" => "required",
            "batas_waktu" => "required",
            // "pil_A" => "required",
            // "pil_B" => "required",
            // "pil_C" => "required",
            // "pil_D" => "required",
            // "pil_E" => "required",
            "tingkat_kesulitan" => "required",
            // "jenis_soal" => "required",
            // "file_pendukung" => "required|max:10000|mimes:doc,docx,pdf,excel",
            "image" => "mimes:jpeg,jpg,png",

        ])->validate();
        $new_quest = new \App\Models\Quest();
        $new_quest->judul = $request->get('judul');
        $new_quest->deskripsi = $request->get('deskripsi');
        $new_quest->level = $request->get('level');
        $new_quest->skor = $request->get('skor');
        $new_quest->exp = $request->get('exp');
        $new_quest->batas_waktu = $request->get('batas_waktu');
        $new_quest->pil_A = $request->get('pil_A');
        $new_quest->pil_B = $request->get('pil_B');
        $new_quest->pil_C = $request->get('pil_C');
        $new_quest->pil_D = $request->get('pil_D');
        $new_quest->pil_E = $request->get('pil_E');

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
        if (Gate::allows('isPengajardanAdmin')) {
            return view('backend.quest.edit', ['quests' => $quest_to_edit]);
        } else {
            return view("errors.403");
        }
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
        $slug = Str::slug($getJudul, '-');
        $quest->slug = $slug;
        $quest->deskripsi = $request->get('deskripsi');
        $quest->level = $request->get('level');
        $quest->skor = $request->get('skor');
        $quest->pil_A = $request->get('pil_A');
        $quest->pil_B = $request->get('pil_B');
        $quest->pil_C = $request->get('pil_C');
        $quest->pil_D = $request->get('pil_D');
        $quest->pil_E = $request->get('pil_E');

        $quest->batas_waktu = $request->get('batas_waktu');

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
        if (Gate::allows('isPengajardanAdmin')) {
            $quest->save();

            $quest->skill()->sync($request->get('skill'));

            return redirect()->route('quest.edit', [$quest->id])->with('status', 'Quest successfully updated');
        } else {
            return view("errors.403");
        }
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
        if (Gate::allows('isPengajardanAdmin')) {
            $quests->delete();

            return redirect()->route('quest.index')->with('status', 'Quest moved to trash');
        } else {
            return view("errors.403");
        }
    }

    public function trash(Request $request)
    {
        $status = $request->get('status');
        $keyword = $request->get('keyword') ?: '';

        if (Gate::allows('isPengajardanAdmin')) {
            if ($status) {
                $quests = \App\Models\Quest::onlyTrashed()->where('judul', "LIKE", "%$keyword%")->where('status', strtoupper($status))->paginate(10);
            } else {
                $quests = \App\Models\Quest::onlyTrashed()->where("judul", "LIKE", "%$keyword%")->paginate(10);
            }
            return view('backend.quest.trash', ['quests' => $quests]);
        } else {
            return view("errors.403");
        }
    }

    public function deletePermanent($id)
    {
        $quest = \App\Models\Quest::withTrashed()->findOrFail($id);
        // $orderq = \App\Models\OrderQ::findOrFail($id);
        // $orderq->delete();

        if (Gate::allows('isPengajardanAdmin')) {
            if (!$quest->trashed()) {
                return redirect()->route('quest.trash')->with('status', 'Can not delete permanent active quest');
            } else {
                $quest->orderq()->delete();
                $quest->skill()->detach();
                $quest->forceDelete();

                return redirect()->route('quest.trash')->with('status', 'Quest Permanently deleted');
            }
        } else {
            return view("errors.403");
        }
    }

    public function restore($id)
    {
        $quests = \App\Models\Quest::withTrashed()->findOrFail($id);

        if (Gate::allows('isPengajardanAdmin')) {
            if ($quests->trashed()) {
                $quests->restore();
                return redirect()->route('quest.trash')->with('status', 'Quest successfully restored');
            } else {
                return redirect()->route('quest.trash')->with('status', 'Quest is not in trash');
            }
        } else {
            return view("errors.403");
        }
    }

    public function published(Request $request)
    {
        // $quest_user = \App\Models\OrderQ::with('quest')->where('user_id', \Auth::user()->id)->get();
        $quest_user = \App\Models\Quest::whereHas('orderq', function ($query) {
            $query->where('user_id', '=', \Auth::user()->id);
        })->select('id')->get();

        // $skill_user = \App\Models\Skill::whereHas('user', function($query){
        //     $query->where('user_id', '=', \Auth::user()->id);
        // })->select('id')->get();
        // $skill_user = \App\Models\Skill::with('user')->get();

        // dd($skill_user);
        // $quest_data = \App\Models\Quest::whereNotIn('id', $quest_user)->get();
        $quest = \App\Models\Quest::whereNotIn('id', $quest_user)->with('skill')->orderBy('judul', 'asc')->where('status', 'PUBLISH')->paginate(10);

        $user_login = \Auth::user();
        $orderq = \App\Models\OrderQ::with('quest')->where('user_id', \Auth::user()->id)->get();
        $user = \App\Models\User::select('id', 'name', 'avatar')->get();

        return view('backend.quest.published', compact('quest', 'user', 'orderq', 'user_login'));
    }
}
