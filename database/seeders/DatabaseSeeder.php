<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        { {
        }
    }
    // \Ap{{ p\Mo }}dels\User::factory()->create([
    //    {{  'na }}me' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);

    User::factory()->create([
        'name' => 'Admin',
        'email' => 'admin@material.com',
        'password' => ('secret')
    ]);

    }
}
