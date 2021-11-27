<?php

namespace App\Events;

use App\Models\User\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * @property User $user
 */
class DeleteToken
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
