<?php

namespace App\Listeners;

use App\Events\DeleteToken;

class DeleteTokenListener
{
    /**
     * @param DeleteToken $event
     */
    public function handle(DeleteToken $event)
    {
        $event->user->tokens()->delete();
    }
}
