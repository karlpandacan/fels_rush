<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $data[] = [
            'name' => 'Kenji',
            'email' => 'kenji@doe.com',
            'password' => bcrypt('admin001'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $data[] = [
            'name' => 'Kevin',
            'email' => 'kevin@doe.com',
            'password' => bcrypt('admin001'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $data[] = [
            'name' => 'John',
            'email' => 'john@doe.com',
            'password' => bcrypt('admin001'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $data[] = [
            'name' => 'Mark',
            'email' => 'mark@doe.com',
            'password' => bcrypt('admin001'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $data[] = [
            'name' => 'Sofia',
            'email' => 'sofia@doe.com',
            'password' => bcrypt('admin001'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $data[] = [
            'name' => 'Dora',
            'email' => 'Dora@doe.com',
            'password' => bcrypt('admin001'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $data[] = [
            'name' => 'Anna',
            'email' => 'Anna@doe.com',
            'password' => bcrypt('admin001'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $data[] = [
            'name' => 'Lorna',
            'email' => 'Lorna@doe.com',
            'password' => bcrypt('admin001'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $data[] = [
            'name' => 'Martin',
            'email' => 'martin@doe.com',
            'password' => bcrypt('admin001'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $data[] = [
            'name' => 'Erika',
            'email' => 'erika@doe.com',
            'password' => bcrypt('admin001'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $data[] = [
            'name' => 'Betty',
            'email' => 'betty@doe.com',
            'password' => bcrypt('admin001'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $data[] = [
            'name' => 'Zander',
            'email' => 'zander@doe.com',
            'password' => bcrypt('admin001'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        DB::table('users')->insert($data);
    }
}
