<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Driver::factory(10)->create([
            'is_admin'=>false, //10 db normal fuvarozo
        ]);

        //kulon admin felhasznalo
        Driver::create([
            'name'=>'Admin user',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('password'),
            'is_admin'=>true,
        ]);
    }
}
