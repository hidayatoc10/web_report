<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\MetaDiklat;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\KopetensiKeahlian;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            "name" => "Administrator",
            "username" => "admin",
            "email" => "admin@smkn17.id",
            "password" => bcrypt("Telkomdso123"),
            "keterangan" => "Admin",
        ]);

        User::create(attributes: [
            "name" => "Guru",
            "username" => "guru",
            "email" => "guru@smkn17.id",
            "password" => bcrypt("guru12345"),
            "keterangan" => "Guru",
        ]);

        User::create([
            "name" => "Wali Murid",
            "username" => "manusia",
            "email" => "manusia@gmail.com",
            "password" => bcrypt("manusia123"),
            "keterangan" => "Wali Murid",
        ]);

        MetaDiklat::create([
            'Kode_mata_diklat' => '34567892',
            'Nama_mata_diklat' => 'Matematika',
        ]);
        MetaDiklat::create([
            'Kode_mata_diklat' => '45678289',
            'Nama_mata_diklat' => 'Produktif',
        ]);

        KopetensiKeahlian::create([
            'Kode_KK' => '9876789027',
            'Kode_mata_diklat' => '34567892',
            'Nama_kompetensi_keahlian' => 'RPL'
        ]);
    }
}
