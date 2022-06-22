<?php

namespace App\Http\Controllers;

use App\Models\JobClass;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Auth;
use DataTables;


class UserController extends Controller
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
        //     if(Gate::allows('manage-users')) return $next($request);

        //     abort(403, 'Anda tidak memiliki cukup hak akses');
        // });
    }
    public function index(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            $users = \App\Models\User::orderBy('name', 'asc')->paginate(10);
            $optionFilter = $request->get('optionFilter');
            $filterKeyword = $request->get('keyword');
            // dd($filterKeyword);
            $status = $request->get('status');

            if ($filterKeyword) {
                if ($status && $optionFilter) {
                    $users = \App\Models\User::where("$optionFilter", 'LIKE', "%$filterKeyword%")
                        ->where('status', $status)
                        ->paginate(10);
                } else {
                    $users = \App\Models\User::where("$optionFilter", 'LIKE', "%$filterKeyword%")
                        ->paginate(10);
                }
            }

            return view('backend.users.index', ['users' => $users]);
        } else {
            return view('errors.403');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('isAdmin')) {
            return view("backend.users.create");
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
        //validator
        $validation = \Validator::make($request->all(), [
            "name" => "required|min:3|max:100",
            // "nomorInduk" => "required|digits_between:6,20",
            "phone" => "required|digits_between:6,20",
            "tempatLahir" => "required|min:3|max:100",
            "tanggalLahir" => "required",
            "email" => 'required|email|unique:users',
            "gender" => 'required',
            "username" => "required|min:3|max:20|unique:users",
            "password" => "required",
            "password_confirmation" => "required|same:password",
            "alamat" => "required|min:1|max:300",
            "roles" => "required",
            // "level" => "required|digits_between:0,999",
            // "skor" => "required",
            // "exp" => "required",
            // "avatar" => "required",
            // "background" => "required",
            // "jobclass" => "required"

        ])->validate();
        //Menangkap Inputan form Creat User
        $new_user = new \App\Models\User;
        $new_user->name = $request->get('name');
        //siswa = nisn, guru = nip
        $new_user->nomor_induk = $request->get('nomorInduk');
        $new_user->phone = $request->get('phone');
        $new_user->tempat_lahir = $request->get('tempatLahir');
        $new_user->tanggal_lahir = $request->get('tanggalLahir');
        $new_user->email = $request->get('email');
        $new_user->gender = $request->get('gender');
        $new_user->username = $request->get('username');
        $new_user->password  = \Hash::make($request->get('password'));
        $new_user->alamat = $request->get('alamat');
        $new_user->roles = json_encode($request->get('roles'));
        $new_user->level = $request->get('level');
        $new_user->skor = $request->get('skor');
        $new_user->exp = $request->get('exp');
        if ($request->file('avatar')) {
            $file = $request->file('avatar')->store('avatars', 'public');

            $new_user->avatar = $file;
        }
        if ($request->file('background')) {
            $file = $request->file('background')->store('backgrounds', 'public');

            $new_user->background = $file;
        }

        $new_user->save();

        $new_user->skill()->attach($request->get('skill'));
        $new_user->jobclass()->attach($request->get('jobclass'));
        return redirect()->route('users.index')->with('status', 'Berhasil Membuat User Baru.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('backend.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userDB = \App\Models\User::findOrFail($id);
        // $userPengajar = \App\Models\User::findOrFail($id);
        // $userSiswa = \App\Models\User::findOrFail($id);
        // otoritas admin

        $user = json_decode($userDB->roles);
        $userAuthRoles = json_decode(Auth::user()->roles);
        $adminKode = array_intersect(['0']);
        $PengajarKode = array_intersect(['1']);
        $SiswaKode = array_intersect(['2']);
        //jika data user id role = role kode
        if ($user == $adminKode) {
            Gate::allows('isAdmin');
            if ($userAuthRoles == $adminKode) {
                return view('backend.users.edit', ['user' => $userDB]);
            } else {
                return view('errors.403');
            }
            // otoritas pengajar
        } elseif ($user == $PengajarKode) {
            Gate::allows('isPengajar');
            if ($userAuthRoles == $PengajarKode && $userDB->id == Auth::user()->id) {
                return view('backend.users.edit', ['user' => $userDB]);
            } elseif ($userAuthRoles == $adminKode) {
                Gate::allows('isAdmin');
                return view('backend.users.edit', ['user' => $userDB]);
            } else {
                return view('errors.403');
            }
            // otoritas siswa
        } elseif ($user == $SiswaKode) {
            Gate::allows('isSiswa');
            if ($userAuthRoles == $SiswaKode && $userDB->id == Auth::user()->id) {
                return view('backend.users.edit', ['user' => $userDB]);
            } elseif ($userAuthRoles == $adminKode) {
                Gate::allows('isAdmin');
                return view('backend.users.edit', ['user' => $userDB]);
            } else {
                return view('errors.403');
            }
        }
        // if(Gate::forUser($user)->allows('update-user')){
        //     return view('backend.users.edit', ['user' => $user]);
        // } else{
        //     abort(403, 'Anda tidak memiliki cukup hak akses');
        // }
        // if ($user->isAdmin()) {
        //     Gate::allows('isAdmin');
        //     return view('backend.users.edit', ['user' => $user]);
        // } elseif (json_decode(Auth::user()->roles) == array_intersect(['1'])) {
        //     Gate::allows('isPengajar');
        //     return view('backend.users.edit', ['user' => $user]);
        // } elseif (json_decode(Auth::user()->roles) == array_intersect(['2'])) {
        //     Gate::allows('isSiswa');
        //     return view('backend.users.edit', ['user' => $user]);
        // } else {
        //     abort(403, 'Anda tidak memiliki cukup hak akses');
        // }
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
        $user = \App\Models\User::findOrFail($id);
        $user->name = $request->get('name');
        $user->nomor_induk = $request->get('nomorInduk');
        $user->phone = $request->get('phone');
        $user->tempat_lahir = $request->get('tempatLahir');
        $user->tanggal_lahir = $request->get('tanggalLahir');
        $user->alamat = $request->get('alamat');
        $user->gender = $request->get('gender');
        $userAuthRoles = json_decode(Auth::user()->roles);
        $adminKode = array_intersect(['0']);
        if ($userAuthRoles == $adminKode) {
            $user->roles = json_encode($request->get('roles'));
            // on = online, off = offline
            $user->status = $request->get('status');
            $user->level = $request->get('level');
            $user->skor = $request->get('skor');
            $user->exp = $request->get('exp');
        }
        if ($request->file('avatar')) {
            if ($user->avatar && file_exists(storage_path('app/public/' . $user->avatar))) {
                \Storage::delete('public/' . $user->avatar);
            }
            $file = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $file;
        }
        if ($request->file('background')) {
            if ($user->background && file_exists(storage_path('app/public/' . $user->background))) {
                \Storage::delete('public/' . $user->background);
            }
            $file = $request->file('background')->store('backgrounds', 'public');
            $user->background = $file;
        }

        $user->save();

        if ($userAuthRoles == $adminKode) {
            $user->skill()->sync($request->get('skill'));
            $user->jobclass()->sync($request->get('jobclass'));
        }
        $user->skill()->sync($request->get('skill'));
        $user->jobclass()->sync($request->get('jobclass'));
        return redirect()->route('users.show', [$id])->with('status', 'User succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('status', 'User successfully deleted');
    }

    // public function jumlahSkill(){
    //     $skillCount = \App\Models\User::count();
    //     return view('backend.jobclass.show', compact('skillCount'));
    // }

    // public function tambahSkill(Request $request){
    //     $new_skill = new \App\Models\User();
    //     $new_skill->skill()->attach($request->get('skill'));

    //     return redirect()->route('skill.index')->with('status', 'Skill successfully ditambahkan');
    // }

    public function tambahJobClass(Request $request, $id)
    {
        $auth_user = \Auth::user();
        $hasJobclass = $auth_user->jobclass()->where('job_class_id', $id)->exists();
        if ($hasJobclass) {
            return redirect()->route('jobclass.published')->with('info', 'Sudah ada di daftar Job Class');
        } else {
            $auth_user->jobclass()->attach($id);
            return redirect()->route('jobclass.published')->with('status', 'Berhasil mendaftarkan Job Class');
        }
    }
    public function tambahSkill(Request $request, $id)
    {
        $auth_user = \Auth::user();
        $hasSkill = $auth_user->skill()->where('skill_id', $id)->exists();
        if ($hasSkill) {
            return redirect()->route('skill.published')->with('info', 'Sudah ada di daftar Skill');
        } else {
            $auth_user->skill()->attach($id);
            return redirect()->route('skill.published')->with('status', 'Berhasil mendaftarkan Skill');
        }
    }

    public function hapusUserJobClass($id)
    {
        $auth_user = \Auth::user();
        // $hasJobClass = $auth_user->jobclass()->where('job_class_id', $id)->exists();
        $auth_user->jobclass()->detach($id);

        return redirect()->route('jobclass.published', \Auth::user()->id)->with('status', 'JobClass berhasil dibatalkan');
    }

    public function getLeaderboard(){
        $user_leaderboard = \App\Models\User::select('id', 'username', 'level', 'skor', 'roles')->where('roles', 'LIKE', json_encode(["2"]))->get();
        return DataTables::of($user_leaderboard)->make(true);
    }

    public function leaderboard(){

        return view('frontend.leaderboard');
    }
}
