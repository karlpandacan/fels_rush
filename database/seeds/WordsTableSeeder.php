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
            'set_id' => 1,
            'word_original' => 'Magandang Umaga',
            'word_translated' => 'Good Morning',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'set_id' => 1,
            'word_original' => 'Magandang Gabi',
            'word_translated' => 'Good Evening',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'set_id' => 1,
            'word_original' => 'Magandang Hapon',
            'word_translated' => 'Good Afternoon',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'set_id' => 1,
            'word_original' => 'Pula',
            'word_translated' => 'Red`',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $data[] = [
            'set_id' => 1,
            'word_original' => 'Dilaw',
            'word_translated' => 'Yellow',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'set_id' => 1,
            'word_original' => 'Asul',
            'word_translated' => 'Blue',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'set_id' => 1,
            'word_original' => 'Berde',
            'word_translated' => 'Green',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'set_id' => 1,
            'word_original' => 'Pusa',
            'word_translated' => 'Cat',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'set_id' => 1,
            'word_original' => 'Aso',
            'word_translated' => 'Dog',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'set_id' => 1,
            'word_original' => 'Kalabaw',
            'word_translated' => 'Carabao',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'set_id' => 1,
            'word_original' => 'Ahas',
            'word_translated' => 'Snake',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'set_id' => 1,
            'word_original' => 'Unggoy',
            'word_translated' => 'Monkey',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'set_id' => 1,
            'word_original' => 'Bukangliwayway',
            'word_translated' => 'Sunrise',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'set_id' => 1,
            'word_original' => 'Takipsilim',
            'word_translated' => 'Sunset',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'set_id' => 1,
            'word_original' => 'Bahaghari',
            'word_translated' => 'Rainbow',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'set_id' => 1,
            'word_original' => 'Agila',
            'word_translated' => 'Eagle',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'set_id' => 1,
            'word_original' => 'Bola',
            'word_translated' => 'Ball',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'set_id' => 1,
            'word_original' => 'Eroplano',
            'word_translated' => 'Airplane',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'set_id' => 1,
            'word_original' => 'Bahay',
            'word_translated' => 'House',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'set_id' => 1,
            'word_original' => 'Singsing',
            'word_translated' => 'Ring',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        DB::table('words')->insert($data);
    }
}
