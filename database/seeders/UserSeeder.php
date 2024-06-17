<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Marlon David',
            'email' => 'marlon@gmail.com',
            'password' => bcrypt('marlon123')
        ]);

        User::factory(9)->create();
    }
}
