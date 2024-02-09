<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class DummyHelper
{
    public static function randTanggalLahirGuru(){
        return date('Y-m-d', rand(strtotime('1970-01-01'), strtotime('1995-12-31')));
    }

    public static function randTanggalLahirSiswa(){
        return date('Y-m-d', rand(strtotime('2010-01-01'), strtotime('2016-12-31')));
    }

    public static function randJenisKelamin(){
      return ['L', 'P'][array_rand(['L', 'P'])];
    }

    public static function randTelepon(){
        return '08' . str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
    }

    public static function randKota(){
        return ['Jakarta', 'Bekasi', 'Bogor', 'Depok', 'Tangerang', 'Yogyakarta'][array_rand(['Jakarta', 'Bekasi', 'Bogor', 'Depok', 'Tangerang', 'Yogyakarta'])];
    }

    public static function randAlamat(){
        return ['Jl. Indonesia No.17', 'Jl. Mekarsari No.13', 'Jl. HZ Mustofa', 'Jl. Pegangsaan Timur'][array_rand(['Jl. Indonesia No.17', 'Jl. Mekarsari No.13', 'Jl. HZ Mustofa', 'Jl. Pegangsaan Timur'])];
    }

    public static function randNip(){
      return '19' . str_pad(rand(0, 9999999999), 14, '0', STR_PAD_LEFT);
    }

    public static function randNuptk(){
      return '8' . str_pad(rand(0, 9999999999), 15, '0', STR_PAD_LEFT);
    }

    public static function randNis(){
      return str_pad(rand(0, 9999999999), 6, '0', STR_PAD_LEFT);
    }

    public static function randNisn(){
      return str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
    }
}
