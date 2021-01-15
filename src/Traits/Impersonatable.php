<?php

namespace Aujicini\Moderation\Traits;

trait Impersonatable
{
    /**
     * Can this user ban other user models.
     *
     * @return bool Returns true if this user can ban and false if not.
     */
    public function canImpersonate()
    {
        return true;
    }

    /**
     * Can this user be impersonated.
     *
     * @return bool Returns true if this user can ip ban and false if not.
     */
    public function canBeImpersonated()
    {
        return true;
    }
}
