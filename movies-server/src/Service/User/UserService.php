<?php

namespace App\Service\User;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Encryption\ArgonEncryption;

class UserService implements UserServiceInterface
{

    private $userRepository;
    private $encryptionService;


    public function __construct(UserRepository $userRepository, ArgonEncryption $encryptionService)
    {
        $this->userRepository = $userRepository;
        $this->encryptionService = $encryptionService;
    }

    public function save(User $user)
    {

        $encodedPassword = $this->encryptionService->hash($user->getPassword());
        $user->setEmail($user->getEmail());
        $user->setPassword($encodedPassword);

        return $this->userRepository->insert($user);
    }
}
