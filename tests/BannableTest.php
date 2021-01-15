<?php

namespace Aujicini\Moderation\Test;

use Aujicini\Moderation\Events\Banned;
use Aujicini\Moderation\Events\Unbanned;
use Illuminate\Support\Facades\Event;

class BannableTest extends TestCase
{
    /**
     * @test
     */
    public function user_is_banned()
    {
        Event::fake();
        $user = User::find(1);
        $this->assertTrue($user->canBan());
        $this->assertTrue($user->bannable());
        $this->assertTrue($user->canIpBan());
        $this->assertTrue($user->ipBannable());
        $this->assertTrue(!$user->isBanned());
        $user->ban();
        Event::assertDispatched(Banned::class, function ($event) use ($user) {
            return $event->user === $user;
        });
        $this->assertTrue($user->isBanned());
        $user->unban();
        Event::assertDispatched(Unbanned::class, function ($event) use ($user) {
            return $event->user === $user;
        });
        $this->assertTrue(!$user->isBanned());
        $this->assertTrue(!$user->isIpBanned());
        $user->ban();
        Event::assertDispatched(Banned::class, function ($event) use ($user) {
            return $event->user === $user;
        });
        $this->assertTrue(!$user->isIpBanned());
        $user->unban();
        Event::assertDispatched(Unbanned::class, function ($event) use ($user) {
            return $event->user === $user;
        });
        $this->assertTrue(!$user->isIpBanned());
        $user->ban(true);
        Event::assertDispatched(Banned::class, function ($event) use ($user) {
            return $event->user === $user;
        });
        $this->assertTrue($user->isIpBanned());
        $user->unban();
        Event::assertDispatched(Unbanned::class, function ($event) use ($user) {
            return $event->user === $user;
        });
        $this->assertTrue(!$user->isIpBanned());
    }
}
