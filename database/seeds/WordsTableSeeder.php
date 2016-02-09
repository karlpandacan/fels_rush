<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class WordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data[] = [
            'category_id' => 1,
            'word_japanese' => 'Magandang Umaga',
            'word_vietnamese' => 'Good Morning',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'category_id' => 1,
            'word_japanese' => 'Magandang Gabi',
            'word_vietnamese' => 'Good Evening',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'category_id' => 1,
            'word_japanese' => 'Magandang Hapon',
            'word_vietnamese' => 'Good Afternoon',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'category_id' => 1,
            'word_japanese' => 'Pula',
            'word_vietnamese' => 'Red`',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $data[] = [
            'category_id' => 1,
            'word_japanese' => 'Dilaw',
            'word_vietnamese' => 'Yellow',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'category_id' => 1,
            'word_japanese' => 'Asul',
            'word_vietnamese' => 'Blue',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'category_id' => 1,
            'word_japanese' => 'Berde',
            'word_vietnamese' => 'Green',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'category_id' => 1,
            'word_japanese' => 'Pusa',
            'word_vietnamese' => 'Cat',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'category_id' => 1,
            'word_japanese' => 'Aso',
            'word_vietnamese' => 'Dog',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'category_id' => 1,
            'word_japanese' => 'Kalabaw',
            'word_vietnamese' => 'Carabao',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'category_id' => 1,
            'word_japanese' => 'Ahas',
            'word_vietnamese' => 'Snake',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'category_id' => 1,
            'word_japanese' => 'Unggoy',
            'word_vietnamese' => 'Monkey',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'category_id' => 1,
            'word_japanese' => 'Bukangliwayway',
            'word_vietnamese' => 'Sunrise',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'category_id' => 1,
            'word_japanese' => 'Takipsilim',
            'word_vietnamese' => 'Sunset',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'category_id' => 1,
            'word_japanese' => 'Bahaghari',
            'word_vietnamese' => 'Rainbow',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'category_id' => 1,
            'word_japanese' => 'Agila',
            'word_vietnamese' => 'Eagle',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'category_id' => 1,
            'word_japanese' => 'Bola',
            'word_vietnamese' => 'Ball',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'category_id' => 1,
            'word_japanese' => 'Eroplano',
            'word_vietnamese' => 'Airplane',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'category_id' => 1,
            'word_japanese' => 'Bahay',
            'word_vietnamese' => 'House',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'category_id' => 1,
            'word_japanese' => 'Singsing',
            'word_vietnamese' => 'Ring',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        DB::table('words')->insert($data);
    }
}
