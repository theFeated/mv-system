<?php

namespace Database\Factories;

use App\Models\College;
use App\Models\Researcher;
use App\Models\Agency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Research>
 */
class ResearchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'collegeID' => College::all()->random()->id,
            'researcherID' => Researcher::all()->random()->id,
            'agencyID' => Agency::all()->random()->id,
            'status' => $this->faker->randomElement(['ongoing', 'completed']),
            'researchTitle' => $this->faker->sentence,
            'researchType' => $this->faker->randomElement(['basic', 'applied', 'developmental']),
            'startDate' => $this->faker->date,
            'endDate' => $this->faker->date,
            'link_1' => $this->faker->url,
            'link_2' => $this->faker->url,
            'link_3' => $this->faker->url,
            'extension' => $this->faker->boolean,
            'isInternalFund' => $this->faker->boolean,
        ];
    }
}