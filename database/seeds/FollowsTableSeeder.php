<?php

use Illuminate\Database\Seeder;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 2 ; $x <= 21 ; $x++) {
            $usedArr = [];
            for ($y = 1 ; $y <= 10 ; $y++) {
                do {
                    $id = rand(1, 21);
                } while($id == $x or in_array($id, $usedArr));
                $usedArr[] = $id;
                $data[] = [
                    'followee_id' => $x,
                    'follower_id' => $id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
        }

        DB::table('follows')->insert($data);
    }
}
