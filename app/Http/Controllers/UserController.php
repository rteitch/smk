<?php

namespace App\Http\Controllers;

use App\Models\JobClass;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Auth;
use Session;
use App\Models\User;
use View;
use App\Exports\ExportUsers;
use App\Imports\ImportUsers;
use Maatwebsite\Excel\Facades\Excel;

use Facade\FlareClient\Http\Response;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
// use DataTables;
use Yajra\DataTables\DataTables;

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
            $users = \App\Models\User::query();
            // $optionFilter = $request->get('optionFilter');
            // $filterKeyword = $request->get('keyword');
            // dd($filterKeyword);
            // $status = $request->get('status');

            // if ($filterKeyword) {
            //     if ($status && $optionFilter) {
            //         $users->where("$optionFilter", 'LIKE', "%$filterKeyword%")
            //             ->where('status', $status);
            //     } else {
            //         $users->where("$optionFilter", 'LIKE', "%$filterKeyword%");
            //     }
            // }

            $users = $users->with('jobclass')->orderBy('name', 'asc')->select(
                'id',
                'name',
                'email',
                'username',
                'roles',
                'alamat',
                'nomor_induk',
                'phone',
                'tempat_lahir',
                'tanggal_lahir',
                'level',
                'skor',
                'exp',
                'gender',
                'avatar',
                'background',
                'status',
            )->get();

            return View::make('backend.users.index', compact('users'));
            // return view('backend.users.index', ['users' => $users]);
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
            "level" => "required|digits_between:0,100",
            "skor" => "required",
            "exp" => "required",
            "avatar" => "mimes:jpeg,jpg,png",
            "background" => "mimes:jpeg,jpg,png",
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

        if (Gate::allows('isAdmin')) {
            $new_user->save();

            $new_user->skill()->attach($request->get('skill'));
            $new_user->jobclass()->attach($request->get('jobclass'));
            return redirect()->route('users.index')->with('status', 'Berhasil Membuat User Baru.');
        } else {
            return view("errors.403");
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
        $adminPengajarKode = array_intersect(['0', '1']);
        //jika data user id role = role kode
        if ($user == $adminKode) {
            Gate::allows('isAdmin');
            if ($userAuthRoles == $adminKode) {
                return view('backend.users.edit', ['user' => $userDB]);
            } else {
                return view('errors.403');
            }
            // otoritas admin & pengajar
        } elseif ($user == $adminPengajarKode) {
            Gate::allows('isPengajardanAdmin');
            if ($userAuthRoles == $adminPengajarKode or $userAuthRoles == $adminKode) {
                return view('backend.users.edit', ['user' => $userDB]);
            } else {
                return view('errors.403');
            }
        }
        // otoritas pengajar
        elseif ($user == $PengajarKode) {
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

        \Validator::make($request->all(), [
            "name" => "required|min:3|max:100",
            "nomorInduk" => "required",
            "phone" => "required|digits_between:3,20",
            // "tempatLahir" => "required|min:3|max:100",
            // "tanggalLahir" => "required",
            // "email" => 'required|email|unique:users',
            // "gender" => 'required',
            // "username" => "required|min:3|max:20|unique:users",
            // "password" => "required",
            // "password_confirmation" => "required|same:password",
            // "alamat" => "required|min:1|max:300",
            // "roles" => "required",
            // "level" => "required|digits_between:0,100",
            // "skor" => "required",
            // "exp" => "required",
            "avatar" => "mimes:jpeg,jpg,png",
            "background" => "mimes:jpeg,jpg,png",
            // "jobclass" => "required"
        ])->validate();

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
            $exp_user = $request->get('exp');
            $user->exp = $exp_user;
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
            return redirect()->route('users.index', [$id])->with('status', 'User succesfully updated');
        } else {
            $user->skill()->sync($request->get('skill'));
            $user->jobclass()->sync($request->get('jobclass'));
            return redirect()->route('users.edit', [$id])->with('status', 'User succesfully updated');
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
        $user = \App\Models\User::findOrFail($id);

        Gate::allows('isAdmin');

        $userAuthRoles = json_decode(Auth::user()->roles);
        $adminKode = array_intersect(['0']);
        if ($userAuthRoles == $adminKode) {

            // $user->orderq()->delete();
            // $user->skill()->detach();
            // $user->orderr()->delete();
            // $user->notifikasi()->delete();
            // $user->jobclass()->delete();
            $user->jobclass()->detach();
            $user->skill()->detach();
            $user->orderq()->delete();
            $user->orderr()->delete();
            $user->artikel()->delete();
            $user->notifikasi()->delete();
            $user->delete();
            return redirect()->route('users.index')->with('status', 'User successfully deleted');
        } else {
            return view('errors.403');
        }
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
            //syarat jobclass ke-1
            if (!$hasJobclass && $auth_user->jobclass->count() == 0) {
                $auth_user->jobclass()->attach($id);
                return redirect()->route('jobclass.published')->with('status', 'Berhasil mendaftarkan Job Class ke-1');
            }

            //syarat jobclass ke-2
            if ($auth_user->level < 30 && $auth_user->jobclass->count() == 1) {
                return redirect()->route('jobclass.published')->with('info', 'Syarat untuk menambah jobclass ke-2 adalah memiliki level 30');
            } elseif ($auth_user->level >= 30 && $auth_user->jobclass->count() == 1) {
                $auth_user->jobclass()->attach($id);
                return redirect()->route('jobclass.published')->with('status', 'Berhasil mendaftarkan Job Class ke-2');
            }

            //syarat jobclass ke-3
            if ($auth_user->level < 50 && $auth_user->jobclass->count() == 2) {
                return redirect()->route('jobclass.published')->with('info', 'Syarat untuk menambah jobclass ke-3 adalah memiliki level 50');
            } elseif ($auth_user->level >= 50 && $auth_user->jobclass->count() == 2) {
                $auth_user->jobclass()->attach($id);
                return redirect()->route('jobclass.published')->with('status', 'Berhasil mendaftarkan Job Class ke-3');
            }
            //max jobclass adalah 3
            if ($auth_user->jobclass->count() == 3) {
                return redirect()->route('jobclass.published')->with('info', 'Anda sudah memiliki 3 jobclass, tidak bisa menambah lagi');
            }
        }
    }
    public function tambahSkill(Request $request, $id)
    {
        $auth_user = \Auth::user();
        $hasSkill = $auth_user->skill()->where('skill_id', $id)->exists();
        $skill = \App\Models\Skill::findOrFail($id);
        if ($hasSkill) {
            return redirect()->route('skill.published')->with('info', 'Sudah ada di daftar Skill');
        } else {
            if ($auth_user->level <= $skill->syarat_lv) {
                return redirect()->route('skill.published')->with('info', 'Level tidak mencukupi untuk mengambil skill');
            } else {
                $auth_user->skill()->attach($id);
                return redirect()->route('skill.published')->with('status', 'Berhasil mendaftarkan Skill');
            }
        }
    }

    public function hapusUserJobClass($id)
    {
        $auth_user = \Auth::user();
        // $hasJobClass = $auth_user->jobclass()->where('job_class_id', $id)->exists();
        $auth_user->jobclass()->detach($id);

        return redirect()->route('jobclass.published', \Auth::user()->id)->with('status', 'JobClass berhasil dibatalkan');
    }

    // public function getUserJson()
    // {
    //     $users = \App\Models\User::query();
    //     $users = $users->with('jobclass')->orderBy('name', 'asc')->select(
    //         'id',
    //         'name',
    //         'email',
    //         'username',
    //         'roles',
    //         'alamat',
    //         'nomor_induk',
    //         'phone',
    //         'tempat_lahir',
    //         'tanggal_lahir',
    //         'level',
    //         'skor',
    //         'exp',
    //         'gender',
    //         'avatar',
    //         'background',
    //         'status',
    //     )->get();
    //     return response()->json($users, HttpFoundationResponse::HTTP_CREATED);
    // }

    // public function getLeaderboard()
    // {
    //     $status_db = json_encode(['2']);
    //     $user_leaderboard = \App\Models\User::select('name', 'avatar', 'level', 'status', 'skor')->where('roles', "LIKE", "%$status_db%")->orderBy('skor', 'desc')->get();
    //     return DataTables::of($user_leaderboard)->addColumn('avatar_url', function ($data) {
    //         return '<img src="storage/' . $data->avatar . '" width="40px" height="40px" class="rounded-circle"/>';
    //     })->addIndexColumn()->rawColumns(['avatar_url'])->filter(function ($query) {
    //         if (request()->has('name')) {
    //             $query->where('name', 'like', "%" . request('name') . "%");
    //         }

    //         if (request()->has('level')) {
    //             $query->where('level', 'like', "%" . request('level') . "%");
    //         }

    //         if (request()->has('skor')) {
    //             $query->where('skor', 'like', "%" . request('skor') . "%");
    //         }
    //     }, true)->toJson();
    // }

    // public function getUser(){

    // }

    public function leaderboard()
    {
        $users = \App\Models\User::query();
        $users = $users->orderBy('skor', 'desc')->select(
            'name',
            'avatar',
            'level',
            'skor',
            'status',
            'roles',
        )->where('roles', json_encode(["2"]))->get();

        return View::make('frontend.leaderboard', compact('users'));
    }

    public function statistik()
    {
        return view('frontend.statistik.index');
    }

    public function anggota(Request $request)
    {

        // $user = \Auth::user()->roles;
        // dd($user == json_encode(['0']));
        // $adminKode = array_intersect(['0']);
        // $PengajarKode = array_intersect(['1']);
        // $SiswaKode = array_intersect(['2']);

        $users = \App\Models\User::query();
        $status = $request->get('status');
        if ($status == "PENGAJAR") {
            $status_db = json_encode(['1']);
            $users = \App\Models\User::select('id', 'name', 'avatar', 'level', 'status', 'roles')->where('roles', "LIKE", "%$status_db%");
        } elseif ($status == "SISWA") {
            $status_db = json_encode(['2']);
            $users = \App\Models\User::select('id', 'name', 'avatar', 'level', 'status', 'roles')->where('roles', "LIKE", "%$status_db%");
        } else {
            // $status_db1 = json_encode(['1']);
            // $status_db2 = json_encode(['2']);
            $users = \App\Models\User::select('id', 'name', 'avatar', 'level', 'status', 'roles')->where('roles', json_encode(["1"]))->orWhere('roles', json_encode(["2"]));
        }
        $users = $users->orderBy('name', 'asc')->get();

        return View::make('frontend.anggota', compact('users'));


        // return view('frontend.anggota');
    }

    // public function getAnggota(Request $request)
    // {

    //     $users = \App\Models\User::query();
    //     $status = $request->get('status');
    //     if ($status == "PENGAJAR") {
    //         $status_db = json_encode(['1']);
    //         $users = \App\Models\User::select('id', 'name', 'avatar', 'level', 'status')->where('roles', "LIKE", "%$status_db%");
    //     } elseif ($status == "SISWA") {
    //         $status_db = json_encode(['2']);
    //         $users = \App\Models\User::select('id', 'name', 'avatar', 'level', 'status')->where('roles', "LIKE", "%$status_db%");
    //     } else {
    //         $status_db1 = json_encode(['1']);
    //         $status_db2 = json_encode(['2']);
    //         $users = \App\Models\User::select('id', 'name', 'avatar', 'level', 'status')->where('roles', "LIKE", "%$status_db1%")->orWhere('roles', "LIKE", "%$status_db2%");
    //     }
    //     $user = $users->orderBy('name', 'asc')->get();

    //     return View::make('frontend.anggota', compact('user'));
    //     return DataTables::of($user)->addColumn('avatar_url', function ($data) {
    //         return '<img src="storage/' . $data->avatar . '" width="40px" height="40px" class="rounded-circle"/>';
    //     })->addIndexColumn()->rawColumns(['avatar_url'])->toJson();
    // }

    // public function tampilanDummy(){
    //     return view('dumy');
    // }

    public function export_excel()
    {
        return Excel::download(new ExportUsers, 'user.xlsx');
    }

    public function import_excel(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_user di dalam folder public
        $file->move('file_user', $nama_file);

        // import data
        Excel::import(new ImportUsers, public_path('/file_user/' . $nama_file));

        // notifikasi dengan session
        Session::flash('sukses', 'Data User Berhasil Diimport!');

        // alihkan halaman kembali
        return redirect('/users');
    }
}
