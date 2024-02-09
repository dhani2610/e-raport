<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjekPilihanKelompok extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kelompokProjek(){
      return $this->belongsTo(KelompokProjek::class);
    }

    public function projek(){
      return $this->belongsTo(Projek::class);
    }
}
