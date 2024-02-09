<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dimensi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function elemen(){
      return $this->hasMany(Elemen::class);
    }
}
