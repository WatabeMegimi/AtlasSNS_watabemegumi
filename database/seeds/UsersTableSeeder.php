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
        //
        DB::table('username')->insert([
            [
                'username' => 'わたべ',
                'mail' => 'momoumai@gmail.com',
                'password' => bcrypt('watabe1122')
            ],
        ]);
}

}
