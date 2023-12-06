<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/create-article", name="create_article")
     */
    public function createArticle(EntityManagerInterface $entityManager): Response
    {
        // Ne rien faire ici pour désactiver la création d'articles
        return new Response('Création d\'articles désactivée.');
    }

    /**
     * @Route("/articles", name="article_index")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Utilisez le repository pour récupérer les articles avec un tri par date décroissante
        $articles = $entityManager->getRepository(Article::class)->findBy([], ['datePublication' => 'DESC']);

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
?>