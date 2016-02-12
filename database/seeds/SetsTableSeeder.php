<?php

use Illuminate\Database\Seeder;
use App\Models\Set;
class SetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $faker = Faker\Factory::create();
        for ($x = 2 ; $x <= 21 ; $x++) {
            for ($y = 1 ; $y <= 5 ; $y++) {
                $data = [
                    'category_id' => rand(1, 6),
                    'visible_to' => 'public',
                    'user_id' => $x,
                    'recommended' => rand(0, 1),
                    'name' => $faker->country.' Language',
                    'description' => $faker->paragraph(3),
                    'image' => null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $id = Set::create($data)->id;
                for($z = 1 ; $z <= 15 ; $z++){
                    $data2 = [
                        'set_id' => $id,
                        'word_original' => $faker->word,
                        'word_translated' => $faker->word,
                        'sound_file' => null,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    DB::table('words')->insert($data2);
                }
            }
        }
    }
}
