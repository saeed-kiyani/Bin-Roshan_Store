<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Elegant Black Ensemble',
                'category' => 'Clothing',
                'sku' => 'BIS-CLO-001',
                'price' => 4999,
                'image' => 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&w=800&q=85',
                'featured' => true,
            ],

            [
                'name' => 'Golden Jewelry Set',
                'category' => 'Jewelry',
                'sku' => 'BIS-JEW-001',
                'price' => 3499,
                'image' => 'https://images.unsplash.com/photo-1611652022419-a9419f74343d?auto=format&fit=crop&w=800&q=85',
                'featured' => false,
            ],

            [
                'name' => 'Premium Classic Watch',
                'category' => 'Watches',
                'sku' => 'BIS-WAT-001',
                'price' => 6999,
                'image' => 'https://images.unsplash.com/photo-1523170335258-f5ed11844a49?auto=format&fit=crop&w=800&q=85',
                'featured' => false,
            ],

            [
                'name' => 'Designer Lace',
                'category' => 'Laces',
                'sku' => 'BIS-LAC-001',
                'price' => 1499,
                'image' => 'https://images.unsplash.com/photo-1590736704728-f4730bb30770?auto=format&fit=crop&w=800&q=85',
                'featured' => false,
            ],

            [
                'name' => 'Premium Formal Wear',
                'category' => 'Clothing',
                'sku' => 'BIS-CLO-002',
                'price' => 5999,
                'image' => 'https://images.unsplash.com/photo-1506629905607-d9e1f7f9e8e7?auto=format&fit=crop&w=800&q=85',
                'featured' => false,
            ],

            [
                'name' => 'Pearl Jewelry Collection',
                'category' => 'Jewelry',
                'sku' => 'BIS-JEW-002',
                'price' => 4299,
                'image' => 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=800&q=85',
                'featured' => true,
            ],

            [
                'name' => 'Luxury Gold Watch',
                'category' => 'Watches',
                'sku' => 'BIS-WAT-002',
                'price' => 7999,
                'image' => 'https://images.unsplash.com/photo-1547996160-81dfa63595aa?auto=format&fit=crop&w=800&q=85',
                'featured' => false,
            ],

            [
                'name' => 'Classic Fashion Bag',
                'category' => 'Accessories',
                'sku' => 'BIS-ACC-001',
                'price' => 1999,
                'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?auto=format&fit=crop&w=800&q=85',
                'featured' => false,
            ],
        ];

        foreach ($products as $data) {

            $category = Category::where(
                'slug',
                Str::slug($data['category'])
            )->firstOrFail();

            $product = Product::updateOrCreate(
                [
                    'sku' => $data['sku'],
                ],
                [
                    'category_id' => $category->id,
                    'name' => $data['name'],
                    'slug' => Str::slug($data['name']),
                    'description' => 'A carefully selected Bin Ismail piece designed for timeless style.',
                    'price' => $data['price'],
                    'sale_price' => null,
                    'stock' => 10,
                    'is_featured' => $data['featured'],
                    'is_active' => true,
                ]
            );

            ProductImage::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'image' => $data['image'],
                ],
                [
                    'is_primary' => true,
                    'sort_order' => 1,
                ]
            );
        }
    }
}