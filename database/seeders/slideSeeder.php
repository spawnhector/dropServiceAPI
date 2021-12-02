<?php

namespace Database\Seeders;

use App\Models\slide;
use Illuminate\Database\Seeder;

class slideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        slide::create([
            'name'=>'prealert',
            'status'=>'0',
        ]);
        slide::create([
            'name'=>'package',
            'status'=>'0',
        ]);
        slide::create([
            'name'=>'transit',
            'status'=>'0',
        ]);
        slide::create([
            'name'=>'delivered',
            'status'=>'0',
        ]);
    }
}
