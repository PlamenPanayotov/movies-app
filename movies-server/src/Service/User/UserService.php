<?php

namespace App\Service\User;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Encryption\ArgonEncryption;
use App\Service\Validation\UserValidationServiceInterface;

class UserService implements UserServiceInterface
{

    private $userRepository;
    private $encryptionService;
    private $validator;


    public function __construct(UserRepository $userRepository, 
                                ArgonEncryption $encryptionService,
                                UserValidationServiceInterface $validator)
    {
        $this->userRepository = $userRepository;
        $this->encryptionService = $encryptionService;
        $this->validator = $validator;
    }

    public function save(User $user, $passwordConfirmation)
    {
        try {
            $this->validator->checkEmail($user->getEmail());
            $this->validator->checkPassword($user->getPassword(), $passwordConfirmation);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $encodedPassword = $this->encryptionService->hash($user->getPassword());
        $user->setPassword($encodedPassword);
        $user->setRoles(['ROLE_USER']);

        return $this->userRepository->insert($user);
    }
}
