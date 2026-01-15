<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            [
                'name' => 'Rina Sharma',
                'email' => 'rina@email.com',
                'password' => Hash::make('password123'),
                'phone' => '0145678901',
                'address' => 'Jalan Rajawali, Bangsar, Kuala Lumpur',
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@email.com',
                'password' => Hash::make('password123'),
                'phone' => '0134567890',
                'address' => 'Jalan Tun Razak, Pudu, Kuala Lumpur',
            ],
            [
                'name' => 'Wong Li Mei',
                'email' => 'liwei@email.com',
                'password' => Hash::make('password123'),
                'phone' => '0156789012',
                'address' => 'Lebuh Bintang, Petaling Jaya, Selangor',
            ],
            [
                'name' => 'Deepak Menon',
                'email' => 'deepak@email.com',
                'password' => Hash::make('password123'),
                'phone' => '0167890123',
                'address' => 'Jalan Sultan Ahmad Shah, Kota Kinabalu, Sabah',
            ],
            [
                'name' => 'Nurul Ain',
                'email' => 'nurul@email.com',
                'password' => Hash::make('password123'),
                'phone' => '0178901234',
                'address' => 'Persiaran Raja Chulan, Bukit Raja, Selangor',
            ],
            [
                'name' => 'Michael Chen',
                'email' => 'michael@email.com',
                'password' => Hash::make('password123'),
                'phone' => '0189012345',
                'address' => 'Jalan Lebuhraya, Subang Jaya, Selangor',
            ],
            [
                'name' => 'Aisha Mohamed',
                'email' => 'aisha@email.com',
                'password' => Hash::make('password123'),
                'phone' => '0190123456',
                'address' => 'Jalan Tun Dr Ismail, Kuala Lumpur',
            ],
            [
                'name' => 'John Lim',
                'email' => 'john@email.com',
                'password' => Hash::make('password123'),
                'phone' => '0101234567',
                'address' => 'Jalan Sultan Sulaiman, Sentosa, Kuala Lumpur',
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
