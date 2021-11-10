<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectiontableseeder=[
            [
                'admin_id'=>1,
                'section'=>'Men',
                'slug'=>Str::slug('name'),
                'status'=>1
            ],
            [
                'admin_id'=>2,
                'section'=>'Women',
                'slug'=>Str::slug('women'),
                'status'=>1
            ],
            [
                'admin_id'=>1,
                'section'=>'Kids',
                'slug'=>Str::slug('Kids'),
                'status'=>1
            ],

        ];
        foreach($sectiontableseeder as $seeder){
            Section::create($seeder);
        }
    }
}
