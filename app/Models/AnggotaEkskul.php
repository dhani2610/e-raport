<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaEkskul extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function ekskul(){
      return $this->belongsTo(Ekskul::class);
    }

    public function siswa(){
      return $this->belongsTo(Siswa::class);
    }
}
