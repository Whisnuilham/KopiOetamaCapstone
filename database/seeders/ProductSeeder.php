<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $datas=[
            [
                'product_name'=>'Green Label',
                'category_id'=>1,
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'White Label',
                'category_id'=>'1',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Gold Label',
                'category_id'=>'1',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Esspresso',
                'category_id'=>'2',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Hot Americano',
                'category_id'=>'2',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Ice Americano',
                'category_id'=>'2',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Hot Mochacinno',
                'category_id'=>'1',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Ice Mochacinno',
                'category_id'=>'2',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Hot Latte',
                'category_id'=>'2',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Ice Latte',
                'category_id'=>'2',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Hot Cappucinno',
                'category_id'=>'2',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Black n White',
                'category_id'=>'2',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Magic',
                'category_id'=>'2',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Piccolo',
                'category_id'=>'2',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Anggur Dahayu',
                'category_id'=>'3',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Harum Sukma',
                'category_id'=>'3',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Merah Delima',
                'category_id'=>'3',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Tjahaja Gantari',
                'category_id'=>'3',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Kopi Susu Toean Oetama',
                'category_id'=>'4',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Kopi Susu Permen Kapas',
                'category_id'=>'4',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Kopi Susu Halubanana',
                'category_id'=>'4',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Kopi Susu Klepon',
                'category_id'=>'4',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Kopi Susu Gendhis',
                'category_id'=>'4',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Hot Red Velvet Latte',
                'category_id'=>'5',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Ice Red Velvet Latte',
                'category_id'=>'5',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Hot Matcha Latte',
                'category_id'=>'5',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Ice Matcha Latte',
                'category_id'=>'5',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Hot Choco Latte',
                'category_id'=>'5',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Ice Choco Latte',
                'category_id'=>'5',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Ice Banana Bomb',
                'category_id'=>'5',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Ice Lychee Tea',
                'category_id'=>'5',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Ice Peach Tea',
                'category_id'=>'5',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Cahyo Mantrijeron 38',
                'category_id'=>'6',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Gonzaga Pine Brulee',
                'category_id'=>'6',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Bima Forgot Me Not',
                'category_id'=>'6',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Modern TokTok',
                'category_id'=>'7',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Klasik TokTok',
                'category_id'=>'7',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'product_name'=>'Shot only',
                'category_id'=>'7',
                'description'=>'kebakaran abangku',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            ];

            Product::insert($datas);
    }
}
