<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::firstOrCreate(['name' => 'Client-One MMC'],
            ['logo' => 'client-one-mmc.png', 'notes' => 'Client One MMC']);
        Client::firstOrCreate(['name' => 'Client-Two MMC'],
            ['logo' => 'client-two-mmc.png', 'notes' => 'Client Two MMC']);
        Client::firstOrCreate(['name' => 'Client-Three MMC'],
            ['logo' => 'client-three-mmc.png', 'notes' => 'Client Three MMC']);
        Client::firstOrCreate(['name' => 'Client-Four MMC'],
            ['logo' => 'client-four-mmc.png', 'notes' => 'Client Four MMC']);
        Client::firstOrCreate(['name' => 'Client-Five MMC'],
            ['logo' => 'client-five-mmc.png', 'notes' => 'Client Five MMC']);
    }
}
