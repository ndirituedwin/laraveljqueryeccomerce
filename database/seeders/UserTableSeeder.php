<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'first_name'=>'edwin',
            'last_name'=>'ndiritu',
            'email'=>'edwinnderitu@gmail.com',
           'password'=>bcrypt('edwinnderitu@gmail.com'),
           'status'=>1,
           'google_id'=>'edwinnderitu@gmail.com'



        ]);
        User::create([
            'first_name'=>'pauline',
            'last_name'=>'wairimu',
            'email'=>'paulinewairimu@gmail.com',
            'password'=>bcrypt('paulinewairimu@gmail.com'),
            'status'=>1,
            'google_id'=>'paulinewairimu@gmail.com'


        ]);
        User::create([
            'first_name'=>'susan',
                'last_name'=>'muthoni',
                'email'=>'susanmuthoni@gmail.com',
                'password'=>bcrypt('susanmuthoni@gmail.com'),
                'status'=>1,
                'google_id'=>'susanmuthoni@gmail.com'

            ]);
    }
}
