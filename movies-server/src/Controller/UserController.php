<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Service\User\UserServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


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
        $user = new User();
        $data = json_decode($request->getContent(), true);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $passwordConfirmation = $data['password_confirmation'];

        $stmt = $this->userService->save($user, $passwordConfirmation);
        if(gettype($stmt) == 'object') {
            return $this->json([
                'user' => $stmt
            ]);
        }
                
        return $this->json([
            'errors' => $stmt
        ], 400);
           
    }

    /**
     * @Route("/login", name="api_login", methods={"POST"})
     */
    public function login()
    {
        // $jwt = $_COOKIE['jwt'];
        return $this->json(['userId' => $this->getUser()->getId(),
                            'userEmail' => $this->getUser()->getEmail()
                            ]);
    }

    /**
     * @Route("/profile", name="api_profile")
     * @IsGranted("ROLE_USER")
     */
     public function profile()
     {
        return $this->json([
            'user' => $this->getUser()
        ],
        200,
        [],
        [
            'groups' => ['api']
        ]);
     }

}
