<?php

namespace App\Policies;

use App\Todo;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return false;
    }

    public function view(User $user, Todo $todo)
    {
        return $user->id === $todo->user->id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Todo $todo)
    {
        if ($todo->created_at->diffInHours( now() ) >= 24)
            return false;

        return $user->id === $todo->user->id;
    }

    public function delete(User $user, Todo $todo)
    {
        return $user->id === $todo->user->id;
    }
}
