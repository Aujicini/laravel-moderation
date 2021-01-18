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
        $this->assertTrue($user->canBan($user));
        $this->assertTrue($user->bannable($user));
        $this->assertTrue($user->canIpBan($user));
        $this->assertTrue($user->ipBannable($user));
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
        $response = $this->call('GET', '/moderation/ban/1');
        var_dump($response);
        $this->assertEquals(200, $response->status());
        $this->assertTrue($user->isBanned());
        $response = $this->call('GET', '/moderation/unban/1');
        var_dump($response);
        $this->assertEquals(200, $response->status());
        $this->assertTrue(!$user->isBanned());
        $response = $this->call('GET', '/moderation/ipban/1');
        var_dump($response);
        $this->assertEquals(200, $response->status());
        $this->assertTrue($user->isIpBanned());
        $response = $this->call('GET', '/moderation/unban/1');
        var_dump($response);
        $this->assertEquals(200, $response->status());
        $this->assertTrue(!$user->isBanned());
    }
}
