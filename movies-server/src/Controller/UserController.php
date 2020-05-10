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

        if(!$errors) {
            $stmt = $this->userService->save($user, $passwordConfirmation);
            if($stmt === true) {
                return $this->json([
                    'user' => $user
                ]);
            } else {
                return $this->json([
                    'error' => $stmt
                ]);
            }
            
        }

        return $this->json([
            'errors' => $errors
        ], 400);
           
    }

    /**
     * @Route("/login", name="api_login", methods={"POST"})
     */
    public function login()
    {
        return $this->json(['result' => true]);
    }
}
