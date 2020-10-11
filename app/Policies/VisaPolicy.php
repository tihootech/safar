<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Visa;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisaPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        return $user->isAdmin();
    }

    public function manage(User $user)
    {
        return $user->isAdmin();
    }

}
