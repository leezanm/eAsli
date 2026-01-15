<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Artisan;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SaleSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        $customers = Customer::all();
        $artisans = Artisan::all();

        $sales = [
            [
                'artisan_id' => $artisans[0]->id,
                'product_id' => $products[0]->id,
                'customer_id' => $customers[0]->id,
                'quantity' => 2,
                'unit_price' => 150.00,
                'total_price' => 300.00,
                'sale_date' => Carbon::now()->subDays(15)->toDateString(),
                'payment_status' => 'paid',
            ],
            [
                'artisan_id' => $artisans[0]->id,
                'product_id' => $products[1]->id,
                'customer_id' => $customers[1]->id,
                'quantity' => 1,
                'unit_price' => 175.00,
                'total_price' => 175.00,
                'sale_date' => Carbon::now()->subDays(12)->toDateString(),
                'payment_status' => 'paid',
            ],
            [
                'artisan_id' => $artisans[1]->id,
                'product_id' => $products[4]->id,
                'customer_id' => $customers[2]->id,
                'quantity' => 3,
                'unit_price' => 35.00,
                'total_price' => 105.00,
                'sale_date' => Carbon::now()->subDays(10)->toDateString(),
                'payment_status' => 'paid',
            ],
            [
                'artisan_id' => $artisans[1]->id,
                'product_id' => $products[5]->id,
                'customer_id' => $customers[3]->id,
                'quantity' => 5,
                'unit_price' => 25.00,
                'total_price' => 125.00,
                'sale_date' => Carbon::now()->subDays(8)->toDateString(),
                'payment_status' => 'paid',
            ],
            [
                'artisan_id' => $artisans[2]->id,
                'product_id' => $products[7]->id,
                'customer_id' => $customers[4]->id,
                'quantity' => 1,
                'unit_price' => 1800.00,
                'total_price' => 1800.00,
                'sale_date' => Carbon::now()->subDays(5)->toDateString(),
                'payment_status' => 'paid',
            ],
            [
                'artisan_id' => $artisans[2]->id,
                'product_id' => $products[9]->id,
                'customer_id' => $customers[5]->id,
                'quantity' => 2,
                'unit_price' => 280.00,
                'total_price' => 560.00,
                'sale_date' => Carbon::now()->subDays(4)->toDateString(),
                'payment_status' => 'paid',
            ],
            [
                'artisan_id' => $artisans[3]->id,
                'product_id' => $products[12]->id,
                'customer_id' => $customers[6]->id,
                'quantity' => 10,
                'unit_price' => 12.00,
                'total_price' => 120.00,
                'sale_date' => Carbon::now()->subDays(3)->toDateString(),
                'payment_status' => 'paid',
            ],
            [
                'artisan_id' => $artisans[3]->id,
                'product_id' => $products[13]->id,
                'customer_id' => $customers[7]->id,
                'quantity' => 2,
                'unit_price' => 35.00,
                'total_price' => 70.00,
                'sale_date' => Carbon::now()->subDays(2)->toDateString(),
                'payment_status' => 'paid',
            ],
            [
                'artisan_id' => $artisans[4]->id,
                'product_id' => $products[15]->id,
                'customer_id' => $customers[0]->id,
                'quantity' => 1,
                'unit_price' => 320.00,
                'total_price' => 320.00,
                'sale_date' => Carbon::now()->subDay()->toDateString(),
                'payment_status' => 'paid',
            ],
            [
                'artisan_id' => $artisans[0]->id,
                'product_id' => $products[2]->id,
                'customer_id' => $customers[2]->id,
                'quantity' => 1,
                'unit_price' => 120.00,
                'total_price' => 120.00,
                'sale_date' => Carbon::now()->toDateString(),
                'payment_status' => 'pending',
            ],
        ];

        foreach ($sales as $sale) {
            Sale::create($sale);
        }
    }
}
