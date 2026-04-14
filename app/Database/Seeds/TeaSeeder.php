<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TeaSeeder extends Seeder
{
    public function run()
    {
        // 1. Insert Categories
        $categories = [
            ['name' => 'Green Tea',  'slug' => 'green-tea'],
            ['name' => 'Black Tea',  'slug' => 'black-tea'],
            ['name' => 'Herbal Tea', 'slug' => 'herbal-tea'],
            ['name' => 'Oolong Tea', 'slug' => 'oolong-tea'],
        ];
        $this->db->table('categories')->insertBatch($categories);

        // 2. Insert Products (Based on your HTML)
        $products = [
            [
                'category_id'    => 1, // Green Tea
                'name'           => 'Green Harmony Tea',
                'description'    => 'Rich, bold flavors from the finest estates.',
                'price'          => 60.00,
                'old_price'      => 70.00,
                'image_path'     => 't1.png',
                'is_best_seller' => 1,
                'is_new_arrival' => 0,
            ],
            [
                'category_id'    => 3, // Herbal Tea
                'name'           => 'Floral Breeze Blend',
                'description'    => 'Caffeine-free wellness blend.',
                'price'          => 80.00,
                'old_price'      => 95.00,
                'image_path'     => 't2.png',
                'is_best_seller' => 1,
                'is_new_arrival' => 0,
            ],
            [
                'category_id'    => 4, // Oolong
                'name'           => 'Golden Oolong Leaf',
                'description'    => 'Premium oolong leaves hand-picked daily.',
                'price'          => 75.00,
                'old_price'      => 90.00,
                'image_path'     => 't3.png',
                'is_best_seller' => 1,
                'is_new_arrival' => 0,
            ],
            [
                'category_id'    => 1, // Green Tea
                'name'           => 'Pure Matcha Cream',
                'description'    => 'High-grade ceremonial matcha.',
                'price'          => 65.00,
                'old_price'      => 80.00,
                'image_path'     => 't4.png',
                'is_best_seller' => 1,
                'is_new_arrival' => 0,
            ]
        ];
        $this->db->table('products')->insertBatch($products);
    }
}