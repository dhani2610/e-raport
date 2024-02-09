<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianAkhir extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function capaianProjek(){
      return $this->hasMany(CapaianProjek::class);
    }

    public function subElemen(){
      return $this->belongsTo(SubElemen::class);
    }

    public function fase(){
      return $this->belongsTo(Fase::class);
    }
}
