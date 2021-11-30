<?php

namespace Database\Seeders;

use App\Models\company_address;
use Illuminate\Database\Seeder;

class companyAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        company_address::create([
            'country'=>'Jamaica',
            'city'=>'Kingston',
            'state'=>'Half Way Tree',
            'district'=>'123 Hwt road',
            'zip'=>'3332',
        ]);
        company_address::create([
            'country'=>'Germany',
            'city'=>'Notsure',
            'state'=>'test',
            'district'=>'234 testing',
            'zip'=>'55643',
        ]);
        company_address::create([
            'country'=>'Canada',
            'city'=>'tester',
            'state'=>'great',
            'district'=>'greatness',
            'zip'=>'7765',
        ]);
    }
}
