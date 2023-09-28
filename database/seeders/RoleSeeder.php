<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
        ]);
    
        Role::create([
            'name' => 'baa',
        ]);
    
        Role::create([
            'name' => 'dosen wali',
        ]);
    
        Role::create([
            'name' => 'mahasiswa',
        ]);
    }
}
