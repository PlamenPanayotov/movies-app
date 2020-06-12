<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Service\User\UserServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }
    /**
     * @Route("/user", name="app_user")
     */
    public function __invoke(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('account/app.html.twig', [
            'last_username' => $lastUsername,
            'is_authenticated' => json_encode(!empty($this->getUser())),
            'error' => $error
        ]);
    }
    /**
     * @Route("/user/register", name="user_register", methods={"POST"})
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
     * @Route("/user/login", name="api_login", methods={"POST"})
     */
    public function login()
    {
        return $this->json(['userId' => $this->getUser()->getId(),
                            'userEmail' => $this->getUser()->getEmail()
                            ]);
    }

    /**
     * @Route("/user/profile", name="api_profile")
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

     /**
     * @Route("/user/logout", name="user_logout", methods={"GET"})
     *
     * @throws \Exception
     */
    public function logout()
    {
        // controller can be blank: it will never be executed!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }

}
