<?php

namespace Aujicini\Moderation;

trait Bannable
{
    /**
     * Check to see if the current user is banned.
     *
     * @return bool
     */
    public function isBanned()
    {
        return $this->banned
    }
}
