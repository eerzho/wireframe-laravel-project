<?php

namespace App\Http\Requests\Verify;

use App\Models\User\User;
use App\Repositories\User\UserRepository;
use Illuminate\Auth\Events\Verified;

/**
 * @property      $id
 * @property User $user
 */
class EmailVerificationRequest extends \Illuminate\Foundation\Auth\EmailVerificationRequest
{
    private User $user;

    /**
     * @return bool
     */
    public function authorize()
    {
        $this->user = app(UserRepository::class)->getById($this->id);

        if (!hash_equals((string)$this->route('hash'),
                sha1($this->user->getEmailForVerification()))) {
            return false;
        }

        return true;
    }

    /**
     * @return void
     */
    public function fulfill()
    {
        if (!$this->user->hasVerifiedEmail()) {
            $this->user->markEmailAsVerified();

            event(new Verified($this->user));
        }
    }
}
