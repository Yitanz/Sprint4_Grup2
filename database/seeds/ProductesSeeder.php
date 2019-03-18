<?php

use Illuminate\Database\Seeder;

class ProductesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('productes')->insert([
          'atributs' => '1',
          'descripcio' => 'cosetes',
          'estat' => '1',
      ]);

      DB::table('productes')->insert([
          'atributs' => '2',
          'descripcio' => 'laravel',
          'estat' => '0',
      ]);
    }
}
