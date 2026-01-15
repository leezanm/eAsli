<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\Artisan;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $artisans = Artisan::all();

        $reports = [
            [
                'artisan_id' => $artisans[0]->id,
                'type' => 'sales',
                'start_date' => Carbon::now()->startOfMonth()->toDateString(),
                'end_date' => Carbon::now()->toDateString(),
                'content' => 'Laporan Penjualan Batik Ahmad untuk bulan ini. Total 3 transaksi dengan revenue RM650.',
                'format' => 'pdf',
            ],
            [
                'artisan_id' => $artisans[1]->id,
                'type' => 'stock',
                'start_date' => Carbon::now()->subDays(7)->toDateString(),
                'end_date' => Carbon::now()->toDateString(),
                'content' => 'Laporan inventori perhiasan minggu ini. Total 150 unit dalam stok. Tidak ada barang yang habis.',
                'format' => 'excel',
            ],
            [
                'artisan_id' => $artisans[2]->id,
                'type' => 'performance',
                'start_date' => Carbon::now()->startOfMonth()->toDateString(),
                'end_date' => Carbon::now()->toDateString(),
                'content' => 'Laporan performa furniture. Total revenue RM2,360 bulan ini. Produk terlaris: Meja Makan Kayu Jati.',
                'format' => 'json',
            ],
            [
                'artisan_id' => $artisans[3]->id,
                'type' => 'sales',
                'start_date' => Carbon::now()->subDays(14)->toDateString(),
                'end_date' => Carbon::now()->toDateString(),
                'content' => 'Laporan penjualan kue dua minggu terakhir. Total 2 transaksi dengan revenue RM190.',
                'format' => 'pdf',
            ],
            [
                'artisan_id' => $artisans[4]->id,
                'type' => 'performance',
                'start_date' => Carbon::now()->startOfMonth()->toDateString(),
                'end_date' => Carbon::now()->toDateString(),
                'content' => 'Laporan seni logam. Revenue bulan ini RM320. Nilai inventori RM2,855.',
                'format' => 'json',
            ],
        ];

        foreach ($reports as $report) {
            Report::create($report);
        }
    }
}
