<?php

namespace Database\Factories;

use App\Models\Routing;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pos>
 */
class PosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sector_id' => Sector::all()->random()->id,
            'routing_id' => Routing::all()->random()->id,
            'manager_name' => $this->faker->name,
            'manager_contact' => $this->faker->phoneNumber,
            'pos_type' => $this->faker->name,
            'plv'=> $this->faker->name,
            'note' => $this->faker->paragraphs(3, true),
            'etat' => 1
        ];
    }
}
