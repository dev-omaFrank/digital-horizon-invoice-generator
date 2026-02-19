<?php

namespace Database\Seeders;

use App\Models\BusinessModel;
use App\Models\ClientModel;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => bcrypt('password'),
        ]);

        // Create businesses linked to that user
        BusinessModel::create([
            'user_id' => $user->id,
            'business_name' => 'Digital Horizon',
            'business_email' => 'info@digitalhorizon.com',
            'business_address' => '123 Tech Street, Lagos',
            'business_phone_no' => '08012345678',
        ]);

        BusinessModel::create([
            'user_id' => $user->id,
            'business_name' => 'Skyline Tech',
            'business_email' => 'contact@skylinetech.com',
            'business_address' => '45 Marina Road, Lagos',
            'business_phone_no' => '08087654321',
        ]);

        ClientModel::create([
            'user_id' => $user->id,
            'client_name' => 'John Doe',
            'client_email' => 'john@example.com',
            'client_phone_no' => '08011112222',
            'client_address' => 'Lekki, Lagos',
        ]);

        ClientModel::create([
            'user_id' => $user->id,
            'client_name' => 'Jane Smith',
            'client_email' => 'jane@example.com',
            'client_phone_no' => '08033334444',
            'client_address' => 'Ikeja, Lagos',
        ]);
    }
}
