<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data[] = [
            'name' => 'Admin',
            'email' => 'admin@doe.com',
            'password' => bcrypt('admin001'),
            'type' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'name' => 'Jason',
            'email' => 'jason@doe.com',
            'password' => bcrypt('admin001'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'name' => 'Karl',
            'email' => 'karl@doe.com',
            'password' => bcrypt('admin001'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'name' => 'Grace',
            'email' => 'grace@doe.com',
            'password' => bcrypt('admin001'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'name' => 'Chris',
            'email' => 'chris@doe.com',
            'password' => bcrypt('admin001'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'name' => 'Allan',
            'email' => 'allan@doe.com',
            'password' => bcrypt('admin001'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'name' => 'Ronald',
            'email' => 'ronald@doe.com',
            'password' => bcrypt('admin001'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'name' => 'Lyle',
            'email' => 'lyle@doe.com',
            'password' => bcrypt('admin001'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $data[] = [
            'name' => 'Kazunari',
            'email' => 'kazunari@doe.com',
            'password' => bcrypt('admin001'),
            'type' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        DB::table('users')->insert($data);
    }
}
