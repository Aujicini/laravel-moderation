<?php

namespace Aujicini\Moderation\Traits;

use Aujicini\Moderation\Models\Ipbans;
use Illuminate\Support\Facades\DB;

trait Bannable
{
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
     * Check to see if the current user is banned.
     *
     * @return bool Returns true if the user is banned and false if not.
     */
    public function isBanned()
    {
        return $this->banned
    }

    /**
     * Unban this current user.
     *
     * @param bool $ipBan Should we ip ban the user.
     *
     * @return void Returns nothing.
     */
    public function unban($ipBan = false)
    {
        if ($this->banned) {
            $this->banned = false;
            $this->save();
            if (DB::table('ipbans')->where('user_id', $this->id)->get())
                DB::table('ipbans')->where('user_id', $this->id)->delete()
        }
    }
}
