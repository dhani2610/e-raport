<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubElemen extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function elemen(){
      return $this->belongsTo(Elemen::class);
    }

    public function capaianAkhir(){
      return $this->hasMany(CapaianAkhir::class);
    }
}
