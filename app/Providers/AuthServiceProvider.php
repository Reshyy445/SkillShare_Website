// app/Providers/AuthServiceProvider.php

use App\Models\Subject;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Message;
use App\Policies\SubjectPolicy;
use App\Policies\PostPolicy;
use App\Policies\CommentPolicy;
use App\Policies\MessagePolicy;

protected $policies = [
Subject::class => SubjectPolicy::class,
Post::class => PostPolicy::class,
Comment::class => CommentPolicy::class,
Message::class => MessagePolicy::class,
];
