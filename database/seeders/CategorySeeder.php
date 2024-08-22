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
        $categories = [
            ['name' => 'Technology'],
            ['name' => 'Health'],
            ['name' => 'Lifestyle'],
            ['name' => 'Education'],
            ['name' => 'Travel'],
            ['name' => 'Food'],
            ['name' => 'Entertainment'],
            ['name' => 'Sports'],
            ['name' => 'Business'],
            ['name' => 'Science'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}