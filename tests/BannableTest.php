<?php

namespace Aujicini\Moderation\Test;

class BannableTest extends TestCase
{
    /**
     * @test
     */
    public function user_is_banned()
    {
        $user = User::find(1);
        $this->assertTrue($user->canBan());
        $this->assertTrue($user->bannable());
        $this->assertTrue(!$user->isBanned());
        $user->ban();
        $this->assertTrue($user->isBanned());
        $user->unban();
        $this->assertTrue(!$user->isBanned());
        $this->assertTrue(!$user->ipbanned);
        $user->ban();
        $this->assertTrue(!$user->ipbanned);
        $user->unban();
        $this->assertTrue(!$user->ipbanned);
        $user->ban(true);
        $this->assertTrue($user->ipbanned);
        $user->unban();
        $this->assertTrue(!$user->ipbanned);
    }
}
