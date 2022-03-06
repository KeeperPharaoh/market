<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\PickupOffice;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Contracts\OrderContract;
use App\Domain\Contracts\PickupOfficeContract;

class PickupOfficeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var  string
     */
    protected $model = PickupOffice::class;

    /**
     * Define the model's default state.
     *
     * @return  array
     */
    public function definition(): array
    {
        return [
            PickupOfficeContract::OFFICE => $this->faker->name()
        ];
    }
}
