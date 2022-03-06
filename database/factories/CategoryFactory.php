<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Contracts\CategoryContract;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var  string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return  array
     */
    public function definition(): array
    {
        return [
            CategoryContract::PARENT_ID =>  Category::inRandomOrder()->first() ? Category::inRandomOrder()->first()->id : null,
            CategoryContract::TITLE =>  $this->faker->title(),
            CategoryContract::IMAGE =>  $this->faker->imageUrl(640, 480),
        ];
    }
}
