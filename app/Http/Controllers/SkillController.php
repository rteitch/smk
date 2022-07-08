<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class SkillController extends Controller
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
        //     if(Gate::allows('manage-skill')) return $next($request);

        //     abort(403, 'Anda tidak memiliki cukup hak akses');
        // });
    }
    public function index(Request $request)
    {
        $skill = \App\Models\Skill::orderBy('judul', 'asc')->paginate(8);

        $filterKeyword = $request->get('judul');
        if ($filterKeyword) {
            $skill = \App\Models\Skill::where("judul", "LIKE", "%$filterKeyword%")->paginate(8);
        }

        return view('backend.skill.index', ['skill' => $skill]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.skill.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $judul = $request->get('judul');
        $new_skill = new \App\Models\Skill;
        $new_skill->judul = $judul;

        $deskripsi = $request->get('deskripsi');
        $new_skill->deskripsi = $deskripsi;
        $new_skill->pembuat = \Auth::user()->name;

        if ($request->file('image')) {
            $image_path = $request->file('image')->store('Skill_images', 'public');
            $new_skill->image = $image_path;
        }

        $syarat_level = $request->get('syarat_lv');
        $new_skill->syarat_lv = $syarat_level;

        $new_skill->created_by = \Auth::user()->id;

        $new_skill->slug = Str::slug($judul, '-');

        $new_skill->save();
        $new_skill->jobclass()->attach($request->get('jobclass'));

        return redirect()->route('skill.index')->with('status', 'Skill baru Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $skill = \App\Models\Skill::findOrFail($id);

        return view('backend.skill.show', ['skills' => $skill]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $skill_to_edit = \App\Models\Skill::findOrFail($id);

        return view('backend.skill.edit', ['skills' => $skill_to_edit]);
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
        $judul = $request->get('judul');
        $slug = Str::slug($judul, '-');
        $deskripsi = $request->get('deskripsi');
        $syarat_level = $request->get('syarat_lv');

        $skill = \App\Models\Skill::findOrFail($id);
        $skill->judul = $judul;
        $skill->pembuat = \Auth::user()->name;
        $skill->syarat_lv = $syarat_level;
        $skill->deskripsi = $deskripsi;
        $skill->slug = $slug;

        if ($request->file('image')) {
            if ($skill->image && file_exists(storage_path('app/public/' . $skill->image))) {
                \Storage::delete('public/' . $skill->image);
            }

            $new_image = $request->file('image')->store('skill_images', 'public');

            $skill->image = $new_image;
        }

        $skill->save();
        $skill->jobclass()->sync($request->get('jobclass'));

        return redirect()->route('skill.index', [$id])->with('status', 'Skill Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skill = \App\Models\Skill::findOrFail($id);

        $skill->delete();
        return redirect()->route('skill.index')
            ->with('status-delete', 'Skill Berhasil dipindah ke trash');
    }

    public function trash(Request $request)
    {
        $deleted_skill = \App\Models\Skill::onlyTrashed()->paginate(8);

        $filterKeyword = $request->get('judul');
        if ($filterKeyword) {
            $deleted_skill = \App\Models\Skill::onlyTrashed()->where("judul", "LIKE", "%$filterKeyword%")->paginate(8);
        }
        return view('backend.skill.trash', ['skills' => $deleted_skill]);
    }

    public function restore($id)
    {
        $skill = \App\Models\Skill::withTrashed()->findOrFail($id);

        if ($skill->trashed()) {
            $skill->restore();
        } else {
            return redirect()->route('skill.index')
                ->with('status', 'Skill is not in trash');
        }

        return redirect()->route('skill.index')
            ->with('status', 'Skill successfully restored');
    }

    public function deletePermanent($id)
    {
        $skill = \App\Models\Skill::withTrashed()->findOrFail($id);

        if (!$skill->trashed()) {
            return redirect()->route('skill.trash')->with('status', 'Can not delete permanent active skill');
        } else {
            $skill->jobclass()->detach();
            $skill->forceDelete();
            return redirect()->route('skill.index')->with('status', 'Skill Permanently deleted');
        }
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');
        $skill = \App\Models\Skill::where("judul", "LIKE", "%$keyword%")->get();

        return $skill;
    }

    public function skill($slug)
    {
        $skill = \App\Models\Skill::with('artikel')->where('slug', $slug)->paginate(4);
        return view('backend.artikel.skill', ['skill' => $skill]);
    }

    public function skillJobClass($slug)
    {
        $skill_jobclass = \App\Models\Skill::with('jobclass')->where('slug', $slug)->paginate(4);
        return view('backend.jobclass.skill', ['skill_jobclass' => $skill_jobclass]);
    }

    public function published(Request $request)
    {
        $auth_user = \Auth::user();
        // dd($auth_user->skill->count());
        $id_user = \Auth::user()->id;
        $skill = \App\Models\Skill::with('jobclass')->paginate(6);
        $user = \App\Models\User::with('jobclass', 'skill')->findOrFail($id_user);
        return view('backend.skill.published', compact('skill', 'user'));
    }
}
