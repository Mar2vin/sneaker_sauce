<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AccueilController extends AbstractController
{

    private $repoArticle;
    private $repoCategory;

    public function __construct(ArticleRepository $repoArticle, CategoryRepository $repoCategory)
    {
        $this->repoCategory = $repoCategory;
        $this->repoArticle = $repoArticle;
    }

    #[Route('/', name: 'accueil')]
    public function index(ArticleRepository $articleRepository): Response
    {

        $categories = $this->repoCategory->findAll();


        return $this->render('accueil/index.html.twig', [
            'articles' => $articleRepository->lastSix(),
            'categories' => $categories,
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

    #[Route('/showArticleByCategory/{id}', name: 'show_article_by_category')]
    public function showArticleByCategory(?Category $category): Response
    {
        if ($category) {
            $articles = $category->getArticles()->getValues();
        } else {
            $articles = null;
            return $this->redirectToRoute('accueil');
        }

        $categories = $this->repoCategory->findAll();

        return $this->render('article/showArticleByCategory.html.twig', [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }
}
