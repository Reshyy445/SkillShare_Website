<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Subject;
use App\Models\User;

class HomepageController extends Controller
{
    public function index()
    {
        // Statistieken
        $stats = [
            'daily_active' => User::whereDate('last_login_at', today())->count() ?: 42,
            'weekly_active' => User::where('last_login_at', '>=', now()->subDays(7))->count() ?: 156,
            'subjects' => Subject::count() ?: 12,
            'posts' => Post::count() ?: 89,
        ];

        // Nieuws items
        $news = [
            [
                'title' => 'SkillShare is gelanceerd!',
                'date' => '30 juni 2026',
                'excerpt' => 'We zijn blij om te kunnen aankondigen dat SkillShare officieel is gelanceerd! Studenten kunnen nu kennis delen en samenwerken op ons platform.'
            ],
            [
                'title' => 'Nieuwe vakken toegevoegd',
                'date' => '28 juni 2026',
                'excerpt' => 'We hebben nieuwe vakken toegevoegd aan het platform, waaronder Wiskunde, Programmeren en Economie.'
            ],
            [
                'title' => 'Community groeit snel',
                'date' => '25 juni 2026',
                'excerpt' => 'De SkillShare community groeit snel! We hebben al meer dan 50 studenten die dagelijks kennis delen.'
            ]
        ];

        return view('homepage.index', compact('stats', 'news'));
    }

    public function about()
    {
        return view('homepage.about');
    }

    public function contact()
    {
        return view('homepage.contact');
    }

    public function news()
    {
        $news = [
            [
                'title' => 'SkillShare is gelanceerd!',
                'date' => '30 juni 2026',
                'excerpt' => 'We zijn blij om te kunnen aankondigen dat SkillShare officieel is gelanceerd! Studenten kunnen nu kennis delen en samenwerken op ons platform.',
                'content' => 'Na maanden van ontwikkeling zijn we trots om SkillShare aan de wereld te presenteren. Ons platform is ontworpen om studenten te verbinden en kennisuitwisseling te bevorderen. Met functies zoals berichten plaatsen, reacties en privéberichten, kunnen studenten nu gemakkelijk samenwerken aan hun studie.'
            ],
            [
                'title' => 'Nieuwe vakken toegevoegd',
                'date' => '28 juni 2026',
                'excerpt' => 'We hebben nieuwe vakken toegevoegd aan het platform, waaronder Wiskunde, Programmeren en Economie.',
                'content' => 'Op verzoek van onze gebruikers hebben we nieuwe vakken toegevoegd. Studenten kunnen nu bijdragen aan Wiskunde, Programmeren, Economie, Natuurkunde en Engels. We blijven nieuwe vakken toevoegen op basis van feedback van de community.'
            ],
            [
                'title' => 'Community groeit snel',
                'date' => '25 juni 2026',
                'excerpt' => 'De SkillShare community groeit snel! We hebben al meer dan 50 studenten die dagelijks kennis delen.',
                'content' => 'In slechts een week tijd heeft SkillShare al meer dan 50 actieve studenten verwelkomd. Met dagelijks nieuwe berichten en reacties, groeit onze community snel. Bedankt aan iedereen die bijdraagt aan het delen van kennis!'
            ]
        ];

        return view('homepage.news', compact('news'));
    }
}
