<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AccueilController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(ArticleRepository $articleRepository): Response
    {



        return $this->render('accueil/index.html.twig', [
            'articles' => $articleRepository->lastSix(),
        ]);
    }



    #[Route('/article/{id}', name: 'show_article')]
    public function show(Article $article): Response
    {


        if (!$article) {
            return $this->redirectToRoute('accueil');
        }

        return $this->render('article/index.html.twig', [
            'article' => $article,
        ]);
    }
}
