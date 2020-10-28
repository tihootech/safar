<?php

function user($p = null)
{
    $user = auth()->user();
    return $user ? ($p ? $user->$p : $user) : null;
}

function currentAgency()
{
    $user = auth()->user();
    if ($user->isManager() || $user->isCounseler()) {
        $employee = App\Models\Employee::where('user_id', $user->id)->firstOrFail();
        return $employee->agency;
    }
}

function checkIfManagerHasAccessToThisUser($user)
{
    if (user()->isManager()) {
        $agency = currentAgency();
        $employee = App\Models\Employee::where('user_id', $user->id)->firstOrFail();
        if ($employee->agency_id != $agency->id) {
            abort(403);
        }
    }
}
