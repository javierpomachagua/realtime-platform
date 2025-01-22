<?php

namespace Database\Factories;

use App\Enums\AuctionStatus;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Auction>
 */
class AuctionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startingPrice = $this->faker->randomFloat(2, 1, 1000);

        return [
            'item_id' => Item::factory(),
            'status' => AuctionStatus::Pending,
            'start_time' => $this->faker->dateTimeBetween('now', '+1 week'),
            'end_time' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
            'starting_price' => $startingPrice,
            'current_price' => $startingPrice,
        ];
    }
}
