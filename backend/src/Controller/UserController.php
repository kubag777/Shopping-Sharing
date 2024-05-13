<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }

    // public function index(UserPasswordHasherInterface $passwordHasher): Response
    // {
    //     // ... e.g. get the user data from a registration form
    //     $user = new User(...);
    //     $plaintextPassword = ...;

    //     // hash the password (based on the security.yaml config for the $user class)
    //     $hashedPassword = $passwordHasher->hashPassword(
    //         $user,
    //         $plaintextPassword
    //     );
    //     $user->setPassword($hashedPassword);

    //     // ...
    // }
}
