<?php

namespace App\Services\Auth;

use App\Components\Request\DataTransfer;
use App\Interfaces\Morphable\MorphableInterface;
use App\Services\BaseService\BaseService;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * @property PersonalAccessToken $personalAccessToken
 * @property DataTransfer        $request
 * @property MorphableInterface  $morphable
 * @property string              $plainTextToken
 */
class TokenStoreService extends BaseService
{
    private PersonalAccessToken $personalAccessToken;
    private DataTransfer $request;
    private MorphableInterface $morphable;
    private string $plainTextToken;

    /**
     * @param PersonalAccessToken $personalAccessToken
     * @param DataTransfer        $request
     * @param MorphableInterface  $morphable
     */
    public function __construct(PersonalAccessToken $personalAccessToken, DataTransfer $request, MorphableInterface $morphable)
    {
        $this->personalAccessToken = $personalAccessToken;
        $this->request = $request;
        $this->morphable = $morphable;
        $this->plainTextToken = Str::random(40);
    }

    /**
     * @return bool
     */
    public function run(): bool
    {
        $this->personalAccessToken->name = $this->request->get('user_agent');
        $this->personalAccessToken->token = hash('sha256', $this->plainTextToken);
        $this->personalAccessToken->tokenable_type = $this->morphable->getMorphClass();
        $this->personalAccessToken->tokenable_id = $this->morphable->getKey();

        return $this->personalAccessToken->save();
    }

    /**
     * @return string
     */
    public function getPlainTextToken(): string
    {
        return $this->personalAccessToken->getKey() . '|' . $this->plainTextToken;
    }
}
