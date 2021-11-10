<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminrecords=[
            [

                'name'=>'edwin',
                'type'=>'admin',
                'mobile'=>'0799149758',
                'email'=>'ndiritu.edwin018@gmail.com',
                'image'=>'',
                'status'=>0,
                'password'=>bcrypt('123456'),
            ],
            [
                'name'=>'apollo',
                'type'=>'secretary',
                'mobile'=>'0789149758',
                'email'=>'ndiritu.apollo018@gmail.com',
                'image'=>'',
                'status'=>0,
                'password'=>bcrypt('ndiritu.apollo018@gmail.com'),
            ]

      ];
      foreach($adminrecords as $record){
                 Admin::create($record);
      }
    }
}