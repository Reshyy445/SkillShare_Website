<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomepageController;
use App\Models\Post;
use App\Models\Subject;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Public Routes (Geen login vereist)
|--------------------------------------------------------------------------
*/

// Homepage met data
Route::get('/', function () {
    // Haal de statistieken op met fallback waarden
    $stats = [
        'daily_active' => User::whereDate('last_login_at', today())->count() ?: 42,
        'weekly_active' => User::where('last_login_at', '>=', now()->subDays(7))->count() ?: 156,
        'subjects' => Subject::count() ?: 12,
        'posts' => Post::count() ?: 89,
    ];

    // Nieuws items met fallback
    try {
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
    } catch (\Exception $e) {
        $news = [
            [
                'title' => 'Welkom bij SkillShare!',
                'date' => date('d-m-Y'),
                'excerpt' => 'Start met het delen van kennis en het helpen van andere studenten vandaag nog!'
            ]
        ];
    }

    return view('homepage.index', compact('stats', 'news'));
})->name('home');

// Overige publieke pagina's
Route::view('/about', 'homepage.about')->name('about');
Route::view('/contact', 'homepage.contact')->name('contact');

// News pagina met data
Route::get('/news', function () {
    $news = [
        [
            'title' => 'SkillShare is gelanceerd!',
            'date' => '30 juni 2026',
            'excerpt' => 'We zijn blij om te kunnen aankondigen dat SkillShare officieel is gelanceerd!',
            'content' => 'Na maanden van ontwikkeling zijn we trots om SkillShare aan de wereld te presenteren. Ons platform is ontworpen om studenten te verbinden en kennisuitwisseling te bevorderen.'
        ],
        [
            'title' => 'Nieuwe vakken toegevoegd',
            'date' => '28 juni 2026',
            'excerpt' => 'We hebben nieuwe vakken toegevoegd aan het platform.',
            'content' => 'Op verzoek van onze gebruikers hebben we nieuwe vakken toegevoegd. Studenten kunnen nu bijdragen aan Wiskunde, Programmeren, Economie, Natuurkunde en Engels.'
        ],
        [
            'title' => 'Community groeit snel',
            'date' => '25 juni 2026',
            'excerpt' => 'De SkillShare community groeit snel!',
            'content' => 'In slechts een week tijd heeft SkillShare al meer dan 50 actieve studenten verwelkomd.'
        ]
    ];
    return view('homepage.news', compact('news'));
})->name('news');

// Openbare gebruikersprofielen (geen login vereist)
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

// Leaderboard (geen login vereist)
Route::get('/leaderboard', [UserController::class, 'leaderboard'])->name('leaderboard');

// Achievements overzicht (geen login vereist)
Route::get('/achievements', [AchievementController::class, 'index'])->name('achievements.index');

// Zoek functionaliteit (geen login vereist)
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Post detail (geen login vereist)
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

/*
|--------------------------------------------------------------------------
| Authenticatie Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Routes (Alleen voor ingelogde gebruikers)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
    });

    // Subject routes
    Route::resource('subjects', SubjectController::class)->except(['show']);
    Route::get('/subjects/{subject}', [SubjectController::class, 'show'])->name('subjects.show');

    // Post routes
    Route::prefix('subjects/{subject}')->group(function () {
        Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    });

    Route::prefix('posts')->group(function () {
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
        Route::post('/{post}/best-answer/{comment}', [PostController::class, 'markBestAnswer'])->name('posts.best-answer');
    });

    // Comment routes
    Route::prefix('comments')->group(function () {
        Route::get('/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
        Route::put('/{comment}', [CommentController::class, 'update'])->name('comments.update');
        Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    });

    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Message routes
    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('index');
        Route::get('/create', [MessageController::class, 'create'])->name('create');
        Route::post('/', [MessageController::class, 'store'])->name('store');
        Route::get('/{message}', [MessageController::class, 'show'])->name('show');
        Route::delete('/{message}', [MessageController::class, 'destroy'])->name('destroy');
    });

    // Bookmark routes
    Route::prefix('bookmarks')->name('bookmarks.')->group(function () {
        Route::get('/', [BookmarkController::class, 'index'])->name('index');
        Route::post('/{post}/toggle', [BookmarkController::class, 'toggle'])->name('toggle');
    });

    // Like routes (AJAX)
    Route::post('/posts/{post}/like', [LikeController::class, 'togglePost'])->name('posts.like');
    Route::post('/comments/{comment}/like', [LikeController::class, 'toggleComment'])->name('comments.like');

    // Achievement routes (extra)
    Route::get('/my-achievements', [AchievementController::class, 'userAchievements'])->name('my-achievements');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Alleen voor admins)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // User management
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');

    // Post management
    Route::get('/posts', [AdminController::class, 'posts'])->name('posts');
    Route::delete('/posts/{post}', [AdminController::class, 'destroyPost'])->name('posts.destroy');

    // Subject management
    Route::get('/subjects', [AdminController::class, 'subjects'])->name('subjects');
    Route::delete('/subjects/{subject}', [AdminController::class, 'destroySubject'])->name('subjects.destroy');

    // Comment management
    Route::get('/comments', [AdminController::class, 'comments'])->name('comments');
    Route::delete('/comments/{comment}', [AdminController::class, 'destroyComment'])->name('comments.destroy');
});

/*
|--------------------------------------------------------------------------
| Fallback Route (404 pagina)
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return view('errors.404');
});
