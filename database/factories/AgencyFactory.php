<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agency>
 */
class AgencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'agencyName' => $this->faker->company,
            'contactPerson' => $this->faker->name,
            'address' => $this->faker->address,
            'telNum' => $this->faker->phoneNumber,
        ];
    }
}
