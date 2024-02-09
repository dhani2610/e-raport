<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Guru;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class GuruImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      $user = User::create([
        'email' => $row[8],
        'username' => $row[9],
        'role' => 'guru',
        'password' => $row[10],
      ]);

      // Menyimpan data ke dalam tabel siswas
      Guru::create([
          'user_id' => $user->id,
          'name' => $row[0],
          'nip' => $row[1],
          'nuptk' => $row[2],
          'jk' => $row[3],
          'tempatlahir' => $row[4],
          'tanggallahir' => $row[5],
          'telepon' => $row[6],
          'alamat' => $row[7],
      ]);

    }

    // Tentukan baris pertama data yang akan diimpor (misalnya, baris judul tidak diimpor)
    public function startRow(): int
    {
        return 6;
    }
}
