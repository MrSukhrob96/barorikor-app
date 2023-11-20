<?php

namespace App\Services;

use App\Core\CoreAuthService;
use App\DTO\Category\LoginDTO;
use App\DTO\User\CreateUserDTO;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Contracts\Config\Repository as ConfigRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthService extends CoreAuthService implements AuthServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly ConfigRepositoryInterface $configRepository
    ) {
    }

    /**
     * Method login
     * 
     * @param LoginDTO $dto
     * @return ?array
     * @throws UnauthorizedHttpException
     */
    public function login(LoginDTO $dto): ?array
    {
        $this->authorization($dto);
        $this->clearTokens();

        return [
            "accessToken" => $this->generateToken('accessToken'),
            "tokenType" => 'Bearer',
            "expareDate" => $this->configRepository->get("sanctum.expiration"),
        ];
    }

    /**
     * Method register
     * 
     * @param CreateUserDTO $dto
     * @return ?User
     */
    public function register(CreateUserDTO $dto): ?User
    {
        $phoneNumber = $this->getPhoneNumber($dto->phoneNumber);

        if ($this->userRepository->findByPhoneNumber($phoneNumber)) 
        {
            throw new \Exception("user.error.exists");
        }

        return $this->userRepository->create($dto->toArray());
    }
}
