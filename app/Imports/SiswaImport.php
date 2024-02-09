<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SiswaImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      $user = User::create([
        'email' => $row[25],
        'username' => $row[26],
        'role' => 'siswa',
        'password' => $row[27],
      ]);

      // Menyimpan data ke dalam tabel siswas
      $siswa = new Siswa([
          'user_id' => $user->id,
          'kelas_id' => $row[0],
          'name' => $row[1],
          'nis' => $row[2],
          'nisn' => $row[3],
          'tempatlahir' => $row[4],
          'tanggallahir' => $row[5],
          'jk' => $row[6],
          'agama' => $row[7],
          'statusdalamkeluarga' => $row[8],
          'anak_ke' => $row[9],
          'alamatsiswa' => $row[10],
          'teleponsiswa' => $row[11],
          'sekolahasal' => $row[12],
          'diterimadikelas' => $row[13],
          'diterimaditanggal' => $row[14],
          'namaayah' => $row[15],
          'pekerjaanayah' => $row[16],
          'namaibu' => $row[17],
          'pekerjaanibu' => $row[18],
          'alamatortu' => $row[19],
          'teleponortu' => $row[20],
          'namawali' => $row[21],
          'pekerjaanwali' => $row[22],
          'alamatwali' => $row[23],
          'teleponwali' => $row[24],
      ]);

      $siswa->save();
      return $siswa;
    }

    // Tentukan baris pertama data yang akan diimpor (misalnya, baris judul tidak diimpor)
    public function startRow(): int
    {
        return 6;
    }
}
