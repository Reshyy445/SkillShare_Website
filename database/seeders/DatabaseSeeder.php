<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\Subject;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@skillshare.nl',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        Profile::create([
            'user_id' => $admin->id,
            'education' => 'ICT',
            'level' => 'Bachelor',
            'school' => 'Hogeschool',
            'bio' => 'Platform beheerder',
        ]);

        // Create regular users
        $users = [];
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'name' => "Student {$i}",
                'email' => "student{$i}@skillshare.nl",
                'password' => Hash::make('student123'),
                'role' => 'user',
            ]);

            Profile::create([
                'user_id' => $user->id,
                'education' => ['ICT', 'Economie', 'Rechten', 'Geneeskunde', 'Psychologie'][$i-1],
                'level' => ['Bachelor', 'Master', 'Bachelor', 'Bachelor', 'Master'][$i-1],
                'school' => ['Hogeschool', 'Universiteit', 'Hogeschool', 'Universiteit', 'Universiteit'][$i-1],
                'bio' => "Student in {$this->getEducation($i)}",
            ]);

            $users[] = $user;
        }

        // Create subjects
        $subjects = ['Wiskunde', 'Programmeren', 'Economie', 'Natuurkunde', 'Engels'];
        foreach ($subjects as $index => $subjectName) {
            Subject::create([
                'name' => $subjectName,
                'education' => ['ICT', 'ICT', 'Economie', 'Natuurkunde', 'Talen'][$index],
                'level' => 'Bachelor',
                'created_by' => $users[$index % count($users)]->id,
            ]);
        }

        // Create posts
        $subjects = Subject::all();
        foreach ($subjects as $subject) {
            for ($i = 1; $i <= 3; $i++) {
                $post = Post::create([
                    'title' => "{$subject->name} - Uitleg {$i}",
                    'content' => "Dit is een uitgebreide uitleg over {$subject->name}. Hier wordt de stof duidelijk uitgelegd met voorbeelden.",
                    'type' => ['explanation', 'summary', 'blog'][$i % 3],
                    'user_id' => $users[$i % count($users)]->id,
                    'subject_id' => $subject->id,
                ]);

                // Create comments
                for ($j = 1; $j <= 2; $j++) {
                    Comment::create([
                        'content' => "Goede uitleg! Ik heb hier veel aan gehad. Bedankt!",
                        'user_id' => $users[($i + $j) % count($users)]->id,
                        'post_id' => $post->id,
                    ]);
                }
            }
        }
    }

    private function getEducation($index)
    {
        $educations = ['ICT', 'Economie', 'Rechten', 'Geneeskunde', 'Psychologie'];
        return $educations[$index-1] ?? 'Onderzoek';
    }
}
