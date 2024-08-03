<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products=[
            ["product1",100,7],
            ["product2",160,67],
            ["product3",102,71],
            ["product4",1000,7],
            ["product5",920,3],

        ];
        foreach ($products as $product){
            Product::create([
                "name"=>$product[0],
                "price"=>$product[1],
                "stock"=>$product[2]

            ]);
        }
    }
}
