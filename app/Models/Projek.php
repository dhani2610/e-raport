<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projek extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function fase(){
      return $this->belongsTo(Fase::class);
    }

    public function capaianProjek(){
      return $this->hasMany(CapaianProjek::class);
    }

    public function projekPilihanKelompok(){
      return $this->hasMany(ProjekPilihanKelompok::class);
    }

    public function catatanProjek(){
      return $this->hasMany(CatatanProjek::class);
    }
}
