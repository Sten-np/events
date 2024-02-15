<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Price;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Price>
 */
class PriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price' => $this->faker->numberBetween(30,120),
            'effdate' => Carbon::Today()->subDays(random_int(0, 365)),
            'event_id' => Event::all()->random()->id,

        ];
    }
}
