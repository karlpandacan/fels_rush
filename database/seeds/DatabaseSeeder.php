<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(SetsTableSeeder::class);
        $this->call(WordsTableSeeder::class);
        $this->call(FollowsTableSeeder::class);
        $this->call(StudiesTableSeeder::class);
    }
}
