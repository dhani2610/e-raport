<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
          [
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'role' => 'admin',
          ],
          [
            'username' => 'walikelas',
            'email' => 'walikelas@gmail.com',
            'password' => 'password',
            'role' => 'guru',
          ],
          [
            'username' => 'gurumapel',
            'email' => 'gurumapel@gmail.com',
            'password' => 'password',
            'role' => 'guru',
          ],
          [
            'username' => 'pembinaekskul',
            'email' => 'pembinaekskul@gmail.com',
            'password' => 'password',
            'role' => 'guru',
          ],
          [
            'username' => 'siswa',
            'email' => 'siswa@gmail.com',
            'password' => 'password',
            'role' => 'siswa',
          ],
        ])->each(fn($q) => User::create($q));
    }
}
