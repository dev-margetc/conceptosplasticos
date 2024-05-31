<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Franchise>
 */
class FranchiseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company,
            'brand_logo' => $this->faker->imageUrl(640, 480, 'business'),
            'country' => $this->faker->country,
            'currency' => $this->faker->currencyCode,
            'identification' => $this->faker->uuid,
            'address' => $this->faker->address,
            'zip_code' => $this->faker->postcode,
            'contact_phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'website_url' => $this->faker->url
        ];
    }
}
