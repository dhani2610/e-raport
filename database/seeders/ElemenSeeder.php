<?php

namespace Database\Seeders;

use App\Models\Elemen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ElemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Beriman, Bertakwa Kepada Tuhan Yang Maha Esa, dan Berahlak Mulia
        collect([
          [
            'dimensi_id' => 1,
            'name' => 'Akhlak beragama',
          ],
          [
            'dimensi_id' => 1,
            'name' => 'Akhlak pribadi',
          ],
          [
            'dimensi_id' => 1,
            'name' => 'Akhlak kepada manusia',
          ],
          [
            'dimensi_id' => 1,
            'name' => 'Akhlak kepada alam',
          ],
          [
            'dimensi_id' => 1,
            'name' => 'Akhlak bernegara',
          ],
        ])->each(fn($q) => Elemen::create($q));

        // 2. Berkebhinekaan Global
        collect([
          [
            'dimensi_id' => 2,
            'name' => 'Mengenal dan menghargai budaya',
          ],
          [
            'dimensi_id' => 2,
            'name' => 'Komunikasi dan interaksi antar budaya',
          ],
          [
            'dimensi_id' => 2,
            'name' => 'Refleksi dan tanggung jawab terhadap pengalaman kebinekaan',
          ],
          [
            'dimensi_id' => 2,
            'name' => 'Berkeadilan Sosial',
          ],
        ])->each(fn($q) => Elemen::create($q));

        // 3. Bergotong Royong
        collect([
          [
            'dimensi_id' => 3,
            'name' => 'Kolaborasi',
          ],
          [
            'dimensi_id' => 3,
            'name' => 'Kepedulian',
          ],
          [
            'dimensi_id' => 3,
            'name' => 'Berbagi',
          ],
        ])->each(fn($q) => Elemen::create($q));

        // 4. Mandiri
        collect([
          [
            'dimensi_id' => 4,
            'name' => 'Pemahaman diri dan situasi yang dihadapi',
          ],
          [
            'dimensi_id' => 4,
            'name' => 'Regulasi diri',
          ],
        ])->each(fn($q) => Elemen::create($q));

        // 5. Bernalar Kritis
        collect([
          [
            'dimensi_id' => 5,
            'name' => 'Memperoleh dan memproses informasi dan gagasan',
          ],
          [
            'dimensi_id' => 5,
            'name' => 'Menganalisis dan mengevaluasi penalaran',
          ],
          [
            'dimensi_id' => 5,
            'name' => 'Merefleksi dan mengevaluasi pemikirannya sendiri',
          ],
        ])->each(fn($q) => Elemen::create($q));

        // 6. Kreatif
        collect([
          [
            'dimensi_id' => 6,
            'name' => 'Menghasilkan gagasan yang orisinal',
          ],
          [
            'dimensi_id' => 6,
            'name' => 'Menghasilkan karya dan tindakan yang orisinal',
          ],
          [
            'dimensi_id' => 6,
            'name' => 'Memiliki keluwesan berpikir dalam mencari alternatif solusi permasalahan',
          ],
        ])->each(fn($q) => Elemen::create($q));
    }
}
