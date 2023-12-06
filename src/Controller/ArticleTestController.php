<?php

// src/Controller/ArticleTestController.php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleTestController extends AbstractController
{
#[Route('/article/nouveau', name: 'article_nouveau')]
public function nouveau(EntityManagerInterface $entityManager): Response
{
// Article 1
$article1 = new Article();
$article1->setTitre('Premier Article');
$article1->setTexte('Contenu du premier article...');
$article1->setDatePublication(new \DateTime());
$article1->setAuteur('Auteur de l\'article 1');
$article1->setImage('chemin/vers/image1.jpg');
$entityManager->persist($article1);

// Article 2
$article2 = new Article();
$article2->setTitre('Deuxième Article');
$article2->setTexte('Contenu du deuxième article...');
$article2->setDatePublication(new \DateTime('-1 day'));
$article2->setAuteur('Auteur de l\'article 2');
$article2->setImage('chemin/vers/image2.jpg');
$entityManager->persist($article2);

// Article 3
$article3 = new Article();
$article3->setTitre('Troisième Article');
$article3->setTexte('Contenu du troisième article...');
$article3->setDatePublication(new \DateTime('-2 days'));
$article3->setAuteur('Auteur de l\'article 3');
$article3->setImage('chemin/vers/image3.jpg');
$entityManager->persist($article3);

$entityManager->flush();

return new Response('Enregistrement des articles réussi !');
}
}
?>