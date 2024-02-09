<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function tingkat(){
      return $this->hasMany(Tingkat::class);
    }

    public function projek(){
      return $this->hasMany(Projek::class);
    }

    public function capaianAkhir(){
      return $this->hasMany(CapaianAkhir::class);
    }
}
