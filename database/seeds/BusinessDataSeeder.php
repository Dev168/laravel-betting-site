<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BusinessDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business_data')->insert([
        	'name' => 'business_bank_balance',
        	'value' => 0,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
    }
}
