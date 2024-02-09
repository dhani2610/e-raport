<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function tingkat(){
      return $this->belongsTo(Tingkat::class);
    }

    public function tapel(){
      return $this->belongsTo(Tapel::class);
    }

    public function guru(){ // Wali Kelas
      return $this->belongsTo(Guru::class);
    }

    public function siswa(){
      return $this->hasMany(Siswa::class);
    }

    public static function siswaAktifKelasCount($id){
      return Siswa::where('kelas_id', $id)->whereHas('user', fn($q)=> $q->where('is_aktif', true))->count();
    }

    public function pembelajaran(){
      return $this->hasMany(Pembelajaran::class);
    }

    public function kelompokProjek(){
      return $this->hasMany(KelompokProjek::class);
    }

    // HELPER
    public function wali_kelas(){
      return ($this->guru) ? $this->guru->name : '-';
    }
}
