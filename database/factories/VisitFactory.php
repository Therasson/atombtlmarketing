<?php

namespace Database\Factories;

use App\Models\Pos;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visit>
 */
class VisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pos_id'=> Pos::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'longitude' => $this->faker->longitude($min = -180, $max = 180),
            'latitude' => $this->faker->latitude($min = -90, $max = 90),
            'visit_date_time' => $this->faker->dateTime,
            'visibility'=> $this->faker->numberBetween(1,10),
            'disponibility' => $this->faker->numberBetween(1,10),
            'part_shelf' => $this->faker->numberBetween(10,130),
            'respect_price' => $this->faker->boolean(),
            'etat' => 1
        ];
    }
}
