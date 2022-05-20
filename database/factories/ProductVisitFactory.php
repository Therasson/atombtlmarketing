<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Visit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVisit>
 */
class ProductVisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'visit_id' => Visit::all()->random()->id,
            'product_id' => Product::all()->random()->id,
            'quantity' => $this->faker->numerify(2)
        ];
    }
}
