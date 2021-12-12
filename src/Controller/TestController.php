<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use App\Repository\ArticlesRepository;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TestController.php',
        ]);
    }
    
    public function read(Request $request, ArticlesRepository $articlesRepository): Response
    {
        $input = json_decode($request->getContent(),true);
        $articles = $articlesRepository->SearchArticlesByinput($input);
        $response = [
            'success' => true,
            'data'    => $articles,
            'message' => 'Articles List'
        ];
        return $this->json($response);
    }
}
