<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\PickupOffice;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Contracts\OrderContract;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var  string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return  array
     */
    public function definition(): array
    {
        return array(
            OrderContract::USER_ID =>  User::inRandomOrder()->first() ? User::inRandomOrder()->first()->id : null,
            OrderContract::NAME =>  $this->faker->name(),
            OrderContract::SURNAME =>  $this->faker->name(),
            OrderContract::EMAIL =>  $this->faker->email(),
            OrderContract::PHONE =>  $this->faker->phoneNumber,
            OrderContract::COMMENT =>  $this->faker->text,
            OrderContract::STREET =>  $this->faker->name(),
            OrderContract::HOME =>  $this->faker->name(),
            OrderContract::APARTMENT =>  $this->faker->name(),
            OrderContract::ENTRANCE =>  $this->faker->name(),
            OrderContract::FLOOR =>  $this->faker->name(),
            OrderContract::OFFICE =>  PickupOffice::inRandomOrder()->first() ? PickupOffice::inRandomOrder()->first()->id : null,
            OrderContract::PAYMENT_ID =>  $this->faker->name(),
            OrderContract::PAYMENT_STATUS =>  $this->faker->name(),
            OrderContract::SUM =>  $this->faker->numberBetween(1000,100000),
        );
    }
}
