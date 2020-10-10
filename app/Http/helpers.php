<?php

function user($p = null)
{
    $user = auth()->user();
    return $user ? ($p ? $user->$p : $user) : null;
}
