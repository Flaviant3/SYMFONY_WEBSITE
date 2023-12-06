<?php

// src/Controller/ContactController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;

class ContactController extends AbstractController
{
#[Route('/contact', name: 'contact')]
public function index(Request $request): Response
{
// Créez votre formulaire ici
    $form = $this->createForm(ContactType::class);  // Assurez-vous de remplacer ContactType par le nom de votre formulaire

// Gérez la soumission du formulaire s'il a été soumis
$form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
// Traitez les données du formulaire, par exemple, envoyez un e-mail, enregistrez-les dans la base de données, etc.
// Redirigez ou renvoyez une réponse en conséquence
}

// Rendez votre template en passant le formulaire en tant que variable
return $this->render('contact/index.html.twig', [
'form' => $form->createView(),
]);
}
}
?>