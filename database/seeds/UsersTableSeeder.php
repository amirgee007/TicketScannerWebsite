<?php

/**
 * Created by PhpStorm.
 * User: frank
 * Date: 29/12/2016
 * Time: 22:07
 */
class UsersTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();
        User::create(array(
            'name'     => 'Chris Sevilleja',
            'email'    => 'frank@knarf.be',
            'password' => Hash::make('frank'),
        ));
    }

}