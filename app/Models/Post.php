<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'type',
        'user_id',
        'subject_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function bestComment()
    {
        return $this->belongsTo(Comment::class, 'best_comment_id');
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    public function getIsBookmarkedAttribute()
    {
        if (auth()->check()) {
            return $this->bookmarks()->where('user_id', auth()->id())->exists();
        }
        return false;
    }

    public function getIsLikedAttribute()
    {
        if (auth()->check()) {
            return $this->likes()->where('user_id', auth()->id())->exists();
        }
        return false;
    }
}
