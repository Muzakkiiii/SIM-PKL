<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun default Administrator Hubungan Industri (Hubin)
        // Silakan login menggunakan kredensial ini, lalu ganti passwordnya.
        User::updateOrCreate(
            ['email' => 'admin@simpkl.sch.id'],
            [
                'name' => 'Admin Hubin',
                'password' => bcrypt('admin123'),
            ]
        );
    }
}
