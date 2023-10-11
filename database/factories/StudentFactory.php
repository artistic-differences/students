<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $relationships = ['father', 'mother', 'guardian', 'grandparent'];
        $yearIds = \App\Models\YearGroup::pluck('id')->toArray();
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'mobile' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'post_code' => $this->faker->postcode(),
            'contact1_relationship' => $this->faker->randomElement($relationships),
            'contact1_name' => $this->faker->name(),
            'contact1_email' => $this->faker->unique()->safeEmail(),
            'contact1_mobile' => $this->faker->phoneNumber(),
            'contact2_relationship' => $this->faker->randomElement($relationships),
            'contact2_name' => $this->faker->name(),
            'contact2_email' => $this->faker->unique()->safeEmail(),
            'contact2_mobile' => $this->faker->phoneNumber(),
            'year_group_id' => $this->faker->randomElement($yearIds),
        ];
    }
}
