<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PDO;

class GlobalController extends Controller
{
    public function index(){
        $user_login = \Auth::user()->roles;
        $jenis_role = json_decode($user_login);
        if($jenis_role == array_intersect(["1"])){
            $role_user = "PENGAJAR";
        } elseif($jenis_role == array_intersect(["2"])){
            $role_user = "SISWA";
        }

        $notifikasi = \App\Models\Notifikasi::where("jenis_roles", "LIKE", "%$role_user%")->paginate(4);;
        return view("layouts.global", ['notifikasi' => $notifikasi]);
    }
}
