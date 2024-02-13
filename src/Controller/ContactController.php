<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(): Response
    {
        return $this->render('contact/index.html.twig');
    }

    #[Route('/contact/send', name: 'contact_send', methods: ['POST'])]
    public function sendMail(Request $request, MailerInterface $mailer): Response
    {
        $senderEmail = $request->request->get('email');
        $subject = $request->request->get('subject');
        $message = $request->request->get('message');

        // Construire l'email
        $email = (new Email())
            ->from($senderEmail)
            ->to($this->getParameter('app.contact_email')) // Adresse de l'expéditeur par défaut
            ->cc($senderEmail) // En copie à l'expéditeur
            ->replyTo($senderEmail) // Répondre à l'expéditeur
            ->subject($subject)
            ->text($message) // Version texte du message
            ->html('<p>' . nl2br($message) . '</p>'); // Version HTML du message

        // Envoyer l'email
        $mailer->send($email);

        // Rediriger l'utilisateur
        return $this->redirectToRoute('contact');
    }
}
?>