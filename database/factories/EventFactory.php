<?php

namespace Database\Factories;
use App\Models\Event;
use App\Models\Price;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->city().' Event',
            'date' => $this->faker->dateTimeBetween('2024-05-01', '+5 years')->format('Y-m-d'),
            'time' => $this->faker->time('H:i'),
            'description' => $this->faker->text,
            'location' => $this->faker->address,
            'price' => $this->faker->randomFloat(2, 30, 120),
        ];
    }
}
