<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas=[
            [
                'id'=>1,
                'name'=>'Manual Brewing Coffee',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id'=>2,
                'name'=>'Esspresso Based Coffee',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id'=>3,
                'name'=>'Minuman Kreasi',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id'=>4,
                'name'=>'Minuman Terserah (Iced Coffee)',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id'=>5,
                'name'=>'Minuman Terserah (Non Coffee)',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id'=>6,
                'name'=>'Signature Barista',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id'=>7,
                'name'=>'Tok Tok (Bersifat Rahasia)',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ];

        Category::insert($datas);
    }
}
