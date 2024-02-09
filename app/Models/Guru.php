<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function kelas(){ // Wali Kelas
      return $this->hasOne(Kelas::class);
    }

    public function ekskul(){ // Pembina Ekskul
      return $this->hasMany(Ekskul::class);
    }

    public function pembelajaran(){
      return $this->hasMany(Pembelajaran::class);
    }

    public function kelompokProjek(){ // Koordinator
      return $this->hasMany(KelompokProjek::class);
    }

    // Auth
    public function isPembinaEkskul(){
      return $this->ekskul->count() > 0;
    }

    public function isWaliKelas(){
      return $this->kelas;
    }

    public function isGuruMapel(){
      return $this->pembelajaran->count() > 0;
    }

    public function isKoordinatorP5(){
      return $this->kelompokProjek->count() > 0;
    }

}
