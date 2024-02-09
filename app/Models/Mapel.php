<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kelompokMapel(){
      return $this->belongsTo(KelompokMapel::class);
    }

    public function pembelajaran(){
      return $this->hasMany(Pembelajaran::class);
    }
}
