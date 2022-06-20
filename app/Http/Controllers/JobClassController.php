<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class JobClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // // Otorisasi Gate
        // $this->middleware(function($request, $next){
        //     if(Gate::allows('manage-job-class')) return $next($request);

        //     abort(403, 'Anda tidak memiliki cukup hak akses');
        // });
    }
    public function index(Request $request)
    {
        $jobclass = \App\Models\JobClass::orderBy('name', 'asc')->paginate(10);

        $filterKeyword = $request->get('name');
        if ($filterKeyword) {
            $jobclass = \App\Models\JobClass::where("name", "LIKE", "%$filterKeyword%")->paginate(10);
        }
        return view('backend.jobclass.index', ['jobclass' => $jobclass]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.jobclass.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->get('name');
        $new_jobclass = new \App\Models\JobClass;
        $new_jobclass->name = $name;
        $new_jobclass->pembuat = \Auth::user()->name;

        $deskripsi = $request->get('deskripsi');
        $new_jobclass->deskripsi = $deskripsi;

        if ($request->file('image')) {
            $image_path = $request->file('image')->store('jobclass_images', 'public');
            $new_jobclass->image = $image_path;
        }

        $new_jobclass->created_by = \Auth::user()->id;

        $new_jobclass->slug = Str::slug($name, '-');

        $new_jobclass->save();
        dd($new_jobclass->save());

        return redirect()->route('jobclass.index')->with('status', 'Job Class baru Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jobclass = \App\Models\JobClass::findOrFail($id);

        return view('backend.jobclass.show', ['jobclass' => $jobclass]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jobclass_to_edit = \App\Models\JobClass::findOrFail($id);

        return view('backend.jobclass.edit', ['jobclass' => $jobclass_to_edit]);
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
        $name = $request->get('name');
        $deskripsi = $request->get('deskripsi');
        $slug = Str::slug($name, '-');

        $jobclass = \App\Models\JobClass::findOrFail($id);
        $jobclass->name = $name;
        $jobclass->pembuat = \Auth::user()->name;
        $jobclass->deskripsi = $deskripsi;
        $jobclass->slug = $slug;

        if ($request->file('image')) {
            if ($jobclass->image && file_exists(storage_path('app/public/' . $jobclass->image))) {
                \Storage::delete('public/' . $jobclass->image);
            }

            $new_image = $request->file('image')->store('jobclass_images', 'public');

            $jobclass->image = $new_image;
        }

        $jobclass->save();
        return redirect()->route('jobclass.show', [$id])->with('status', 'Job Class Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobclass = \App\Models\JobClass::findOrFail($id);

        $jobclass->delete();
        return redirect()->route('jobclass.index')
            ->with('status', 'Job Class Berhasil dipindah ke trash');
    }

    public function trash()
    {
        $deleted_job_class = \App\Models\JobClass::onlyTrashed()->paginate(10);

        return view('backend.jobclass.trash', ['jobclass' => $deleted_job_class]);
    }

    public function restore($id)
    {
        $jobclass = \App\Models\JobClass::withTrashed()->findOrFail($id);

        if ($jobclass->trashed()) {
            $jobclass->restore();
        } else {
            return redirect()->route('jobclass.index')
                ->with('status', 'Job CLass is not in trash');
        }

        return redirect()->route('jobclass.index')
            ->with('status', 'Job CLass successfully restored');
    }

    public function deletePermanent($id){
        $jobclass = \App\Models\JobClass::withTrashed()->findOrFail($id);

        if(!$jobclass->trashed()){
            return redirect()->route('jobclass.index')->with('status', 'Can not delete permanent active job class');
        } else {
            $jobclass->forceDelete();
            return redirect()->route('jobclass.index')->with('status', 'Job Class Permanently deleted');
        }
    }

    public function ajaxSearch(Request $request){
        $keyword = $request->get('q');
        $jobclass = \App\Models\JobClass::where("name", "LIKE", "%$keyword%")->get();

        return $jobclass;
    }

    public function published(Request $request)
    {
        $id_user = \Auth::user()->id;
        $jobclass = \App\Models\JobClass::with('user', 'user.skill')->paginate(4);
        $user =\App\Models\User::findOrFail($id_user);
        return view('backend.jobclass.published', compact('jobclass','user'));
    }

    public function lihatJobClass($slug)
    {
        $jobclass = \App\Models\JobClass::with('user', 'user.skill')->where('slug', $slug)->first();

        // dd($jobclass);
        return view('backend.jobclass.lihat-jobclass', ['jobclasses' => $jobclass]);
    }


}
