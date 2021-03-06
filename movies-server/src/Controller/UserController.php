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
     * @Route("/api/register", name="user_register", methods={"POST"})
     */
    public function register(Request $request)
    {
        $user = new User();
        $data = json_decode($request->getContent(), true);
        $user->setEmail($data["email"]);
        $user->setPassword($data["password"]);
        $passwordConfirmation = $data["password_confirmation"];

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
     * @Route("/api/login", name="api_login", methods={"POST"})
     */
    public function login()
    {
        return $this->json(['result' => true]);
    }

    /**
     * @Route("/api/profile", name="api_profile")
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
