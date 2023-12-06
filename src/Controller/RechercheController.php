<?php
// src/Controller/RechercheController.php
namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController
{
#[Route('/recherche', name: 'recherche')]
public function recherche(): Response
{
return $this->render('recherche/recherche.html.twig');
}

#[Route('/recherche/resultat', name: 'recherche_resultat', methods: ['POST'])]
public function resultat(Request $request, ArticleRepository $articleRepository): Response
{
$searchTerm = $request->request->get('search');

// Utilisez la méthode search du repository pour récupérer les articles correspondants
$articles = $articleRepository->search($searchTerm);

return $this->render('recherche/resultat.html.twig', [
'searchTerm' => $searchTerm,
'articles' => $articles,
]);
}
}
?>