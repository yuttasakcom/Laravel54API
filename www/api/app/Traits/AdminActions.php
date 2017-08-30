<?php

namespace App\Traits;

trait AdminActions
{
    public function before($user, $ablility)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
}