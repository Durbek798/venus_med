<?php

use Illuminate\Database\Seeder;

use App\viloyat;

class viloyatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        viloyat::create([
            'name'=>'Toshkent viloyati'
        ]);
        viloyat::create([
            'name'=>'Surxondaryo viloyati'
        ]);
        viloyat::create([
            'name'=>'Sirdaryo viloyati'
        ]);
        viloyat::create([
            'name'=>'Samarqand viloyati'
        ]);
        viloyat::create([
            'name'=>'Qoraqalpogʻiston Respublikasi'
        ]);
        viloyat::create([
            'name'=>'Qashqadaryo viloyati'
        ]);
        viloyat::create([
            'name'=>'Navoiy viloyati'
        ]);
        viloyat::create([
            'name'=>'Namangan viloyati'
        ]);
        viloyat::create([
            'name'=>'Xorazm viloyati'
        ]);
        viloyat::create([
            'name'=>'Jizzax viloyati'
        ]);
        viloyat::create([
            'name'=>'Fargʻona viloyati'
        ]);
        viloyat::create([
            'name'=>'Buxoro viloyati'
        ]);
        viloyat::create([
            'name'=>'Andijon viloyati'
        ]);

    }
}
