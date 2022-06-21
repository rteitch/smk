<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Auth;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //bootstrap pagination
        Paginator::useBootstrap();

        //set default time to indonesia
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $userAuthRoles = json_decode(Auth::user()->roles);
                // $role_user = "";
                if ($userAuthRoles == array_intersect(['1'])) {
                    $role_user = "PENGAJAR";
                    $notifikasi = \App\Models\Notifikasi::where("jenis_roles", "LIKE", "%$role_user%")->paginate(4);
                } elseif ($userAuthRoles == array_intersect(['2'])) {
                    $role_user = "SISWA";
                    $notifikasi = \App\Models\Notifikasi::where("jenis_roles", "LIKE", "%$role_user%")->paginate(4);
                } elseif ($userAuthRoles == array_intersect(['0'])) {
                    $notifikasi = \App\Models\Notifikasi::paginate(4);
                }


                View::share('notifikasi', $notifikasi);
            } else {
            }
        });
    }
}
