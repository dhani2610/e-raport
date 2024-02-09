<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(50)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UserSeeder::class);
        $this->call(SekolahSeeder::class);
        $this->call(TapelSeeder::class);
        $this->call(FaseSDSeeder::class); // Fase SD
        // $this->call(FaseSMPSeeder::class); // Fase SMP
        // $this->call(FaseSMASeeder::class); // Fase SMA
        $this->call(TingkatSDSeeder::class); //Tingkat SD
        // $this->call(TingkatSMPSeeder::class); //Tingkat SMP
        // $this->call(TingkatSMASeeder::class); //Tingkat SMA
        $this->call(GuruSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(SiswaSeeder::class);
        $this->call(EkskulSeeder::class);
        $this->call(KetidakhadiranSeeder::class);
        $this->call(CatatanWalasSeeder::class);
        $this->call(KelompokMapelSeeder::class);
        $this->call(MapelSeeder::class);
        $this->call(PembelajaranSeeder::class);
        $this->call(TujuanPembelajaranSeeder::class);
        $this->call(DimensiSeeder::class);
        // $this->call(ElemenSeeder::class);

        \App\Models\Siswa::factory(200)->create();
        \App\Models\Guru::factory(20)->create();
        \App\Models\AnggotaEkskul::factory(20)->create();
        // \App\Models\SubElemen::factory(40)->create();
        // \App\Models\CapaianAkhir::factory(120)->create();
        \App\Models\Projek::factory(20)->create();
        \App\Models\CapaianProjek::factory(50)->create();
        \App\Models\KelompokProjek::factory(8)->create();
        \App\Models\AnggotaKelompok::factory(200)->create();
        \App\Models\ProjekPilihanKelompok::factory(20)->create();
    }
}
