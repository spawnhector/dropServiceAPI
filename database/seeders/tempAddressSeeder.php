<?php

namespace Database\Seeders;

use App\Models\temp_address;
use Illuminate\Database\Seeder;

class tempAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        temp_address::create([
            'country'=>'Miami',
            'city'=>'FL',
            'state'=>'Doral',
            'district'=>'LogiFreight '.rand(0,9).''.rand(0,9).''.rand(0,9).''.rand(0,9).''.rand(0,9).' KIN',
            'zip'=>''.rand(0,9).''.rand(0,9).''.rand(0,9).''.rand(0,9).''.rand(0,9).'-'.rand(0,9).''.rand(0,9).''.rand(0,9).''.rand(0,9).'',
        ]);
        temp_address::create([
            'country'=>'Germany',
            'city'=>'FG',
            'state'=>'Care',
            'district'=>'LogiFreight '.rand(0,9).''.rand(0,9).''.rand(0,9).''.rand(0,9).''.rand(0,9).' GIN',
            'zip'=>''.rand(0,9).''.rand(0,9).''.rand(0,9).''.rand(0,9).''.rand(0,9).'-'.rand(0,9).''.rand(0,9).''.rand(0,9).''.rand(0,9).'',
        ]);
        temp_address::create([
            'country'=>'England',
            'city'=>'LD',
            'state'=>'Doral',
            'district'=>'LogiFreight '.rand(0,9).''.rand(0,9).''.rand(0,9).''.rand(0,9).''.rand(0,9).' ENG',
            'zip'=>''.rand(0,9).''.rand(0,9).''.rand(0,9).''.rand(0,9).''.rand(0,9).'-'.rand(0,9).''.rand(0,9).''.rand(0,9).''.rand(0,9).'',
        ]);
    }
}
