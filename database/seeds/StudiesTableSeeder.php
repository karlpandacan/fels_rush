<?php

use Illuminate\Database\Seeder;

class StudiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 2; $x <= 21; $x++) {
            $usedArr = [];
            for ($y = 1; $y <= 10; $y++) {
                do {
                    $id = rand(1, 100);
                } while (in_array($id, $usedArr));
                $usedArr[] = $id;
                $data[] = [
                    'user_id' => $x,
                    'set_id' => $id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
        }

        DB::table('studies')->insert($data);
    }
}
