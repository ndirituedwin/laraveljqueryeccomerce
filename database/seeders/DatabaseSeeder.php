<?php

namespace Database\Seeders;

use App\Models\Productattribute;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
  // $this->call(UserTableSeeder::class);
    //$this->call(AdminsTableSeeder::class);
    //  $this->call(SectionTableSeeder::class);
    //$this->call(CategoryTableSeeder::class);
    //$this->call(ProductTableseeder::class);
  //  $this->call(ProductTableseeder::class);
  //$this->call(Productattributetableseeder::class);
 // $this->call(Productimageseeder::class);
  //$this->call(brandtableseeder::class);
  //$this->call(BannersTableseeder::class);
 // $this->call(coupontableseeder::class);
 //$this->call(DeliveryAddressSeeder::class);
 $this->call(UserTableSeeder::class);

       
    }
}
