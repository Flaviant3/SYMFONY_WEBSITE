<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'accueil')]

    public function index(ArticleRepository $articleRepository): Response
    {
        $latestArticle = $articleRepository->findOneBy([], ['datePublication' => 'DESC']);

        return $this->render('base.html.twig', [
            'controller_name' => 'AccueilController', // Nom du contrôleur (facultatif)
            'latestArticle' => $latestArticle,
        ]);
    }
}
?>