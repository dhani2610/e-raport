<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
      Gate::define('admin', function(User $user){
        return $user->isAdmin();
       });

      Gate::define('guru', function(User $user){
        return $user->isGuru();
       });

      Gate::define('siswa', function(User $user){
        return $user->isSiswa();
       });

      Gate::define('gurumapel', function(User $user){
        return $user->isGuru() && $user->guru->isGuruMapel();
       });

      Gate::define('pembinaekskul', function(User $user){
        return $user->isGuru() && $user->guru->isPembinaEkskul();
       });

      Gate::define('walikelas', function(User $user){
        return $user->isGuru() && $user->guru->isWaliKelas();
       });

      Gate::define('koordinatorp5', function(User $user){
        return $user->isGuru() && $user->guru->isKoordinatorP5();
       });
    }
}
