<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $params=[
            [
                'name' => 'ブローチ',
                'price' => 100,
                'comment' => 'ブローチ',
                'img_path' => 'broach.jpg',
                'stock' => 5,
                'user_id' => 0,
                'type_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'ネックレス',
                'price' => 1000,
                'comment' => 'ネックレス',
                'img_path' => 'necklace.jpg',
                'stock' => 5,
                'user_id' => 0,
                'type_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'リング',
                'price' => 10000,
                'comment' => 'リング',
                'img_path' => 'ring.jpg',
                'stock' => 5,
                'user_id' => 0,
                'type_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        foreach($params as $param){
            DB::table('products')->insert($param);
        }
        
    }
}
