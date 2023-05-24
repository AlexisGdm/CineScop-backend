<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Component\Security\Core\Security;

class UserLoginController extends AbstractController
{
    #[Route('api/v1/users/login', name: 'api_login', methods: ['POST'])]
    
    public function login(Request $request, UserRepository $userRepository)
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        $user = $userRepository->findOneBy(['email'=>$email]);
        if (!$user || !password_verify($password, $user->getPassword())) {
            return $this->json(['message' => 'Email ou mot de passe invalide'], 403);
        }

        $userData = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'role' => $user->getRole(),
            'avatar' => $user->getAvatar(),
            'isLoged' => 'isLoged'
        ];

        return $this->json($userData);
    }
}
