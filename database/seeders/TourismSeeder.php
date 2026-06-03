<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use App\Models\SurveyQuestion;
use App\Models\ActivityLog;

class TourismSeeder extends Seeder
{
    public function run(): void
    {
        Destination::insert([
            [
                'name' => 'San Pablo Island (Pong Dako)',
                'category' => 'Island',
                'description' => 'The larger twin island of Hinunangan with clear waters, reefs, palms, and white sand.',
                'location' => 'Brgy. San Pablo, Hinunangan',
                'average_rating' => 4.8,
                'total_reviews' => 6,
            ],
            [
                'name' => 'San Pedro Island (Pong Gamay)',
                'category' => 'Island',
                'description' => 'A peaceful smaller island known for white beach, coconut trails, and snorkeling.',
                'location' => 'Brgy. San Pedro, Hinunangan',
                'average_rating' => 4.7,
                'total_reviews' => 4,
            ],
            [
                'name' => 'Tahusan Beach',
                'category' => 'Beach',
                'description' => 'Surfing beach with cream-colored sand, waves, huts, and sunset views.',
                'location' => 'Brgy. Tahusan, Hinunangan',
                'average_rating' => 4.5,
                'total_reviews' => 5,
            ],
            [
                'name' => 'Biasong Spring',
                'category' => 'Spring',
                'description' => 'Cold freshwater spring beside the shoreline.',
                'location' => 'Brgy. Biasong, Hinunangan',
                'average_rating' => 4.3,
                'total_reviews' => 3,
            ],
        ]);

        SurveyQuestion::insert([
            ['text' => 'How would you rate the environmental cleanliness and waste management of the site?', 'category' => 'Cleanliness', 'type' => 'rating', 'is_active' => true],
            ['text' => 'How satisfied are you with the hospitality and helpfulness of locals and tourism personnel?', 'category' => 'Hospitality', 'type' => 'rating', 'is_active' => true],
            ['text' => 'Are safety signage and emergency assistance accessible?', 'category' => 'Safety', 'type' => 'rating', 'is_active' => true],
            ['text' => 'How accessible was the destination in terms of roads, transport, and signage?', 'category' => 'Accessibility', 'type' => 'rating', 'is_active' => true],
            ['text' => 'Would you visit this destination again or recommend it?', 'category' => 'Attraction Quality', 'type' => 'yes_no', 'is_active' => true],
            ['text' => 'Please share additional feedback or recommendations.', 'category' => 'Attraction Quality', 'type' => 'text', 'is_active' => true],
        ]);

        ActivityLog::create([
            'user_role' => 'Admin',
            'actor_name' => 'System',
            'action' => 'Database Seeded',
            'details' => 'Default Hinunangan tourism data loaded.',
        ]);
    }
}