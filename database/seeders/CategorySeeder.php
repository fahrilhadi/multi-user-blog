<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Technology', 'slug' => 'technology'],
            ['name' => 'Education', 'slug' => 'education'],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle'],
        ]);
    }
}
