<?php

namespace App\Service;

use App\Exceptions\UserNotFoundException;
use App\Models\CustomUser;

class Authenticator
{
    /** @var TokenGenerator */
    private $tokenGenerator;

    /** @codeCoverageIgnore */
    public function __construct(TokenGenerator $tokenGenerator)
    {
        $this->tokenGenerator = $tokenGenerator;
    }

    /**
     * @param $email
     * @param $password
     * @return mixed
     * @throws UserNotFoundException
     */
    public function authenticate($email, $password)
    {
        $user = CustomUser::where([
            'email' => $email,
            'password' => $password
        ])->first();

        if(!$user) {
            throw new UserNotFoundException();
        }

        $user->token = $this->tokenGenerator
            ->generate($user->role)
            ->token;

        $user->save();

        return $user;
    }
}
