<?php

use Illuminate\Database\Seeder;

use App\User;
use Illuminate\Support\Facades\Hash;
class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => hash::make('Saydaliyev0512'),
            'admin' => '1',
            'viloyat_id' => 'Null',
            'tuman_id' => 'Null',
            'kasalxona_id' => 'Null',
        ]);
    }
}
