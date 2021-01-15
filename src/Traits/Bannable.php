<?php

namespace Aujicini\Moderation\Traits;

trait Bannable
{
    /**
     * Can this user ban other user models.
     *
     * @return bool Returns true if this user can ban and false if not.
     */
    public function canBan()
    {
        return true;
    }

    /**
     * Ban this current user.
     *
     * @param bool $ipBan Should we ip ban the user.
     *
     * @return void Returns nothing.
     */
    public function ban($ipBan = false)
    {
        if (!$this->banned) {
            $this->banned = true;
            $this->ipbanned = $ipBan;
            $this->save();
        }
    }

    /**
     * Can this user be banned by other user models.
     *
     * @return bool Returns true if this user can be banned and false if not.
     */
    public function bannable()
    {
        return true;
    }

    /**
     * Check to see if the current user is banned.
     *
     * @return bool Returns true if the user is banned and false if not.
     */
    public function isBanned()
    {
        return $this->banned;
    }

    /**
     * Unban this current user.
     *
     * @return void Returns nothing.
     */
    public function unban()
    {
        if ($this->banned) {
            $this->banned = false;
            $this->ipbanned = false;
            $this->save();
        }
    }
}
