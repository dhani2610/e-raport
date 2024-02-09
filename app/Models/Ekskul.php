<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function tapel(){
      return $this->belongsTo(Tapel::class);
    }

    public function guru(){ // Pembina Ekskul
      return $this->belongsTo(Guru::class);
    }

    public function anggotaEkskul(){
      return $this->hasMany(AnggotaEkskul::class);
    }

     // HELPER
     public function pembina(){
      return ($this->guru) ? $this->guru->name : '-';
    }
}
