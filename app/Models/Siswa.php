<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function kelas(){
      return $this->belongsTo(Kelas::class);
    }

    public function anggotaEkskul(){
      return $this->hasMany(AnggotaEkskul::class);
    }

    public function ketidakhadiran(){
      return $this->hasOne(Ketidakhadiran::class);
    }

    public function catatanWalas(){
      return $this->hasOne(CatatanWalas::class);
    }

    public function pencapaianTp(){
      return $this->hasMany(PencapaianTp::class);
    }

    public function nilaiAkhir(){
      return $this->hasMany(NilaiAkhir::class);
    }

    public function anggotaKelompok(){
      return $this->hasOne(AnggotaKelompok::class);
    }

    public function nilaiProjek(){
      return $this->hasMany(NilaiProjek::class);
    }

    public function catatanProjek(){
      return $this->hasMany(CatatanProjek::class);
    }

    public function aktif(){
      return $this->whereHas('user', fn($q) => $q->where('is_aktif', 1));
    }
}
