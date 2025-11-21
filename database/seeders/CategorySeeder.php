<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate(['name' => 'Backend'],
            ['slug' => Str::slug('Backend'), 'description' => 'Backend']);
        Category::firstOrCreate(['name' => 'Frontend'],
            ['slug' => Str::slug('Frontend'), 'description' => 'Frontend']);
        Category::firstOrCreate(['name' => 'Design'],
            ['slug' => Str::slug('Design'), 'description' => 'Design']);
        Category::firstOrCreate(['name' => 'Media'],
            ['slug' => Str::slug('Media'), 'description' => 'Media']);
    }
}
