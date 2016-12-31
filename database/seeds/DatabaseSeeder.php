<?php

use App\User;
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
        //$this->call(UsersTableSeeder::class);
        $pdo = DB::connection()->getPdo();
        DB::table('events')->delete();
        DB::table('codes')->delete();
        DB::table('users')->delete();
        User::create(array(
            'name'     => 'Frank Meeusen',
            'email'    => 'frank@knarf.be',
            'password' => Hash::make('frank'),
            'api_token' => str_random(60),
        ));


        $result = DB::table('events')->insert(
            array('name' => 'Testevent', 'owner_id' => 1)
        );
        if ( $result )  {
            $rowId = $pdo->lastInsertId();
            DB::table('codes')->insert(
                array('event_id' => $rowId, 'code' => '123456789', 'state' => 'true')
            );
        }


    }
}
