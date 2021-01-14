<?php

namespace Aujicini\Moderation\Traits;

use Aujicini\Moderation\Models\Ipbans;

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
            $this->save();
            if ($ipBan)
                Ipbans::create([
                    'user_id' => $this->id,
                    'ip'      => request()->ip(),
                ]);
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
     * Get the ipban associated with the user.
     *
     * @return mixed Returns the relationship.
     */
    public function ipban()
    {
        return $this->hasOne(Ipbans::class);
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
            $this->save();
            if ($ipBan = $this->ipban())
                $ipBan->delete();
        }
    }
}
