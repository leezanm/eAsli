<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    public function run(): void
    {
        $states = [
            'Johor',
            'Kedah',
            'Kelantan',
            'Melaka',
            'Negeri Sembilan',
            'Pahang',
            'Perak',
            'Perlis',
            'Pulau Pinang',
            'Sabah',
            'Sarawak',
            'Selangor',
            'Terengganu',
            'W.P. Kuala Lumpur',
            'W.P. Labuan',
            'W.P. Putrajaya',
        ];

        foreach ($states as $name) {
            State::firstOrCreate(['name' => $name]);
        }
    }
}
