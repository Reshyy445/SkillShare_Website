<?php
// app/Providers/AuthServiceProvider.php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Subject;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Message;
use App\Policies\SubjectPolicy;
use App\Policies\PostPolicy;
use App\Policies\CommentPolicy;
use App\Policies\MessagePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Subject::class => SubjectPolicy::class,
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class,
        Message::class => MessagePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Optioneel: Extra Gates voor admin checks
        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });
    }
}
