<?php

namespace Aujicini\Moderation\Tests;

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
    }
}
