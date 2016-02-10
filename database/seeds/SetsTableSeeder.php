<?php

use Illuminate\Database\Seeder;

class SetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sets')->insert([
            'category_id' => 1,
            'name' => 'Sample Set',
            'description' => 'Lorem impsum mama papa alpha bravo charlie',
            'image' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
