<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            [
             'name' => 'ブローチ',
            ],
            [
             'name' => 'ネックレス',
            ],
            [
             'name' => 'リング',
            ],
 
         ];
 
         foreach($params as $param){
             DB::table('types')->insert($param);
         }
    }
}
