<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Achievement;

class AchievementSeeder extends Seeder
{
    public function run()
    {
        $achievements = [
            [
                'name' => 'First Post',
                'slug' => 'first-post',
                'description' => 'Plaats je eerste post op SkillShare',
                'icon' => 'fa-solid fa-pen',
                'points' => 10,
            ],
            [
                'name' => 'Helpful Student',
                'slug' => 'helpful-student',
                'description' => 'Ontvang 10 likes op je posts',
                'icon' => 'fa-solid fa-heart',
                'points' => 25,
            ],
            [
                'name' => 'Top Contributor',
                'slug' => 'top-contributor',
                'description' => 'Plaats 5 posts en 10 reacties',
                'icon' => 'fa-solid fa-crown',
                'points' => 50,
            ],
            [
                'name' => 'Help 10 Students',
                'slug' => 'help-10-students',
                'description' => 'Plaats 10 reacties op posts van anderen',
                'icon' => 'fa-solid fa-hand-holding-heart',
                'points' => 30,
            ],
            [
                'name' => 'Knowledge Sharer',
                'slug' => 'knowledge-sharer',
                'description' => 'Plaats 3 verschillende posts',
                'icon' => 'fa-solid fa-graduation-cap',
                'points' => 20,
            ],
        ];

        foreach ($achievements as $achievement) {
            Achievement::create($achievement);
        }
    }
}
