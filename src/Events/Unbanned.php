<?php

namespace Aujicini\Moderation\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Unbanned
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var \Illuminate\Database\Eloquent\Model $user The user instance. */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $user The user being banned or unbanned.
     *
     * @return void Returns nothing.
     */
    public function __construct(Model $user)
    {
        $this->user = $user;
    }
}
