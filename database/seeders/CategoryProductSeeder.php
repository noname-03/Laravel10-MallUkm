<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryProduct::create([
            'title' => 'Fashion Wanita',
        ]);
        CategoryProduct::create([
            'title' => 'Fashion Pria',
        ]);
        CategoryProduct::create([
            'title' => 'Makanan',
        ]);
        CategoryProduct::create([
            'title' => 'Minuman',
        ]);
    }
}