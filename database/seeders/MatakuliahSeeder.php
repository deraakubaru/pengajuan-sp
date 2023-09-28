<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Matakuliah;

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Matakuliah::create([
            'name' => 'PSO',
            'semester' => 1,
        ]);

        Matakuliah::create([
            'name' => 'TSO',
            'semester' => 1,
        ]);

        Matakuliah::create([
            'name' => 'Matematika Diskrit',
            'semester' => 1,
        ]);

        Matakuliah::create([
            'name' => 'Logika Matematika',
            'semester' => 1,
        ]);

        Matakuliah::create([
            'name' => 'Pemrogramman Piranti Bergerak',
            'semester' => 6,
        ]);

        Matakuliah::create([
            'name' => 'Pemrogramman Website 1',
            'semester' => 3,
        ]);

        Matakuliah::create([
            'name' => 'Pemrogramman Website 2',
            'semester' => 4,
        ]);

    }
}
