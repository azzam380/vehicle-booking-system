<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Pool',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin123'), 
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Manager Operasional',
            'email' => 'approver1@mail.com',
            'password' => Hash::make('manager123'),
            'role' => 'approver',
        ]);

        User::create([
            'name' => 'Kepala Cabang',
            'email' => 'approver2@mail.com',
            'password' => Hash::make('kepala123'),
            'role' => 'approver',
        ]);


        Vehicle::create([
            'name' => 'Toyota Hilux 4x4',
            'type' => 'goods',
            'ownership' => 'company',
            'plate_number' => 'B 1234 MNG',
            'fuel_consumption' => 12
        ]);

        Vehicle::create([
            'name' => 'Mitsubishi Triton',
            'type' => 'goods',
            'ownership' => 'rent',
            'plate_number' => 'L 9982 XYZ',
            'fuel_consumption' => 10
        ]);
    }
}
