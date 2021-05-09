<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

		DB::table('Products')->insert([
            'sku' => $faker->randomNumber($nbDigits = 8, $strict = false),
            'name' => 'Camisa polo',
            'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'category_id' => 3,
            'stock' => 4,
            'price' => 10000,
            'image' => asset("images/polo-ralph-lauren-6182-3604731-1-zoom.jpg")
        ]);

        DB::table('Products')->insert([
            'sku' => $faker->randomNumber($nbDigits = 8, $strict = false),
            'name' => 'Pantalon polo',
            'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'category_id' => 3,
            'stock' => 10,
            'price' => 10000,
            'image' => asset("images/polo-ralph-lauren-7241-1817521-1-zoom.jpg")
        ]);

        DB::table('Products')->insert([
            'sku' => $faker->randomNumber($nbDigits = 8, $strict = false),
            'name' => 'Camisa Polo brand',
            'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'category_id' => 3,
            'stock' => 10,
            'price' => 10000,
            'image' => asset("images/polo-ralph-lauren-2162-8664421-1-zoom.jpg")
        ]);

        DB::table('Products')->insert([
            'sku' => $faker->randomNumber($nbDigits = 8, $strict = false),
            'name' => 'Blusa blanca',
            'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'category_id' => 4,
            'stock' => 10,
            'price' => 10000,
            'image' => asset("images/marketing-personal-5623-5506711-1-zoom.jpg")
        ]);

        DB::table('Products')->insert([
            'sku' => $faker->randomNumber($nbDigits = 8, $strict = false),
            'name' => 'Blusa amarilla',
            'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'category_id' => 4,
            'stock' => 10,
            'price' => 10000,
            'image' => asset("images/marketing-personal-5652-3061801-1-zoom.jpg")
        ]);

        DB::table('Products')->insert([
            'sku' => $faker->randomNumber($nbDigits = 8, $strict = false),
            'name' => 'Blusa rayas',
            'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'category_id' => 4,
            'stock' => 10,
            'price' => 10000,
            'image' => asset("images/marketing-personal-0903-5467351-1-zoom.jpg")
        ]);

        DB::table('Products')->insert([
            'sku' => $faker->randomNumber($nbDigits = 8, $strict = false),
            'name' => 'pantalon deportivo',
            'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'category_id' => 5,
            'stock' => 10,
            'price' => 10000,
            'image' => asset("images/tommy-hilfiger-kids-9919-4202541-1-zoom.jpg")
        ]);

        DB::table('Products')->insert([
            'sku' => $faker->randomNumber($nbDigits = 8, $strict = false),
            'name' => 'Camisa negra',
            'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'category_id' => 5,
            'stock' => 10,
            'price' => 10000,
            'image' => asset("images/tommy-hilfiger-kids-8660-4002541-1-zoom.jpg")
        ]);

        DB::table('Products')->insert([
            'sku' => $faker->randomNumber($nbDigits = 8, $strict = false),
            'name' => 'Camisa amarilla',
            'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'category_id' => 5,
            'stock' => 10,
            'price' => 10000,
            'image' => asset("images/tommy-hilfiger-kids-6187-3252541-1-zoom.jpg")
        ]);

        DB::table('Products')->insert([
            'sku' => $faker->randomNumber($nbDigits = 8, $strict = false),
            'name' => 'Overol rosado',
            'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'category_id' => 6,
            'stock' => 10,
            'price' => 10000,
            'image' => asset("images/marketing-personal-7472-5641221-1-zoom.jpg")
        ]);

        DB::table('Products')->insert([
            'sku' => $faker->randomNumber($nbDigits = 8, $strict = false),
            'name' => 'Vestido rosado',
            'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'category_id' => 6,
            'stock' => 10,
            'price' => 10000,
            'image' => asset("images/marketing-personal-5594-349078-1-zoom.jpg")
        ]);
    }
}
