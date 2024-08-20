<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Technology', 'Sport', 'Health', 'Lifestyle', 'Education', 'Entertainment'];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
