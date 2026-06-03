<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Destination;
use App\Models\SurveyQuestion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Director Rose ann Sumacot',
            'email' => 'dir.roseann@leyte.gov.ph',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'Admin',
        ]);

        User::create([
            'name' => 'Staff Assist: Joven R.',
            'email' => 'staff.joven@leyte.gov.ph',
            'username' => 'staff',
            'password' => Hash::make('staff123'),
            'role' => 'Staff',
        ]);

        $destinations = [
            ['San Pablo Island (Pong Dako)', 'Island', 'The larger twin island of Hinunangan with clear waters, reefs, palms, and white sand.', 'Brgy. San Pablo, Hinunangan'],
            ['San Pedro Island (Pong Gamay)', 'Island', 'The smaller twin island known for peaceful beach views and snorkeling spots.', 'Brgy. San Pedro, Hinunangan'],
            ['Tahusan Beach', 'Beach', 'A scenic beach destination popular for surfing, relaxing, and sunset viewing.', 'Brgy. Tahusan, Hinunangan'],
            ['Biasong Spring', 'Spring', 'A cold freshwater spring near the shoreline, perfect for swimming and family trips.', 'Brgy. Biasong, Hinunangan'],
            ['Talisay Beach', 'Beach', 'A quiet coastal retreat with calm waters and shaded picnic areas.', 'Brgy. Talisay, Hinunangan'],
            ['Town Plaza & Heritage Church', 'Heritage', 'The cultural center of Hinunangan featuring the town plaza and heritage church area.', 'Poblacion, Hinunangan'],
        ];

        foreach ($destinations as $d) {
            Destination::create([
                'name' => $d[0],
                'category' => $d[1],
                'description' => $d[2],
                'location' => $d[3],
                'average_rating' => 0,
                'total_reviews' => 0,
            ]);
        }

        $questions = [
            ['How would you rate the environmental cleanliness and waste management of the site?', 'Cleanliness', 'rating'],
            ['How satisfied are you with the hospitality and helpfulness of locals and tourism personnel?', 'Hospitality', 'rating'],
            ['Are tourist assistance, safety signage, and emergency responders easily accessible?', 'Safety', 'rating'],
            ['How accessible was the destination in terms of roads, transport, and signage?', 'Accessibility', 'rating'],
            ['How well did the destination scenery and natural features meet your expectations?', 'Attraction Quality', 'rating'],
            ['Would you visit this destination again or recommend it to other tourists?', 'Attraction Quality', 'yes_no'],
            ['Please share additional feedback or recommendations.', 'Attraction Quality', 'text'],
        ];

        foreach ($questions as $q) {
            SurveyQuestion::create([
                'text' => $q[0],
                'category' => $q[1],
                'type' => $q[2],
                'is_active' => true,
            ]);
        }
    }
}