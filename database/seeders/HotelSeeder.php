<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        $hotels = [
            [
                'name' => 'Luxury Ocean Resort',
                'description' => 'Experience luxury living with breathtaking ocean views.',
                'location' => 'Miami Beach, FL',
                'price_per_night' => 299.99,
                'image' => 'img/watergate.png',
                'is_featured' => true,
                'amenities' => ['Pool', 'Spa', 'Restaurant', 'Beach Access', 'Gym'],
                'rating' => 4.8
            ],
            [
                'name' => 'Mountain View Lodge',
                'description' => 'Cozy mountain retreat with stunning panoramic views.',
                'location' => 'Aspen, CO',
                'price_per_night' => 199.99,
                'image' => 'img/inland.png',
                'is_featured' => true,
                'amenities' => ['Fireplace', 'Ski Storage', 'Hot Tub', 'Restaurant'],
                'rating' => 4.6
            ],
            [
                'name' => 'Urban Boutique Hotel',
                'description' => 'Modern boutique hotel in the heart of the city.',
                'location' => 'New York, NY',
                'price_per_night' => 249.99,
                'image' => 'img/oaisis.png',
                'is_featured' => true,
                'amenities' => ['Bar', 'Restaurant', 'Business Center', 'Gym'],
                'rating' => 4.5
            ]
        ];

        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
}
