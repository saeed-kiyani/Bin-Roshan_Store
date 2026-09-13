<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Clothing',
                'description' => 'Elegant clothing carefully selected for timeless style.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Jewelry',
                'description' => 'Refined jewelry pieces for every occasion.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Laces',
                'description' => 'Premium laces and finishing details.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Watches',
                'description' => 'Classic watches combining style and functionality.',
                'sort_order' => 4,
            ],
            [
                'name' => 'Accessories',
                'description' => 'Carefully selected accessories to complete your look.',
                'sort_order' => 5,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                [
                    'slug' => Str::slug($category['name']),
                ],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'is_active' => true,
                    'sort_order' => $category['sort_order'],
                ]
            );
        }
    }
}