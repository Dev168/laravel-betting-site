<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([		
			['id' => 1, 'name' => 'Wes Thorburn', 'email' => 'wjthorburn@live.com.au', 'password' => '$2y$10$Gg66erTnEA5fEMjxfn7vGOpDNJp8p//nQ4wcxftHI21Thgxg5qXeK', 'account_balance' => 500, 'remember_token' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
			['id' => 2, 'name' => 'Test User 1', 'email' => 'test@test.com', 'password' => '$2y$10$UPgxLeg6mswBGJ5rduOp4em04qCULdGcOgvzxLKzQu7wT0i56mhvi', 'account_balance' => 500, 'remember_token' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
			['id' => 3, 'name' => 'Travis Klein', 'email' => 'tklein92@hotmail.com', 'password' => '$2y$10$DhVbtaOxCx.9YngeNSsa7ecxZLPjtuvVLoIzN.PjUelK4ZHDdQ31q', 'account_balance' => 500, 'remember_token' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
			['id' => 4, 'name' => 'Isaac', 'email' => 'isaacschultz@live.com', 'password' => '$2y$10$HYm2ZEfGraH.zH13B.SCEeAGvEAA389nT2zY7m8jG92iH16bKAA9S', 'account_balance' => 500, 'remember_token' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
