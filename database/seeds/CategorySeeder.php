<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'id' => 1,
            'name' => 'Ropa Adulto',
            'status' => true
        ]);

        DB::table('categories')->insert([
            'id' => 2,
            'name' => 'Infantil',
            'status' => true
        ]);

		DB::table('categories')->insert([
            'id' => 3,
            'name' => 'Ropa de Hombre',
            'status' => true,
            'parent_id' => 1
        ]);

		DB::table('categories')->insert([
            'id' => 4,
            'name' => 'Ropa de Mujer',
            'status' => true,
            'parent_id' => 1
        ]);

		DB::table('categories')->insert([
            'id' => 5,
            'name' => 'Ropa de Niño',
            'status' => false,
            'parent_id' => 2
        ]);

        DB::table('categories')->insert([
            'id' => 6,
            'name' => 'Ropa de Niña',
            'status' => false,
            'parent_id' => 2
        ]);
    }
}
