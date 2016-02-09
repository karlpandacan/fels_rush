<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data[] = [
            'name' => 'Filipino-Enlgish',
            'description' => 'Basic Filipino words to Enlgish.',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'name' => 'Japanese-Enlgish',
            'description' => 'Basic Japanese words to Enlgish.',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        DB::table('categories')->insert($data);
    }
}
