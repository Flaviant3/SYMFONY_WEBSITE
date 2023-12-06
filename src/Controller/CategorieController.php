<?php
// src/Controller/CategorieController.php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    #[Route('/categorie/nouveau', name: 'categorie_nouveau')]
    public function nouveau(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorie = new Categorie();
        $categorie->setOrdre(1); // Remplacez 1 par la valeur souhaitée

        $form = $this->createForm(CategorieType::class, $categorie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrez votre catégorie dans la base de données
            $entityManager->persist($categorie);
            $entityManager->flush();

            // Effectuez d'autres actions nécessaires ici

            // Redirigez l'utilisateur vers une autre page après la création de la catégorie
            return $this->redirectToRoute('liste_categories');
        }

        return $this->render('categorie/nouveau.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/categorie/liste', name: 'liste_categories')]
    public function liste(EntityManagerInterface $entityManager): Response
    {
    // Récupérez la liste des catégories depuis la base de données
    $categories = $entityManager->getRepository(Categorie::class)->findAll();

    // Passez les catégories au rendu Twig
    return $this->render('categorie/liste.html.twig', [
        'categories' => $categories,
    ]);
    }
    #[Route('/categorie/edition/{id}', name: 'categorie_edition')]
    public function edition(Request $request, EntityManagerInterface $entityManager, Categorie $categorie): Response
    {
        // Création du formulaire d'édition pour la catégorie existante
        $form = $this->createForm(CategorieType::class, $categorie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrez vos modifications dans la base de données ou effectuez d'autres actions nécessaires
            $entityManager->flush();

            // Redirigez l'utilisateur vers la liste des catégories après l'édition
            return $this->redirectToRoute('liste_categories');
        }

        return $this->render('categorie/edition.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/categorie/suppression/{id}', name: 'categorie_suppression')]
    public function suppression(EntityManagerInterface $entityManager, Categorie $categorie): Response
    {
        // Supprimez la catégorie de la base de données
        $entityManager->remove($categorie);
        $entityManager->flush();

        // Redirigez l'utilisateur vers la liste des catégories après la suppression
        return $this->redirectToRoute('liste_categories');
    }
}
?>
