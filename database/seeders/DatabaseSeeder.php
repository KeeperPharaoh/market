<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\PickupOffice;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return  void
     */
    public function run()
    {
            Category::factory(20)->create();
            Product::factory(80)->create();
            User::factory(20)->create();
            PickupOffice::factory(10)->create();
            Order::factory(10)->create();
        }
}
