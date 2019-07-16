<?php

use App\Models\Items;
use Illuminate\Database\Seeder;

class ItemsSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Items::truncate();

        $items = array(
            [
            'item_name'=>'book',
            'price'=>3000,
            'qty'=>2000
            ],
            [
            'item_name'=>'white board',
            'price'=>100000,
            'qty'=>20
            ],
            [
            'item_name'=>'black board',
            'price'=>50000,
            'qty'=>5
            ],
            [
            'item_name'=>'pen',
            'price'=>1000,
            'qty'=>100
            ],
            [
            'item_name'=>'dvd disk',
            'price'=>3000,
            'qty'=>15
            ],
            [
            'item_name'=>'stylograph',
            'price'=>5000,
            'qty'=>10
            ],
        );

        Items::insert($items);
    }
}
