<?php

namespace App\Core;

use App\DTO\Category\LoginDTO;
use App\Traits\AuthTrait;
use App\Traits\FileUploader;
use App\Traits\Helpful;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

abstract class CoreAuthService {
    
    use AuthTrait, Helpful, FileUploader;

    /**
     * Method authorization
     * 
     * @return void
     * @throws UnauthorizedHttpException
     */
    public function authorization(LoginDTO $dto): void
    {
        if (!auth()->attempt($dto->toArray())) 
        {
            throw new UnauthorizedHttpException("user.error.notfound");
        }
    }

}