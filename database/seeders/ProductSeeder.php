<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Artisan;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $artisans = Artisan::all();

        $products = [
            // Ahmad Zainal's products
            [
                'artisan_id' => $artisans[0]->id,
                'name' => 'Batik Mega Mendung',
                'category' => 'Kain Batik',
                'description' => 'Kain batik tradisional dengan motif mega mendung yang elegan',
                'price' => 150.00,
                'stock' => 25,
            ],
            [
                'artisan_id' => $artisans[0]->id,
                'name' => 'Batik Parang Rusak',
                'category' => 'Kain Batik',
                'description' => 'Batik klasik dengan pola parang yang indah',
                'price' => 175.00,
                'stock' => 18,
            ],
            [
                'artisan_id' => $artisans[0]->id,
                'name' => 'Kemeja Batik Premium',
                'category' => 'Pakaian',
                'description' => 'Kemeja batik untuk pria dengan bahan berkualitas tinggi',
                'price' => 120.00,
                'stock' => 15,
            ],
            [
                'artisan_id' => $artisans[0]->id,
                'name' => 'Sarung Batik Kontemporer',
                'category' => 'Kain Batik',
                'description' => 'Sarung batik dengan desain modern yang trendy',
                'price' => 95.00,
                'stock' => 30,
            ],
            // Nur Azizah's products
            [
                'artisan_id' => $artisans[1]->id,
                'name' => 'Kalung Daur Ulang Botol',
                'category' => 'Perhiasan',
                'description' => 'Kalung cantik yang dibuat dari botol plastik daur ulang',
                'price' => 35.00,
                'stock' => 50,
            ],
            [
                'artisan_id' => $artisans[1]->id,
                'name' => 'Gelang Macrame Warna-warni',
                'category' => 'Perhiasan',
                'description' => 'Gelang tangan dengan benang macrame dalam berbagai pilihan warna',
                'price' => 25.00,
                'stock' => 60,
            ],
            [
                'artisan_id' => $artisans[1]->id,
                'name' => 'Anting-anting Batu Alam',
                'category' => 'Perhiasan',
                'description' => 'Anting-anting dengan batu alam asli yang indah',
                'price' => 45.00,
                'stock' => 40,
            ],
            // Mohd Karim's products
            [
                'artisan_id' => $artisans[2]->id,
                'name' => 'Meja Makan Kayu Jati',
                'category' => 'Furniture',
                'description' => 'Meja makan dengan kayu jati pilihan berukuran 6 kursi',
                'price' => 1800.00,
                'stock' => 5,
            ],
            [
                'artisan_id' => $artisans[2]->id,
                'name' => 'Lemari Pakaian Kayu Akasia',
                'category' => 'Furniture',
                'description' => 'Lemari pakaian dengan finishing natural yang elegan',
                'price' => 950.00,
                'stock' => 8,
            ],
            [
                'artisan_id' => $artisans[2]->id,
                'name' => 'Rak Dinding Minimalis',
                'category' => 'Furniture',
                'description' => 'Rak dinding dengan desain minimalis dari kayu pinus',
                'price' => 280.00,
                'stock' => 20,
            ],
            [
                'artisan_id' => $artisans[2]->id,
                'name' => 'Sofa Ruang Tamu Modern',
                'category' => 'Furniture',
                'description' => 'Sofa dengan desain modern dan bahan berkualitas tinggi',
                'price' => 2200.00,
                'stock' => 3,
            ],
            [
                'artisan_id' => $artisans[2]->id,
                'name' => 'Kursi Gaming Ergonomis',
                'category' => 'Furniture',
                'description' => 'Kursi gaming dengan ergonomi sempurna untuk kenyamanan maksimal',
                'price' => 450.00,
                'stock' => 12,
            ],
            // Siti Fatimah's products
            [
                'artisan_id' => $artisans[3]->id,
                'name' => 'Pulut Kuning',
                'category' => 'Makanan',
                'description' => 'Pulut kuning tradisional Penang yang nikmat',
                'price' => 12.00,
                'stock' => 100,
            ],
            [
                'artisan_id' => $artisans[3]->id,
                'name' => 'Kek Lapis Sarawak',
                'category' => 'Makanan',
                'description' => 'Kek lapis asli dengan rasa yang autentik',
                'price' => 35.00,
                'stock' => 30,
            ],
            [
                'artisan_id' => $artisans[3]->id,
                'name' => 'Tart Nanas Homemade',
                'category' => 'Makanan',
                'description' => 'Tart nanas buatan rumah dengan isi yang lezat',
                'price' => 28.00,
                'stock' => 45,
            ],
            // Ravi Kumar's products
            [
                'artisan_id' => $artisans[4]->id,
                'name' => 'Patung Bunga Logam',
                'category' => 'Seni',
                'description' => 'Patung bunga yang dibuat dari logam dengan tangan ahli',
                'price' => 320.00,
                'stock' => 7,
            ],
            [
                'artisan_id' => $artisans[4]->id,
                'name' => 'Hiasan Dinding Geometris',
                'category' => 'Seni',
                'description' => 'Hiasan dinding dengan pola geometris modern dari logam',
                'price' => 185.00,
                'stock' => 15,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
