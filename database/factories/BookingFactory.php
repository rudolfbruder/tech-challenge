<?php

namespace Database\Factories;

use App\Booking;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Booking>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = Carbon::make(fake()->dateTimeBetween('-1 year', '+1 year'));
        $end = $start->copy()->addMinutes(fake()->randomElement([15, 30, 45, 60, 75, 90]));

        return [
            'start' => $start,
            'end' => $end,
            'notes' => fake()->boolean(30) ? fake()->paragraphs(1, true) : '',
        ];
    }
}
