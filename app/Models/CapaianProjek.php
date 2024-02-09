<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianProjek extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function projek(){
      return $this->belongsTo(Projek::class);
    }

    public function capaianAkhir(){
      return $this->belongsTo(CapaianAkhir::class);
    }

    public function nilaiProjek(){
      return $this->hasMany(NilaiProjek::class);
    }
}
