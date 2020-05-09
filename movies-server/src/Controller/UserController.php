<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Service\User\UserServiceInterface;

use Symfony\Component\HttpFoundation\Request;


class UserController extends AbstractController
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }
    /**
     * @Route("/register", name="user_register", methods={"POST"})
     */
    public function register(Request $request)
    {
        $errors = [];
        $user = new User();
        $user->setEmail($request->request->get("email"));
        $user->setPassword($request->request->get("password"));
        $passwordConfirmation = $request->request->get("password_confirmation");

        if ($user->getPassword() != $passwordConfirmation) {
            $errors[] = "Password does not match the password confirmation.";
        }

        if (strlen($user->getPassword()) < 6) {
            $errors[] = "Password should be at least 6 characters.";
        }

        if(!$errors) {
            return $this->json([
                'user' => $this->userService->save($user)
            ]);
        }

        return $this->json([
            'errors' => $errors
        ], 400);
           
    }
}
