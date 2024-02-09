<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokMapel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function mapel(){
      return $this->hasMany(Mapel::class);
    }
}
