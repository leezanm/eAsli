<?php

namespace Database\Seeders;

use App\Models\Artisan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ArtisanSeeder extends Seeder
{
    public function run(): void
    {
        $artisans = [
            [
                'name' => 'Ahmad Zainal',
                'email' => 'ahmad@easli.com',
                'password' => Hash::make('password123'),
                'phone' => '0123456789',
                'address' => 'Jalan Tun Perak, Kuala Lumpur',
                'description' => 'Pengrajin batik tradisional dengan pengalaman 15 tahun',
            ],
            [
                'name' => 'Nur Azizah',
                'email' => 'azizah@easli.com',
                'password' => Hash::make('password123'),
                'phone' => '0198765432',
                'address' => 'Jalan Sultan Ismail, Kuala Lumpur',
                'description' => 'Pembuat perhiasan tangan dari bahan daur ulang',
            ],
            [
                'name' => 'Mohd Karim',
                'email' => 'karim@easli.com',
                'password' => Hash::make('password123'),
                'phone' => '0187654321',
                'address' => 'Jalan Merdeka, Shah Alam',
                'description' => 'Pengrajin kayu dan furnitur berkualitas tinggi',
            ],
            [
                'name' => 'Siti Fatimah',
                'email' => 'siti@easli.com',
                'password' => Hash::make('password123'),
                'phone' => '0176543210',
                'address' => 'Lebuh Raya Seberang Jaya, Penang',
                'description' => 'Pembuat kue tradisional dan pastry modern',
            ],
            [
                'name' => 'Ravi Kumar',
                'email' => 'ravi@easli.com',
                'password' => Hash::make('password123'),
                'phone' => '0165432109',
                'address' => 'Jalan Sultan Abdul Halim, Ipoh',
                'description' => 'Pengrajin logam dan seni patung kontemporer',
            ],
        ];

        foreach ($artisans as $artisan) {
            Artisan::create($artisan);
        }
    }
}
