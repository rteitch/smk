<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Response;

class NotifikasiController extends Controller
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

        if ($status) {
            $notifikasi = \App\Models\Notifikasi::where('title', "LIKE", "%$keyword%")->where('status', strtoupper($status))->paginate(10);
        } else {
            $notifikasi = \App\Models\Notifikasi::where("title", "LIKE", "%$keyword%")->paginate(10);
        }
        return view('backend.notifikasi.index', ['notifikasi' => $notifikasi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.notifikasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_notif = new \App\Models\Notifikasi();
        $new_notif->title = $request->get('title');
        $new_notif->pesan = $request->get('pesan');
        $new_notif->jenis_roles = $request->get('jenis_roles');
        $new_notif->user_id = \Auth::user()->id;
        $new_notif->created_by = \Auth::user()->id;
        $new_notif->status = $request->get('save_action');
        $new_notif->slug = \Str::slug($request->get('title'));

        //cover / image
        $image = $request->file('image');

        if ($image) {
            $image_path = $image->store('notifikasi-image', 'public');

            $new_notif->image = $image_path;
        }

        $new_notif->save();

        if ($request->get('save_action') == 'PUBLISH') {
            return redirect()->route('notifikasi.index')->with('status', 'Notifikasi successfully saved and published');
        } else {
            return redirect()->route('notifikasi.create')->with('status', 'Notifikasi saved as draft');
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
        $notifikasi = \App\Models\Notifikasi::findOrFail($id);

        return view('backend.notifikasi.show', ['notifikasi' => $notifikasi]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notifikasi_to_edit = \App\Models\Notifikasi::findOrFail($id);
        return view('backend.notifikasi.edit', ['notifikasi_to_edit' => $notifikasi_to_edit]);
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
        $notifikasi = \App\Models\Notifikasi::findOrFail($id);
        $getJudul = $request->get('title');
        $notifikasi->title = $getJudul;
        $slug = Str::slug($getJudul, '-');
        $notifikasi->slug = $slug;
        $notifikasi->pesan = $request->get('pesan');
        $notifikasi->jenis_roles = $request->get('jenis_roles');
        $notifikasi->user_id = \Auth::user()->id;
        $notifikasi->created_by = \Auth::user()->id;

        // file image
        $new_image = $request->file('image');

        if ($new_image) {
            if ($notifikasi->image && file_exists(storage_path('app/public/' . $notifikasi->image))) {
                \Storage::delete('public/' . $notifikasi->image);
            }

            $new_image_path = $new_image->store('notifikasi-image', 'public');

            $notifikasi->image = $new_image_path;
        }

        $notifikasi->updated_by = \Auth::user()->id;

        $notifikasi->status = $request->get('status');

        $notifikasi->save();

        return redirect()->route('notifikasi.edit', [$notifikasi->id])->with('status', 'Notifikasi successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notifikasi = \App\Models\Notifikasi::findOrFail($id);
        $notifikasi->delete();

        return redirect()->route('notifikasi.index')->with('status', 'Notifikasi moved to trash');
    }

    public function trash()
    {
        $notifikasi = \App\Models\Notifikasi::onlyTrashed()->paginate(10);
        return view('backend.notifikasi.trash', ['notifikasi' => $notifikasi]);
    }

    public function deletePermanent($id)
    {
        $notifikasi = \App\Models\Notifikasi::withTrashed()->findOrFail($id);

        if (!$notifikasi->trashed()) {
            return redirect()->route('notifikasi.trash')->with('status', 'Notifikasi is not in trash!')->with('status_type', 'alert');
        } else {
            $notifikasi->forceDelete();

            return redirect()->route('notifikasi.trash')->with('status', 'Notifikasi permanently deleted!');
        }
    }

    public function restore($id)
    {
        $notifikasi = \App\Models\Notifikasi::withTrashed()->findOrFail($id);
        if ($notifikasi->trashed()) {
            $notifikasi->restore();
            return redirect()->route('notifikasi.trash')->with('status', 'Notifikasi successfully restored');
        } else {
            return redirect()->route('notifikasi.trash')->with('status', 'Notifikasi is not in trash');
        }
    }

    public function showUserPesan()
    {

        return view('backend.notifikasi.show');
    }

    public function showNotifikasiUser()
    {

        $user_login = \Auth::user();
        $user_roles = json_decode($user_login->roles);
        $adminKode = array_intersect(['0']);
        $PengajarKode = array_intersect(['1']);
        $SiswaKode = array_intersect(['2']);
        $user = \App\Models\User::select('id', 'name')->get();
        if ($user_roles == $PengajarKode) {
            $user_roles_verif = 'PENGAJAR';
            $notifikasi = \App\Models\Notifikasi::where('jenis_roles', $user_roles_verif)->paginate(4);
            return view('backend.notifikasi.user', compact('notifikasi', 'user'));
        } elseif ($user_roles == $SiswaKode) {
            $user_roles_verif = 'SISWA';
            $notifikasi = \App\Models\Notifikasi::where('jenis_roles', $user_roles_verif)->paginate(4);
            return view('backend.notifikasi.user', compact('notifikasi', 'user'));
        } else {
            $notifikasi = \App\Models\Notifikasi::get();
            return view('backend.notifikasi.user', compact('notifikasi', 'user'));
        }
    }

    public function getNotifikasi()
    {
        $user_login = \Auth::user();
        $user_roles = json_decode($user_login->roles);
        $adminKode = array_intersect(['0']);
        $PengajarKode = array_intersect(['1']);
        $SiswaKode = array_intersect(['2']);
        $user = \App\Models\User::select('id', 'name');
        if ($user_roles == $PengajarKode) {
            $user_roles_verif = 'PENGAJAR';
            $notifikasi = \App\Models\Notifikasi::where('jenis_roles', $user_roles_verif)->orderBy('created_at', 'DESC')->limit(4)->get();
            return Response::json($notifikasi);
        } elseif ($user_roles == $SiswaKode) {
            $user_roles_verif = 'SISWA';
            $notifikasi = \App\Models\Notifikasi::where('jenis_roles', $user_roles_verif)->orderBy('created_at', 'DESC')->limit(4)->get();
            return Response::json($notifikasi);
        } else {
            $notifikasi = \App\Models\Notifikasi::orderBy('created_at', 'DESC')->limit(4)->get();
            return Response::json($notifikasi);
        }
    }
}
