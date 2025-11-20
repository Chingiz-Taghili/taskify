<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate(['name' => 'Backend'], ['description' => 'Backend']);
        Category::firstOrCreate(['name' => 'Frontend'], ['description' => 'Frontend']);
        Category::firstOrCreate(['name' => 'Design'], ['description' => 'Design']);
        Category::firstOrCreate(['name' => 'Media'], ['description' => 'Media']);
    }
}
