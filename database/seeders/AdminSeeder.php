<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Mohammed',
            'last_name' => 'Amoudi',
            'email' => 'mohammedamo@element.ps',
            'password' => Hash::make('password'),
            'gender' => 'male',
            'type' => 'admin',
            
        ]);
    }
}
