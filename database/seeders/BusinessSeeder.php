<?php

namespace Database\Seeders;

use App\Models\BusinessModel;
use App\Models\BusinessBankAccount;
use App\Models\ClientModel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a user
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => bcrypt('password'),
        ]);

        // Define businesses with bank accounts
        $businesses = [
            [
                'business_name' => 'Ledgerly',
                'currency' => 'NGN',
                'business_email' => 'info@digitalhorizon.com',
                'business_address' => '123 Tech Street, Lagos',
                'business_phone_no' => '08012345678',
                'bank_account' => [
                    'account_name' => 'Ledgerly Nigeria',
                    'account_number' => '1234567890',
                    'bank_name' => 'GTBank',
                    'bank_code' => '058',
                ],
            ],
            [
                'business_name' => 'Skyline Tech',
                'currency' => 'NGN',
                'business_email' => 'contact@skylinetech.com',
                'business_address' => '45 Marina Road, Lagos',
                'business_phone_no' => '08087654321',
                'bank_account' => [
                    'account_name' => 'Skyline Tech Ltd',
                    'account_number' => '0987654321',
                    'bank_name' => 'Access Bank',
                    'bank_code' => '044',
                ],
            ],
        ];

        foreach ($businesses as $bizData) {
            // Wrap in transaction to ensure atomicity
            \DB::transaction(function () use ($user, $bizData) {
                $business = BusinessModel::create([
                    'user_id' => $user->id,
                    'business_name' => $bizData['business_name'],
                    'currency' => $bizData['currency'],
                    'business_email' => $bizData['business_email'],
                    'business_address' => $bizData['business_address'],
                    'business_phone_no' => $bizData['business_phone_no'],
                ]);

                // Create bank account
                $bankData = $bizData['bank_account'];
                $business->bankAccounts()->create([
                    'account_name' => $bankData['account_name'],
                    'account_number' => $bankData['account_number'],
                    'bank_name' => $bankData['bank_name'],
                    'bank_code' => $bankData['bank_code'] ?? null,
                ]);
            });
        }

        // Seed clients
        $clients = [
            [
                'client_name' => 'John Doe',
                'client_email' => 'john@example.com',
                'client_phone_no' => '08011112222',
                'client_address' => 'Lekki, Lagos',
            ],
            [
                'client_name' => 'Jane Smith',
                'client_email' => 'jane@example.com',
                'client_phone_no' => '08033334444',
                'client_address' => 'Ikeja, Lagos',
            ],
        ];

        foreach ($clients as $clientData) {
            ClientModel::create(array_merge($clientData, ['user_id' => $user->id]));
        }
    }
}