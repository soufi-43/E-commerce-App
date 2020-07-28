<?php

use App\Address;
use App\Image;
use App\Product;
use App\User;
use Faker\Factory;
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
        factory(Address::class,1000)->create();
            factory(User::class,500)->create();
        factory(Product::class,1500)->create();
        factory(Image::class,3500)->create();

    }
}
