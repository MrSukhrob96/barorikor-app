<?php

namespace App\Traits;

use App\Enums\Role;
use App\Models\User;

/**
 * trait AuthTrait
 * 
 * @method isAuth
 * @method generateToken
 * @method getAuthUser
 * @method getAuthUserId
 * @method isAdmin
 */
trait AuthTrait
{

    /**
     * Method isAuth
     * 
     * @return bool
     */
    protected function isAuth(): bool
    {
        return auth()?->check() ?? false;
    }


    /**
     * Method generateToken
     * 
     * @return ?string
     */
    protected function generateToken(string $tokenType): ?string
    {
        return auth()?->user()?->createToken($tokenType)?->plainTextToken ?? null;
    }


    /**
     * Method clearTokens
     * 
     * @return void
     */
    public function clearTokens()
    {
        auth()?->user()?->tokens()?->delete();
    }

    /**
     * Method getAuthUser
     * 
     * @return ?User
     */
    protected function getAuthUser(): ?User
    {
        return auth()?->user();
    }


    /**
     * Method getAuthUserId
     * 
     * @return ?int
     */
    protected function getAuthUserId(): ?int
    {
        return auth()?->id();
    }


    /**
     * Method isAdmin
     * 
     * @return bool
     */
    protected function isAdmin(): bool
    {
        $user = $this->getAuthUser();

        if ($user) {
            return $user->role === Role::ADMIN;
        }

        return false;
    }
}

