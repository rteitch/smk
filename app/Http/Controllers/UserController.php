<?php

namespace App\Http\Controllers;

use App\Models\JobClass;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Auth;
use DataTables;
use Yajra\DataTables\Contracts\DataTable;

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
            "level" => "required|digits_between:0,100",
            // "skor" => "required",
            // "exp" => "required",
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

        //logika update level ketika exp bertambah level dalam ga web max adalah 99
        switch ($new_user->exp) {
            case $new_user->exp == 0:
                $new_user->level = 1;
                break;
            case ($new_user->exp - 0) <= 700:
                $new_user->level = 1;
                break;
            case ($new_user->exp - 2100) <= 2100:
                $new_user->level = 2;
                break;
            case ($new_user->exp - 3500) <= 3500:
                $new_user->level = 3;
                break;
            case ($new_user->exp - 4900) <= 4900:
                $new_user->level = 4;
                break;
            case ($new_user->exp - 6300) <= 6300:
                $new_user->level = 5;
                break;
            case ($new_user->exp - 7700) <= 7700:
                $new_user->level = 6;
                break;
            case ($new_user->exp - 9100) <= 9100:
                $new_user->level = 7;
                break;
            case ($new_user->exp - 10500) <= 10500:
                $new_user->level = 8;
                break;
            case ($new_user->exp - 11900) <= 11900:
                $new_user->level = 9;
                break;
            case ($new_user->exp - 13300) <= 13300:
                $new_user->level = 10;
                break;
            case ($new_user->exp - 14700) <= 14700:
                $new_user->level = 11;
                break;
            case ($new_user->exp - 16100) <= 16100:
                $new_user->level = 12;
                break;
            case ($new_user->exp - 17500) <= 17500:
                $new_user->level = 13;
                break;
            case ($new_user->exp - 18900) <= 18900:
                $new_user->level = 14;
                break;
            case ($new_user->exp - 20300) <= 20300:
                $new_user->level = 15;
                break;
            case ($new_user->exp - 21700) <= 21700:
                $new_user->level = 16;
                break;
            case ($new_user->exp - 23100) <= 23100:
                $new_user->level = 17;
                break;
            case ($new_user->exp - 24500) <= 24500:
                $new_user->level = 18;
                break;
            case ($new_user->exp - 25900) <= 25900:
                $new_user->level = 19;
                break;
            case ($new_user->exp - 27300) <= 27300:
                $new_user->level = 20;
                break;
            case ($new_user->exp - 28700) <= 28700:
                $new_user->level = 21;
                break;
            case ($new_user->exp - 30100) <= 30100:
                $new_user->level = 22;
                break;
            case ($new_user->exp - 31500) <= 31500:
                $new_user->level = 23;
                break;
            case ($new_user->exp - 32900) <= 32900:
                $new_user->level = 24;
                break;
            case ($new_user->exp - 34300) <= 34300:
                $new_user->level = 25;
                break;
            case ($new_user->exp - 35700) <= 35700:
                $new_user->level = 26;
                break;
            case ($new_user->exp - 37100) <= 37100:
                $new_user->level = 27;
                break;
            case ($new_user->exp - 38500) <= 38500:
                $new_user->level = 28;
                break;
            case ($new_user->exp - 39900) <= 39900:
                $new_user->level = 29;
                break;
            case ($new_user->exp - 41300) <= 41300:
                $new_user->level = 30;
                break;
            case ($new_user->exp - 42700) <= 42700:
                $new_user->level = 31;
                break;
            case ($new_user->exp - 44100) <= 44100:
                $new_user->level = 32;
                break;
            case ($new_user->exp - 45500) <= 45500:
                $new_user->level = 33;
                break;
            case ($new_user->exp - 46900) <= 46900:
                $new_user->level = 34;
                break;
            case ($new_user->exp - 48300) <= 48300:
                $new_user->level = 35;
                break;
            case ($new_user->exp - 49700) <= 49700:
                $new_user->level = 36;
                break;
            case ($new_user->exp - 51100) <= 51100:
                $new_user->level = 37;
                break;
            case ($new_user->exp - 52500) <= 52500:
                $new_user->level = 38;
                break;
            case ($new_user->exp - 53900) <= 53900:
                $new_user->level = 39;
                break;
            case ($new_user->exp - 55300) <= 55300:
                $new_user->level = 40;
                break;
            case ($new_user->exp - 56700) <= 56700:
                $new_user->level = 41;
                break;
            case ($new_user->exp - 58100) <= 58100:
                $new_user->level = 42;
                break;
            case ($new_user->exp - 59500) <= 59500:
                $new_user->level = 43;
                break;
            case ($new_user->exp - 60900) <= 60900:
                $new_user->level = 44;
                break;
            case ($new_user->exp - 62300) <= 62300:
                $new_user->level = 45;
                break;
            case ($new_user->exp - 63700) <= 63700:
                $new_user->level = 46;
                break;
            case ($new_user->exp - 65100) <= 65100:
                $new_user->level = 47;
                break;
            case ($new_user->exp - 66500) <= 66500:
                $new_user->level = 48;
                break;
            case ($new_user->exp - 67900) <= 67900:
                $new_user->level = 49;
                break;
            case ($new_user->exp - 69300) <= 69300:
                $new_user->level = 50;
                break;
            case ($new_user->exp - 70700) <= 70700:
                $new_user->level = 51;
                break;
            case ($new_user->exp - 72100) <= 72100:
                $new_user->level = 52;
                break;
            case ($new_user->exp - 73500) <= 73500:
                $new_user->level = 53;
                break;
            case ($new_user->exp - 74900) <= 74900:
                $new_user->level = 54;
                break;
            case ($new_user->exp - 76300) <= 76300:
                $new_user->level = 55;
                break;
            case ($new_user->exp - 77700) <= 77700:
                $new_user->level = 56;
                break;
            case ($new_user->exp - 79100) <= 79100:
                $new_user->level = 57;
                break;
            case ($new_user->exp - 80500) <= 80500:
                $new_user->level = 58;
                break;
            case ($new_user->exp - 81900) <= 81900:
                $new_user->level = 59;
                break;
            case ($new_user->exp - 83300) <= 83300:
                $new_user->level = 60;
                break;
            case ($new_user->exp - 84700) <= 84700:
                $new_user->level = 61;
                break;
            case ($new_user->exp - 86100) <= 86100:
                $new_user->level = 62;
                break;
            case ($new_user->exp - 87500) <= 87500:
                $new_user->level = 63;
                break;
            case ($new_user->exp - 88900) <= 88900:
                $new_user->level = 64;
                break;
            case ($new_user->exp - 90300) <= 90300:
                $new_user->level = 65;
                break;
            case ($new_user->exp - 91700) <= 91700:
                $new_user->level = 66;
                break;
            case ($new_user->exp - 93100) <= 93100:
                $new_user->level = 67;
                break;
            case ($new_user->exp - 94500) <= 94500:
                $new_user->level = 68;
                break;
            case ($new_user->exp - 95900) <= 95900:
                $new_user->level = 69;
                break;
            case ($new_user->exp - 97300) <= 97300:
                $new_user->level = 70;
                break;
            case ($new_user->exp - 98700) <= 98700:
                $new_user->level = 71;
                break;
            case ($new_user->exp - 100100) <= 100100:
                $new_user->level = 72;
                break;
            case ($new_user->exp - 101500) <= 101500:
                $new_user->level = 73;
                break;
            case ($new_user->exp - 102900) <= 102900:
                $new_user->level = 74;
                break;
            case ($new_user->exp - 104300) <= 104300:
                $new_user->level = 75;
                break;
            case ($new_user->exp - 105700) <= 105700:
                $new_user->level = 76;
                break;
            case ($new_user->exp - 107100) <= 107100:
                $new_user->level = 77;
                break;
            case ($new_user->exp - 108500) <= 108500:
                $new_user->level = 78;
                break;
            case ($new_user->exp - 109900) <= 109900:
                $new_user->level = 79;
                break;
            case ($new_user->exp - 111300) <= 111300:
                $new_user->level = 80;
                break;
            case ($new_user->exp - 112700) <= 112700:
                $new_user->level = 81;
                break;
            case ($new_user->exp - 114100) <= 114100:
                $new_user->level = 82;
                break;
            case ($new_user->exp - 115500) <= 115500:
                $new_user->level = 83;
                break;
            case ($new_user->exp - 116900) <= 116900:
                $new_user->level = 84;
                break;
            case ($new_user->exp - 118300) <= 118300:
                $new_user->level = 85;
                break;
            case ($new_user->exp - 119700) <= 119700:
                $new_user->level = 86;
                break;
            case ($new_user->exp - 121100) <= 121100:
                $new_user->level = 87;
                break;
            case ($new_user->exp - 122500) <= 122500:
                $new_user->level = 88;
                break;
            case ($new_user->exp - 123900) <= 123900:
                $new_user->level = 89;
                break;
            case ($new_user->exp - 125300) <= 125300:
                $new_user->level = 90;
                break;
            case ($new_user->exp - 126700) <= 126700:
                $new_user->level = 91;
                break;
            case ($new_user->exp - 128100) <= 128100:
                $new_user->level = 92;
                break;
            case ($new_user->exp - 129500) <= 129500:
                $new_user->level = 93;
                break;
            case ($new_user->exp - 130900) <= 130900:
                $new_user->level = 94;
                break;
            case ($new_user->exp - 132300) <= 132300:
                $new_user->level = 95;
                break;
            case ($new_user->exp - 133700) <= 133700:
                $new_user->level = 96;
                break;
            case ($new_user->exp - 135100) <= 135100:
                $new_user->level = 97;
                break;
            case ($new_user->exp - 136500) <= 136500:
                $new_user->level = 98;
                break;
            case ($new_user->exp - 137900) <= 137900:
                $new_user->level = 99;
                break;
            case ($new_user->exp - 139300) <= 139300:
                $new_user->level = 100;
                break;
            case ($new_user->exp - 139300) > 139300:
                $new_user->level = 100;
                break;
        }

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
            //logika update level ketika exp bertambah level dalam ga web max adalah 99
            switch ($exp_user) {
                case $exp_user == 0:
                    $user->level = 1;
                    break;
                case ($exp_user - 0) <= 700:
                    $user->level = 1;
                    break;
                case ($exp_user - 2100) <= 2100:
                    $user->level = 2;
                    break;
                case ($exp_user - 3500) <= 3500:
                    $user->level = 3;
                    break;
                case ($exp_user - 4900) <= 4900:
                    $user->level = 4;
                    break;
                case ($exp_user - 6300) <= 6300:
                    $user->level = 5;
                    break;
                case ($exp_user - 7700) <= 7700:
                    $user->level = 6;
                    break;
                case ($exp_user - 9100) <= 9100:
                    $user->level = 7;
                    break;
                case ($exp_user - 10500) <= 10500:
                    $user->level = 8;
                    break;
                case ($exp_user - 11900) <= 11900:
                    $user->level = 9;
                    break;
                case ($exp_user - 13300) <= 13300:
                    $user->level = 10;
                    break;
                case ($exp_user - 14700) <= 14700:
                    $user->level = 11;
                    break;
                case ($exp_user - 16100) <= 16100:
                    $user->level = 12;
                    break;
                case ($exp_user - 17500) <= 17500:
                    $user->level = 13;
                    break;
                case ($exp_user - 18900) <= 18900:
                    $user->level = 14;
                    break;
                case ($exp_user - 20300) <= 20300:
                    $user->level = 15;
                    break;
                case ($exp_user - 21700) <= 21700:
                    $user->level = 16;
                    break;
                case ($exp_user - 23100) <= 23100:
                    $user->level = 17;
                    break;
                case ($exp_user - 24500) <= 24500:
                    $user->level = 18;
                    break;
                case ($exp_user - 25900) <= 25900:
                    $user->level = 19;
                    break;
                case ($exp_user - 27300) <= 27300:
                    $user->level = 20;
                    break;
                case ($exp_user - 28700) <= 28700:
                    $user->level = 21;
                    break;
                case ($exp_user - 30100) <= 30100:
                    $user->level = 22;
                    break;
                case ($exp_user - 31500) <= 31500:
                    $user->level = 23;
                    break;
                case ($exp_user - 32900) <= 32900:
                    $user->level = 24;
                    break;
                case ($exp_user - 34300) <= 34300:
                    $user->level = 25;
                    break;
                case ($exp_user - 35700) <= 35700:
                    $user->level = 26;
                    break;
                case ($exp_user - 37100) <= 37100:
                    $user->level = 27;
                    break;
                case ($exp_user - 38500) <= 38500:
                    $user->level = 28;
                    break;
                case ($exp_user - 39900) <= 39900:
                    $user->level = 29;
                    break;
                case ($exp_user - 41300) <= 41300:
                    $user->level = 30;
                    break;
                case ($exp_user - 42700) <= 42700:
                    $user->level = 31;
                    break;
                case ($exp_user - 44100) <= 44100:
                    $user->level = 32;
                    break;
                case ($exp_user - 45500) <= 45500:
                    $user->level = 33;
                    break;
                case ($exp_user - 46900) <= 46900:
                    $user->level = 34;
                    break;
                case ($exp_user - 48300) <= 48300:
                    $user->level = 35;
                    break;
                case ($exp_user - 49700) <= 49700:
                    $user->level = 36;
                    break;
                case ($exp_user - 51100) <= 51100:
                    $user->level = 37;
                    break;
                case ($exp_user - 52500) <= 52500:
                    $user->level = 38;
                    break;
                case ($exp_user - 53900) <= 53900:
                    $user->level = 39;
                    break;
                case ($exp_user - 55300) <= 55300:
                    $user->level = 40;
                    break;
                case ($exp_user - 56700) <= 56700:
                    $user->level = 41;
                    break;
                case ($exp_user - 58100) <= 58100:
                    $user->level = 42;
                    break;
                case ($exp_user - 59500) <= 59500:
                    $user->level = 43;
                    break;
                case ($exp_user - 60900) <= 60900:
                    $user->level = 44;
                    break;
                case ($exp_user - 62300) <= 62300:
                    $user->level = 45;
                    break;
                case ($exp_user - 63700) <= 63700:
                    $user->level = 46;
                    break;
                case ($exp_user - 65100) <= 65100:
                    $user->level = 47;
                    break;
                case ($exp_user - 66500) <= 66500:
                    $user->level = 48;
                    break;
                case ($exp_user - 67900) <= 67900:
                    $user->level = 49;
                    break;
                case ($exp_user - 69300) <= 69300:
                    $user->level = 50;
                    break;
                case ($exp_user - 70700) <= 70700:
                    $user->level = 51;
                    break;
                case ($exp_user - 72100) <= 72100:
                    $user->level = 52;
                    break;
                case ($exp_user - 73500) <= 73500:
                    $user->level = 53;
                    break;
                case ($exp_user - 74900) <= 74900:
                    $user->level = 54;
                    break;
                case ($exp_user - 76300) <= 76300:
                    $user->level = 55;
                    break;
                case ($exp_user - 77700) <= 77700:
                    $user->level = 56;
                    break;
                case ($exp_user - 79100) <= 79100:
                    $user->level = 57;
                    break;
                case ($exp_user - 80500) <= 80500:
                    $user->level = 58;
                    break;
                case ($exp_user - 81900) <= 81900:
                    $user->level = 59;
                    break;
                case ($exp_user - 83300) <= 83300:
                    $user->level = 60;
                    break;
                case ($exp_user - 84700) <= 84700:
                    $user->level = 61;
                    break;
                case ($exp_user - 86100) <= 86100:
                    $user->level = 62;
                    break;
                case ($exp_user - 87500) <= 87500:
                    $user->level = 63;
                    break;
                case ($exp_user - 88900) <= 88900:
                    $user->level = 64;
                    break;
                case ($exp_user - 90300) <= 90300:
                    $user->level = 65;
                    break;
                case ($exp_user - 91700) <= 91700:
                    $user->level = 66;
                    break;
                case ($exp_user - 93100) <= 93100:
                    $user->level = 67;
                    break;
                case ($exp_user - 94500) <= 94500:
                    $user->level = 68;
                    break;
                case ($exp_user - 95900) <= 95900:
                    $user->level = 69;
                    break;
                case ($exp_user - 97300) <= 97300:
                    $user->level = 70;
                    break;
                case ($exp_user - 98700) <= 98700:
                    $user->level = 71;
                    break;
                case ($exp_user - 100100) <= 100100:
                    $user->level = 72;
                    break;
                case ($exp_user - 101500) <= 101500:
                    $user->level = 73;
                    break;
                case ($exp_user - 102900) <= 102900:
                    $user->level = 74;
                    break;
                case ($exp_user - 104300) <= 104300:
                    $user->level = 75;
                    break;
                case ($exp_user - 105700) <= 105700:
                    $user->level = 76;
                    break;
                case ($exp_user - 107100) <= 107100:
                    $user->level = 77;
                    break;
                case ($exp_user - 108500) <= 108500:
                    $user->level = 78;
                    break;
                case ($exp_user - 109900) <= 109900:
                    $user->level = 79;
                    break;
                case ($exp_user - 111300) <= 111300:
                    $user->level = 80;
                    break;
                case ($exp_user - 112700) <= 112700:
                    $user->level = 81;
                    break;
                case ($exp_user - 114100) <= 114100:
                    $user->level = 82;
                    break;
                case ($exp_user - 115500) <= 115500:
                    $user->level = 83;
                    break;
                case ($exp_user - 116900) <= 116900:
                    $user->level = 84;
                    break;
                case ($exp_user - 118300) <= 118300:
                    $user->level = 85;
                    break;
                case ($exp_user - 119700) <= 119700:
                    $user->level = 86;
                    break;
                case ($exp_user - 121100) <= 121100:
                    $user->level = 87;
                    break;
                case ($exp_user - 122500) <= 122500:
                    $user->level = 88;
                    break;
                case ($exp_user - 123900) <= 123900:
                    $user->level = 89;
                    break;
                case ($exp_user - 125300) <= 125300:
                    $user->level = 90;
                    break;
                case ($exp_user - 126700) <= 126700:
                    $user->level = 91;
                    break;
                case ($exp_user - 128100) <= 128100:
                    $user->level = 92;
                    break;
                case ($exp_user - 129500) <= 129500:
                    $user->level = 93;
                    break;
                case ($exp_user - 130900) <= 130900:
                    $user->level = 94;
                    break;
                case ($exp_user - 132300) <= 132300:
                    $user->level = 95;
                    break;
                case ($exp_user - 133700) <= 133700:
                    $user->level = 96;
                    break;
                case ($exp_user - 135100) <= 135100:
                    $user->level = 97;
                    break;
                case ($exp_user - 136500) <= 136500:
                    $user->level = 98;
                    break;
                case ($exp_user - 137900) <= 137900:
                    $user->level = 99;
                    break;
                case ($exp_user - 139300) <= 139300:
                    $user->level = 100;
                    break;
                case ($exp_user - 139300) > 139300:
                    $user->level = 100;
                    break;
            }
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

    public function getLeaderboard()
    {
        $status_db = json_encode(['2']);
        $user_leaderboard = \App\Models\User::select('id', 'name', 'avatar', 'level', 'status', 'skor')->where('roles', "LIKE", "%$status_db%")->orderBy('skor', 'desc')->get();
        return DataTables::of($user_leaderboard)->addColumn('avatar_url', function ($data) {
            return '<img src="storage/' . $data->avatar . '" width="40px" height="40px" class="rounded-circle"/>';
        })->addIndexColumn()->rawColumns(['avatar_url'])->toJson();
    }

    public function leaderboard()
    {
        return view('frontend.leaderboard');
    }

    public function anggota(Request $request)
    {

        // $user = \Auth::user()->roles;
        // dd($user == json_encode(['0']));
        // $adminKode = array_intersect(['0']);
        // $PengajarKode = array_intersect(['1']);
        // $SiswaKode = array_intersect(['2']);

        return view('frontend.anggota');
    }

    public function getAnggota(Request $request)
    {

        $status = $request->get('status');
        if ($status == "PENGAJAR") {
            $status_db = json_encode(['1']);
            $user = \App\Models\User::select('id', 'name', 'avatar', 'level', 'status')->where('roles', "LIKE", "%$status_db%")->get();
        } elseif ($status == "SISWA") {
            $status_db = json_encode(['2']);
            $user = \App\Models\User::select('id', 'name', 'avatar', 'level', 'status')->where('roles', "LIKE", "%$status_db%")->get();
        } else {
            $status_db1 = json_encode(['1']);
            $status_db2 = json_encode(['2']);
            $user = \App\Models\User::select('id', 'name', 'avatar', 'level', 'status')->where('roles', "LIKE", "%$status_db1%")->orWhere('roles', "LIKE", "%$status_db2%")->get();
        }

        return DataTables::of($user)->addColumn('avatar_url', function ($data) {
            return '<img src="storage/' . $data->avatar . '" width="40px" height="40px" class="rounded-circle"/>';
        })->addIndexColumn()->rawColumns(['avatar_url'])->toJson();
    }

    // public function tampilanDummy(){
    //     return view('dumy');
    // }

}
