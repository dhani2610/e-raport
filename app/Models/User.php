<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password){
        $this->attributes['password'] = bcrypt($password);
    }

    public function guru(){
      return $this->hasOne(Guru::class);
    }

    public function admin(){
      return $this->hasOne(Admin::class);
    }

    public function siswa(){
      return $this->hasOne(Siswa::class);
    }

    public function isAdmin()
    {
      return $this->role == 'admin';
    }

    public function isGuru()
    {
      return $this->role == 'guru';
    }

    public function isSiswa()
    {
      return $this->role == 'siswa';
    }

    public function isGuruMapel(){
      return $this->isGuru() && $this->guru->isGuruMapel();
    }

    public function isPembinaEkskul(){
      return $this->isGuru() && $this->guru->isPembinaEkskul();
    }

    public function isWaliKelas(){
      return $this->isGuru() && $this->guru->isWaliKelas();
    }

    public function isKoordinatorP5(){
      return $this->isGuru() && $this->guru->isKoordinatorP5();
    }
}
