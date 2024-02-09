<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokProjek extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kelas(){
      return $this->belongsTo(Kelas::class);
    }

    public function guru(){ // Koordinator
      return $this->belongsTo(Guru::class);
    }

    public function anggotaKelompok(){
      return $this->hasMany(AnggotaKelompok::class);
    }

    public function projekPilihanKelompok(){
      return $this->hasMany(ProjekPilihanKelompok::class);
    }
}
