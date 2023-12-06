<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository; // Ajoutez cette ligne
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $articleRepository, CategorieRepository $categorieRepository): Response
    {
        $latestArticle = $articleRepository->findOneBy([], ['datePublication' => 'DESC']);
        $categories = $categorieRepository->findAll(); // Récupérer toutes les catégories

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'latestArticle' => $latestArticle,
            'categories' => $categories, // Transmettre les catégories au modèle
        ]);
    }

    /**
     * @Route("/accueil", name="app_home")
     */
    public function accueil(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
}
?>