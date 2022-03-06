<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Contracts\ProductContract;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var  string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return  array
     */
    public function definition(): array
    {
        return [
            ProductContract::CATEGORY_ID =>  Category::inRandomOrder()->first() ? Category::inRandomOrder()->first()->id : null,
            ProductContract::TITLE =>  $this->faker->title(),
            ProductContract::DESCRIPTION =>  $this->faker->text,
            ProductContract::PRICE =>  $this->faker->numberBetween(1000,100000),
            ProductContract::OLD_PRICE =>  $this->faker->numberBetween(1000,100000),
            ProductContract::IS_HIT =>  $this->faker->boolean,
            ProductContract::IS_LATEST =>  $this->faker->boolean,
        ];
    }
}
