<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\Artisan;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        $artisans = Artisan::all();

        $shops = [
            [
                'artisan_id' => $artisans[0]->id,
                'name' => 'Batik Ahmad Heritage',
                'address' => 'Jalan Tun Perak 123, Kuala Lumpur 50050',
                'latitude' => 3.1390,
                'longitude' => 101.6869,
                'status' => 'active',
            ],
            [
                'artisan_id' => $artisans[0]->id,
                'name' => 'Batik Ahmad Downtown',
                'address' => 'Jalan Sultan Ismail 456, Kuala Lumpur 50250',
                'latitude' => 3.1480,
                'longitude' => 101.7050,
                'status' => 'active',
            ],
            [
                'artisan_id' => $artisans[1]->id,
                'name' => 'Perhiasan Nur Azizah',
                'address' => 'Jalan Bukit Bintang 789, Kuala Lumpur 55100',
                'latitude' => 3.1520,
                'longitude' => 101.6950,
                'status' => 'active',
            ],
            [
                'artisan_id' => $artisans[2]->id,
                'name' => 'Kayu Indah Furniture',
                'address' => 'Lebuh Jaya, Shah Alam 40000',
                'latitude' => 3.0573,
                'longitude' => 101.5243,
                'status' => 'active',
            ],
            [
                'artisan_id' => $artisans[2]->id,
                'name' => 'Furniture Modern Studio',
                'address' => 'Jalan Rajawali, Shah Alam 40100',
                'latitude' => 3.0650,
                'longitude' => 101.5300,
                'status' => 'active',
            ],
            [
                'artisan_id' => $artisans[3]->id,
                'name' => 'Kue Siti Penang',
                'address' => 'Lebuh Chulia, Georgetown, Penang 10100',
                'latitude' => 5.4164,
                'longitude' => 100.3327,
                'status' => 'active',
            ],
            [
                'artisan_id' => $artisans[4]->id,
                'name' => 'Logam Seni Ravi',
                'address' => 'Jalan Tan Sri Halim, Ipoh 30000',
                'latitude' => 4.5921,
                'longitude' => 101.5901,
                'status' => 'active',
            ],
        ];

        foreach ($shops as $shop) {
            Shop::create($shop);
        }
    }
}
