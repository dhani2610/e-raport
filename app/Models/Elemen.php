<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elemen extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function dimensi(){
      return $this->belongsTo(Dimensi::class);
    }

    public function subElemen(){
      return $this->hasMany(SubElemen::class);
    }
}
