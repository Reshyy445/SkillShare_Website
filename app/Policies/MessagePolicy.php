<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Message;

class MessagePolicy
{
    public function delete(User $user, Message $message)
    {
        return $user->id === $message->sender_id || $user->isAdmin();
    }
}
