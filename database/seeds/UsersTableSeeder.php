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
      DB::table('users')->insert([
          'identification' => '1013611324',
          'codeoyd' => '1',
          'email' => 'aacevedo@dayscript.com',
          'password' => bcrypt('p0p01234'),
      ]);
    }
}
