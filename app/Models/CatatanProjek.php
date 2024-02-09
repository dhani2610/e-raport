<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanProjek extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function siswa(){
      return $this->belongsTo(Siswa::class);
    }

    public function projek(){
      return $this->belongsTo(Projek::class);
    }
}
