<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Subject;

class SubjectPolicy
{
    public function update(User $user, Subject $subject)
    {
        return $user->id === $subject->created_by || $user->isAdmin();
    }

    public function delete(User $user, Subject $subject)
    {
        return $user->id === $subject->created_by || $user->isAdmin();
    }
}
