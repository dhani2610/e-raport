<?php

namespace App\Imports;

use App\Models\CapaianAkhir;
use App\Models\Fase;
use App\Models\User;
use App\Models\Siswa;
use App\Models\SubElemen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CapaianAkhirImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      $subElemen = SubElemen::create([
        'elemen_id' => $row[0],
        'name' => $row[1],
      ]);

      CapaianAkhir::create([
        'sub_elemen_id' => $subElemen->id,
        'fase_id' => $row[2],
        'name' => $row[3],
      ]);

      CapaianAkhir::create([
        'sub_elemen_id' => $subElemen->id,
        'fase_id' => $row[4],
        'name' => $row[5],
      ]);

      CapaianAkhir::create([
        'sub_elemen_id' => $subElemen->id,
        'fase_id' => $row[6],
        'name' => $row[7],
      ]);

    }

    // Tentukan baris pertama data yang akan diimpor (misalnya, baris judul tidak diimpor)
    public function startRow(): int
    {
        return 4;
    }
}
