<?php

namespace Aujicini\Moderation\Traits;

use Aujicini\Moderation\Events\Banned;
use Aujicini\Moderation\Events\Unbanned;

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
     * Can this user ip ban other user models.
     *
     * @return bool Returns true if this user can ip ban and false if not.
     */
    public function canIpBan()
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
        Banned::dispatch($this);
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
     * Can this user be ip banned by other user models.
     *
     * @return bool Returns true if this user can be ip banned and false if not.
     */
    public function ipBannable()
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
     * Check to see if the current user is ip banned.
     *
     * @return bool Returns true if the user is ip banned and false if not.
     */
    public function isIpBanned()
    {
        return $this->ipbanned;
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
        Unbanned::dispatch($this);
    }
}
