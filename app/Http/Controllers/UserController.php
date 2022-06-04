<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Menangkap Inputan form Creat User
        $new_user = new \App\Models\User;
        $new_user->name = $request->get('name');
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
        $user = \App\Models\User::findOrFail($id);

        return view('backend.users.edit', ['user' => $user]);
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
        $user->roles = json_encode($request->get('roles'));
        // on = online, off = offline
        $user->status = $request->get('status');
        $user->level = $request->get('level');
        $user->skor = $request->get('skor');
        $user->exp = $request->get('exp');
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
}
