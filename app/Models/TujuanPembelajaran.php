<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TujuanPembelajaran extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pembelajaran(){
      return $this->belongsTo(Pembelajaran::class);
    }

    public function PencapaianTp(){
      return $this->hasMany(PencapaianTp::class);
    }
}
