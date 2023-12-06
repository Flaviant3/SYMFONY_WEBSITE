<?php

namespace App\Controller;

use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieTestController extends AbstractController
{
    #[Route('/categorie', name: 'categorie')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Récupérer toutes les catégories après en avoir ajouté une nouvelle
        $categories = $entityManager->getRepository(Categorie::class)->findAll();

        return $this->render('categorie_test/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/articles-par-categorie/{id}', name: 'articles_par_categorie')]
    public function articlesParCategorie(EntityManagerInterface $entityManager, $id): Response
    {
        // Récupérer la catégorie par son ID
        $categorie = $entityManager->getRepository(Categorie::class)->find($id);

        // Vérifier si la catégorie existe
        if (!$categorie) {
            throw $this->createNotFoundException('La catégorie n\'existe pas.');
        }

        // Récupérer les articles associés à la catégorie
        $articles = $categorie->getArticles();

        return $this->render('categorie_test/articles_par_categorie.html.twig', [
            'categorie' => $categorie,
            'articles' => $articles,
        ]);
    }
}
?>