<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class MyListController extends AbstractController
{
    #[Route('/mylist/{list_id}', name: 'app_my_list')]
    public function index(int $list_id): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MyListController.php',
            'list_id' => $list_id,
        ]);
    }
}
